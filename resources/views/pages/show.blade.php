@extends('layouts.app')

@section('title', $page['meta_title'] ?? $page['title'])
@section('meta_description', $page['meta_description'] ?? \Illuminate\Support\Str::limit(strip_tags($page['description'] ?? ''), 155))

@push('styles')
    @once
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            .semrush-font { font-family: 'Inter', 'Manrope', system-ui, sans-serif; }
        </style>
    @endonce
@endpush

@section('content')
<div class="semrush-font">
    <section class="bg-[#b11238] text-white">
        <div class="max-w-6xl mx-auto px-4 py-14 md:py-18 space-y-4">
            <nav class="text-sm text-pink-100/80 flex gap-2 items-center">
                <span class="font-semibold text-white">Spacelink</span>
                <span>›</span>
                <span>{{ $page['type'] ?? 'Page' }}</span>
                <span>›</span>
                <span class="text-white font-semibold">{{ $page['title'] }}</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">{{ $page['title'] }}</h1>
            @if(!empty($page['meta_description']))
                <p class="text-lg text-pink-100 max-w-4xl leading-relaxed">{{ $page['meta_description'] }}</p>
            @endif
            <div class="flex flex-wrap items-center gap-3 text-sm text-pink-100">
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20">{{ ucfirst($page['type'] ?? 'page') }}</span>
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20">{{ $page['slug'] }}</span>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="max-w-6xl mx-auto px-4 py-12 md:py-16 grid gap-8 md:grid-cols-3 items-start">
            <div class="md:col-span-2 space-y-6">
                @if(!empty($image))
                    <img src="{{ $image }}" alt="{{ $page['alt'] ?? $page['title'] }}" class="w-full rounded-2xl shadow-lg object-cover">
                @endif

                <article class="prose prose-lg max-w-none rich-copy">
                    {!! $page['description'] ?? '' !!}
                </article>
            </div>
            <aside class="space-y-4 p-5 bg-slate-50 border border-slate-200 rounded-2xl shadow-sm">
                <h2 class="text-xl font-bold text-slate-800">Page details</h2>
                <ul class="text-slate-700 text-sm space-y-2">
                    <li><strong>Type:</strong> {{ $page['type'] ?? 'Page' }}</li>
                    <li><strong>Slug:</strong> {{ $page['slug'] }}</li>
                    @if(!empty($page['meta_title']))
                        <li><strong>Meta title:</strong> {{ $page['meta_title'] }}</li>
                    @endif
                    @if(!empty($page['meta_description']))
                        <li><strong>Meta description:</strong> {{ $page['meta_description'] }}</li>
                    @endif
                </ul>
            </aside>
        </div>
    </section>
@endsection
@endsection
