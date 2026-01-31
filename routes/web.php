<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

Route::get('/', function () {
    $defaults = [
        'hero_title' => 'Spacelink Internet Kenya',
        'hero_subtitle' => 'Reliable internet connectivity, 4G kits, and broadband for homes and businesses.',
        'cta_text' => 'Get Connected',
        'cta_link' => '#contact',
        'highlight_one' => 'Nationwide coverage with rapid deployment',
        'highlight_two' => 'Human support that actually answers',
        'highlight_three' => 'Flexible plans for homes and SMEs',
        'testimonial_blurb' => 'The install was same-day and the speeds stayed fast.',
        'hero_image' => null,
        'long_content' => null,
    ];

    $stored = [];
    if (Storage::disk('local')->exists('homepage.json')) {
        $stored = json_decode(Storage::disk('local')->get('homepage.json'), true) ?? [];
    }

    $content = array_merge($defaults, $stored);

    return view('home', compact('content'));
});

// Storefront
Route::middleware('cart.merge')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'place'])->name('checkout.place');
    Route::get('/checkout/thank-you/{order}', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');

    // Customer orders
    Route::middleware('auth')->group(function () {
        Route::get('/account/orders', function () {
            $orders = \App\Models\Order::where('user_id', auth()->id())->latest()->paginate(10);
            return view('store.account.orders', compact('orders'));
        })->name('account.orders');

        Route::get('/account/orders/{order}', function (\App\Models\Order $order) {
            abort_if($order->user_id !== auth()->id(), 403);
            $order->load('items');
            return view('store.account.order-show', compact('order'));
        })->name('account.orders.show');
    });
});

// Payment webhook (COD stub)
Route::post('/payments/callback', [PaymentController::class, 'callback'])->name('payments.callback');

// --- Admin panel ---
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if ($request->email === 'admin@demo.com' && $request->password === '12345678') {
        $request->session()->put('admin_auth', true);
        $request->session()->flash('success', 'Welcome back, admin.');
        return redirect()->route('admin.dashboard');
    }

    return back()->withInput()->with('error', 'Invalid credentials.');
})->name('admin.login.submit');

Route::middleware('admin.auth')->group(function () {
    Route::get('/admin', fn () => redirect()->route('admin.dashboard'));

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/users', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('/admin/homepage-content', function () {
        $defaults = [
            'hero_title' => 'Spacelink Internet Kenya',
            'hero_subtitle' => 'Reliable internet connectivity, 4G kits, and broadband for homes and businesses.',
            'cta_text' => 'Get Connected',
            'cta_link' => '#contact',
            'highlight_one' => 'Nationwide coverage with rapid deployment',
            'highlight_two' => 'Human support that actually answers',
            'highlight_three' => 'Flexible plans for homes and SMEs',
            'testimonial_blurb' => 'The install was same-day and the speeds stayed fast.',
            'hero_image' => null,
            'long_content' => 'Add your detailed home page content here.',
        ];

        $stored = [];
        if (Storage::disk('local')->exists('homepage.json')) {
            $stored = json_decode(Storage::disk('local')->get('homepage.json'), true) ?? [];
        }

        return view('admin.homepage', [
            'content' => array_merge($defaults, $stored),
        ]);
    })->name('admin.homepage');

    Route::post('/admin/homepage-content', function (Request $request) {
        $data = $request->validate([
            'hero_title' => ['required', 'string', 'max:120'],
            'hero_subtitle' => ['required', 'string', 'max:240'],
            'cta_text' => ['required', 'string', 'max:60'],
            'cta_link' => ['required', 'string', 'max:120'],
            'highlight_one' => ['required', 'string', 'max:160'],
            'highlight_two' => ['required', 'string', 'max:160'],
            'highlight_three' => ['required', 'string', 'max:160'],
            'testimonial_blurb' => ['required', 'string', 'max:220'],
            'hero_image' => ['nullable', 'image', 'max:2048'],
            'long_content' => ['nullable', 'string'],
        ]);

        $existing = [];
        if (Storage::disk('local')->exists('homepage.json')) {
            $existing = json_decode(Storage::disk('local')->get('homepage.json'), true) ?? [];
        }

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('homepage', 'public');
            $data['hero_image'] = $path;
        } else {
            $data['hero_image'] = $existing['hero_image'] ?? null;
        }

        Storage::disk('local')->put('homepage.json', json_encode($data, JSON_PRETTY_PRINT));

        return redirect()->route('admin.homepage')->with('success', 'Homepage content updated.');
    })->name('admin.homepage.save');

    Route::get('/admin/sliders', function () {
        return view('admin.sliders');
    })->name('admin.sliders');

    Route::get('/admin/services', function () {
        return view('admin.services');
    })->name('admin.services');

    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');

    Route::get('/admin/pages', function () {
        $posts = [
            [
                'id' => 1,
                'title' => 'Kenya Vs Tanzania Vs Uganda Internet',
                'alt' => 'Kenya Vs Tanzania Vs Uganda Internet',
                'type' => 'Post',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/6/67/Feedbin-Icon-wifi.svg',
            ],
        ];
        return view('admin.pages.index', compact('posts'));
    })->name('admin.pages');

    Route::get('/admin/pages/create', function () {
        return view('admin.pages.create');
    })->name('admin.pages.create');

    Route::post('/admin/logout', function (Request $request) {
        $request->session()->forget('admin_auth');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    })->name('admin.logout');
});
