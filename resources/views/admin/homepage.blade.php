@extends('admin.layout')

@section('title', 'Homepage Content')

@section('content')
<div class="bg-[#eef2fb] px-4 md:px-8 py-6">
    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-100 text-green-700 px-4 py-3 text-sm shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <span class="inline-flex px-4 py-1.5 rounded-full bg-slate-200 text-xs font-semibold text-slate-700 uppercase tracking-wide">Content</span>
            <h1 class="mt-3 text-4xl font-extrabold text-slate-900">Homepage Content</h1>
            <p class="text-slate-600 text-lg">Edit hero text, highlights, and call-to-actions.</p>
        </div>
        <a href="#content-form" class="px-5 py-3 rounded-full bg-blue-600 text-white font-semibold shadow-lg shadow-blue-200 flex items-center gap-2">✏️ Edit Sections</a>
    </div>

    <form id="content-form" method="POST" action="{{ route('admin.homepage.save') }}" enctype="multipart/form-data" class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <p class="text-lg font-semibold text-slate-900">Sections</p>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Live form</span>
        </div>
        <div class="px-6 py-8 space-y-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700" for="hero_image">Hero image</label>
                    @php
                        $heroPath = $content['hero_image'] ?? null;
                        $heroUrl = $heroPath && Storage::disk('public')->exists($heroPath) ? Storage::disk('public')->url($heroPath) : null;
                    @endphp
                    @if($heroUrl)
                        <div class="w-full h-40 rounded-xl border border-slate-200 overflow-hidden bg-slate-50">
                            <img src="{{ $heroUrl }}" alt="Hero image" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-full h-40 rounded-xl border border-dashed border-slate-200 bg-slate-50 flex items-center justify-center text-slate-400 text-sm">
                            No hero image uploaded yet
                        </div>
                    @endif
                    <input id="hero_image" name="hero_image" type="file" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100">
                    <p class="text-xs text-slate-500">Upload a large, high-quality JPG/PNG (max 2MB).</p>
                    @error('hero_image')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700" for="hero_title">Hero title</label>
                    <input id="hero_title" name="hero_title" type="text" value="{{ old('hero_title', $content['hero_title']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100" required maxlength="120">
                    @error('hero_title')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700" for="hero_subtitle">Hero subtitle</label>
                    <textarea id="hero_subtitle" name="hero_subtitle" rows="2" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100" required maxlength="240">{{ old('hero_subtitle', $content['hero_subtitle']) }}</textarea>
                    @error('hero_subtitle')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700" for="highlight_one">Highlight 1</label>
                    <textarea id="highlight_one" name="highlight_one" rows="2" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100" required maxlength="160">{{ old('highlight_one', $content['highlight_one']) }}</textarea>
                    @error('highlight_one')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700" for="highlight_two">Highlight 2</label>
                    <textarea id="highlight_two" name="highlight_two" rows="2" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100" required maxlength="160">{{ old('highlight_two', $content['highlight_two']) }}</textarea>
                    @error('highlight_two')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700" for="highlight_three">Highlight 3</label>
                    <textarea id="highlight_three" name="highlight_three" rows="2" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100" required maxlength="160">{{ old('highlight_three', $content['highlight_three']) }}</textarea>
                    @error('highlight_three')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700" for="cta_text">CTA text</label>
                    <input id="cta_text" name="cta_text" type="text" value="{{ old('cta_text', $content['cta_text']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100" required maxlength="60">
                    @error('cta_text')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700" for="cta_link">CTA link</label>
                    <input id="cta_link" name="cta_link" type="text" value="{{ old('cta_link', $content['cta_link']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100" required maxlength="120">
                    @error('cta_link')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700" for="testimonial_blurb">Testimonial blurb</label>
                <textarea id="testimonial_blurb" name="testimonial_blurb" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100" required maxlength="220">{{ old('testimonial_blurb', $content['testimonial_blurb']) }}</textarea>
                @error('testimonial_blurb')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>

            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700" for="long_content">Home page content (rich text)</label>
                <textarea id="long_content" name="long_content" rows="10" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-blue-400 focus:ring focus:ring-blue-100">{{ old('long_content', $content['long_content']) }}</textarea>
                @error('long_content')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow-lg shadow-blue-200">Save</button>
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-3 rounded-xl border border-slate-300 text-slate-800 font-semibold bg-white">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @once
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    @endonce
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.tinymce) {
                tinymce.init({
                    selector: '#long_content',
                    menubar: true,
                    plugins: 'link lists table code',
                    toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link table | code',
                    height: 400,
                });
            }
        });
    </script>
@endpush
