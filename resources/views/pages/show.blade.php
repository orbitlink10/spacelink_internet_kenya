@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', ['meta_title'] ?? ['title'])
@section('meta_description', ['meta_description'] ?? Str::limit(strip_tags(['description'] ?? ''), 155))

@section('content')
    <section class="bg-[#8b0e2b] text-white">
        <div class="max-w-6xl mx-auto px-4 py-16 md:py-20">
            <p class="uppercase text-sm tracking-[0.3em] font-semibold text-pink-200">{{ ['type'] ?? 'Page' }}</p>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mt-3">{{ ['title'] }}</h1>
            @if(!empty(['meta_description']))
                <p class="mt-4 text-lg text-pink-100 max-w-3xl">{{ ['meta_description'] }}</p>
            @endif
            <div class="mt-6 flex flex-wrap items-center gap-4 text-sm text-pink-100">
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20">{{ ucfirst(['type'] ?? 'page') }}</span>
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20">Slug: {{ ['slug'] }}</span>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="max-w-6xl mx-auto px-4 py-12 md:py-16 grid gap-8 md:grid-cols-3 items-start">
            <div class="md:col-span-2 space-y-6">
                @if()
                    <img src="{{  }}" alt="{{ ['alt'] ?? ['title'] }}" class="w-full rounded-2xl shadow-lg object-cover">
                @endif

                <article class="prose prose-lg max-w-none rich-copy">
                    {!! ['description'] ?? '' !!}
                </article>
            </div>
            <aside class="space-y-4 p-5 bg-slate-50 border border-slate-200 rounded-2xl shadow-sm">
                <h2 class="text-xl font-bold text-slate-800">Page details</h2>
                <ul class="text-slate-700 text-sm space-y-2">
                    <li><strong>Type:</strong> {{ ['type'] ?? 'Page' }}</li>
                    <li><strong>Slug:</strong> /page/{{ ['slug'] }}</li>
                    @if(!empty(['meta_title']))
                        <li><strong>Meta title:</strong> {{ ['meta_title'] }}</li>
                    @endif
                    @if(!empty(['meta_description']))
                        <li><strong>Meta description:</strong> {{ ['meta_description'] }}</li>
                    @endif
                </ul>
            </aside>
        </div>
    </section>
@endsection
