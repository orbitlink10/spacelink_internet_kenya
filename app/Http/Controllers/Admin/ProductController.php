<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\AdminAuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->mergeImagesArray($request);
        $data = $this->validateData($request);
        $product = Product::create($data);

        $this->syncImages($product, $request->input('images', []));
        AdminAuditLog::create(['admin_id' => auth()->id(), 'action' => 'product.create', 'details' => $product->id]);

        return redirect()->route('admin.products')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->mergeImagesArray($request);
        $data = $this->validateData($request, $product->id);
        $product->update($data);
        $this->syncImages($product, $request->input('images', []));
        AdminAuditLog::create(['admin_id' => auth()->id(), 'action' => 'product.update', 'details' => $product->id]);

        return redirect()->route('admin.products')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        AdminAuditLog::create(['admin_id' => auth()->id(), 'action' => 'product.delete', 'details' => $product->id]);
        return back()->with('success', 'Product deleted.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:180',
            'slug' => 'nullable|string|max:180|unique:products,slug,' . $id,
            'sku' => 'required|string|max:80|unique:products,sku,' . $id,
            'description' => 'nullable|string',
            'meta_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'currency' => 'required|string|size:3',
            'category_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|string|max:120',
            'stock_quantity' => 'required|integer|min:0',
            'is_featured' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'images' => 'array',
            'images.*' => 'url',
        ], [], [
            'slug' => 'slug',
        ]);

        // Ensure slug is always set server-side
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        return $data;
    }

    private function syncImages(Product $product, array $urls): void
    {
        $product->images()->delete();
        foreach ($urls as $index => $url) {
            ProductImage::create([
                'product_id' => $product->id,
                'url' => $url,
                'sort_order' => $index,
            ]);
        }
    }

    private function mergeImagesArray(Request $request): void
    {
        if ($request->filled('images_raw') && !$request->has('images')) {
            $images = array_filter(array_map('trim', explode(',', $request->input('images_raw'))));
            $request->merge(['images' => $images]);
        }
    }
}
