@extends('layouts.app')

@section('title', 'Spacelink Internet Kenya | High-Speed Satellite & Broadband')

@section('content')
    <!-- Utility top bar -->
    <div class="bg-gradient-to-r from-orange-50 via-white to-cyan-50 border-b border-slate-200/70">
        <div class="max-w-6xl mx-auto px-6 py-2 flex items-center justify-end text-xs md:text-sm text-slate-600 gap-4">
            <div class="flex items-center gap-1"><span class="text-slate-500">❤</span> Wishlist</div>
            <div class="flex items-center gap-1"><span class="text-slate-500">👤</span> Sign in</div>
            <div class="flex items-center gap-1"><span class="text-slate-500">📞</span> +254 741 446 150</div>
        </div>
    </div>

    <!-- Search bar row -->
    <div class="bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center gap-4">
            <div class="hidden md:block">
                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center">
                    <span class="text-xs text-slate-500">LOGO</span>
                </div>
            </div>
            <div class="flex-1">
                <div class="relative">
                    <input type="text" placeholder="Search for products..." class="w-full rounded-full border border-slate-200 bg-slate-50 py-3 pl-5 pr-12 text-sm focus:outline-none focus:border-orange-300 focus:ring-2 focus:ring-orange-100" />
                    <button class="absolute right-1 top-1 bottom-1 px-4 rounded-full bg-orange-400 text-white text-sm font-semibold shadow-md">🔍</button>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-4 text-slate-600 text-lg">
                <button class="hover:text-slate-900">❤</button>
                <button class="hover:text-slate-900 relative">
                    🛒
                    <span class="absolute -right-2 -top-1 text-[10px] px-2 py-0.5 bg-orange-500 text-white rounded-full">0</span>
                </button>
                <button class="hover:text-slate-900">👤</button>
            </div>
        </div>
    </div>

    <!-- Primary nav -->
    <div class="bg-white border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-6 flex items-center justify-between h-14 text-sm text-slate-700">
            <div class="flex items-center gap-6 font-semibold">
                <a href="#" class="hover:text-slate-900">Home</a>
                <a href="#packages" class="hover:text-slate-900">Shop</a>
                <a href="#features" class="hover:text-slate-900">Services</a>
                <a href="#installations" class="hover:text-slate-900">Installations</a>
                <a href="#blog" class="hover:text-slate-900">Blog</a>
            </div>
            <div class="hidden md:flex items-center gap-2 text-slate-600">
                <span class="text-slate-500">🎧</span>
                <span class="text-sm font-medium">Need help? +254 741 446 150</span>
            </div>
        </div>
    </div>

    <!-- Topic pills -->
    <div class="bg-white border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-6 py-3 flex items-center gap-3 overflow-x-auto text-xs md:text-sm">
            @php
                $topics = [
                    'Starlink Extension',
                    'Starlink Kenya Packages',
                    'Starlink Kenya Price',
                    'Where to buy Starlink in Kenya',
                    'ISP Billing Solutions',
                    'Installation Support',
                ];
            @endphp
            <button class="h-8 w-8 rounded-full border border-slate-200 bg-white shadow-sm">←</button>
            @foreach($topics as $topic)
                <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-slate-50 border border-slate-200 shadow-sm whitespace-nowrap">{{ $topic }}</div>
            @endforeach
            <button class="h-8 w-8 rounded-full border border-slate-200 bg-white shadow-sm">→</button>
        </div>
    </div>

    <!-- Hero -->
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-white to-cyan-50"></div>
        <div class="max-w-6xl mx-auto px-6 py-12 grid lg:grid-cols-2 gap-10 relative">
            <div class="space-y-5">
                <span class="inline-flex px-4 py-2 rounded-full bg-slate-100 text-sm text-blue-700 font-semibold">Welcome to Spacelink Internet Kenya</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">Starlink Kenya | High-Speed Satellite Internet</h1>
                <p class="text-lg text-slate-600">Reliable, high-speed internet solutions for homes, businesses, and remote sites across Kenya. We deliver kits, handle installs, and keep you online with responsive support.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="https://wa.me/254774849471" class="px-5 py-3 rounded-full bg-slate-900 text-white font-semibold shadow-md" target="_blank" rel="noreferrer">Chat on WhatsApp</a>
                    <a href="tel:+254774849471" class="px-5 py-3 rounded-full border border-slate-300 text-slate-900 font-semibold bg-white">Call +254 774 849 471</a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-6 bg-gradient-to-br from-orange-100 via-white to-cyan-100 blur-3xl"></div>
                <div class="relative bg-white border border-slate-200 rounded-3xl shadow-2xl overflow-hidden">
                    <div class="h-full w-full flex items-center justify-center py-12 px-6">
                        <div class="w-full h-64 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400">Hero image placeholder</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages / shop preview -->
    <section id="packages" class="py-14 bg-white border-t border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-orange-500">Shop</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900">Popular Starlink & Spacelink offers</h2>
                </div>
                <a class="inline-flex items-center gap-2 text-cyan-700 hover:text-cyan-900 font-semibold" href="#">View all →</a>
            </div>
            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @php
                    $cards = [
                        ['title' => 'Starlink Residential Kit', 'price' => 'From KES 89,000', 'desc' => 'Delivered, configured, and optimized for Kenyan conditions.'],
                        ['title' => 'Spacelink 4G Home Kit', 'price' => 'From KES 6,500 setup', 'desc' => 'Fast 4G with high‑gain antenna for estates and apartments.'],
                        ['title' => 'Corporate Fibre & SD-WAN', 'price' => 'Custom quote', 'desc' => 'Dedicated bandwidth, auto-failover, and managed routers.'],
                    ];
                @endphp
                @foreach($cards as $card)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-md hover:shadow-lg transition-shadow">
                        <div class="h-32 mb-4 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 text-sm">Image</div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $card['title'] }}</h3>
                        <p class="text-sm text-cyan-700 font-semibold mt-1">{{ $card['price'] }}</p>
                        <p class="text-sm text-slate-600 mt-2">{{ $card['desc'] }}</p>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('products.index') }}" class="flex-1 text-center px-4 py-2 rounded-full bg-slate-900 text-white text-sm font-semibold">View</a>
                            <a href="tel:+254774849471" class="flex-1 text-center px-4 py-2 rounded-full border border-slate-300 text-slate-900 text-sm font-semibold">Call</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Services/features -->
    <section id="features" class="py-14 bg-[#f5f7fb]">
        <div class="max-w-6xl mx-auto px-6">
            <p class="text-sm uppercase tracking-[0.35em] text-orange-500">Services</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900">Internet that fits every scenario</h2>
            <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @php
                    $services = [
                        ['title' => 'Home & SME', 'copy' => 'Starlink, 4G, and broadband with smart Wi‑Fi design.'],
                        ['title' => 'Enterprise', 'copy' => 'Dedicated fibre, SD‑WAN, QoS, and proactive monitoring.'],
                        ['title' => 'Events & Field', 'copy' => 'Rapid deployment internet for pop‑ups, sites, and broadcasts.'],
                        ['title' => 'Support', 'copy' => '24/7 NOC, remote diagnostics, and on‑site engineers.'],
                        ['title' => 'Coverage', 'copy' => 'Nairobi, Kiambu, Kajiado, Mombasa, Kisumu, Eldoret and more.'],
                        ['title' => 'Billing Flex', 'copy' => 'Monthly, project-based, or short-term event packages.'],
                    ];
                @endphp
                @foreach($services as $service)
                    <div class="rounded-2xl bg-white border border-slate-200 p-5 shadow-sm">
                        <h3 class="font-semibold text-slate-900">{{ $service['title'] }}</h3>
                        <p class="text-sm text-slate-600 mt-2">{{ $service['copy'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section id="contact" class="py-14 bg-white border-t border-slate-200">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <p class="text-sm uppercase tracking-[0.35em] text-orange-500">Ready to connect?</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900">Talk to our team today</h2>
            <p class="mt-3 text-slate-600">Share your location and needs; we’ll recommend the best kit and schedule installation.</p>
            <div class="mt-6 flex flex-col md:flex-row items-center justify-center gap-3">
                <a class="px-6 py-3 rounded-full bg-slate-900 text-white font-semibold shadow-md hover:bg-slate-800" href="https://wa.me/254774849471" target="_blank" rel="noreferrer">WhatsApp Sales</a>
                <a class="px-6 py-3 rounded-full border border-slate-300 text-slate-900 font-semibold bg-white" href="mailto:info@spacelinkkenya.co.ke">Email us</a>
                <a class="px-6 py-3 rounded-full border border-slate-300 text-slate-900 font-semibold bg-white" href="tel:+254774849471">Call +254 774 849 471</a>
            </div>
        </div>
    </section>
@endsection
