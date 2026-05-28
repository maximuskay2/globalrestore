<header class="sticky top-0 z-50 border-b border-teal/10 bg-cream/90 backdrop-blur-md" x-data="{ open: false }">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-6 py-4">
        <a href="{{ route('home') }}" class="group flex items-center gap-3">
            <img src="{{ asset('images/brand/logo-192.png') }}" alt="{{ $settings->site_name }} logo" class="h-11 w-11 transition group-hover:scale-105" width="44" height="44" decoding="async">
            <span class="font-display text-sm font-bold leading-tight text-teal sm:text-base">{{ $settings->site_name }}</span>
        </a>

        <nav class="hidden items-center gap-8 md:flex" aria-label="Main">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}" @if(request()->routeIs('home')) aria-current="page" @endif>Home</a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'nav-link-active' : '' }}" @if(request()->routeIs('about')) aria-current="page" @endif>About Us</a>
            <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'nav-link-active' : '' }}" @if(request()->routeIs('services')) aria-current="page" @endif>Services</a>
            <a href="{{ route('news.index') }}" class="nav-link {{ request()->routeIs('news.*') ? 'nav-link-active' : '' }}" @if(request()->routeIs('news.*')) aria-current="page" @endif>News &amp; Impact</a>
            <a href="{{ $settings->heroCtaUrl() }}" class="btn-primary">{{ $settings->hero_cta_text ?: 'Get Involved' }}</a>
        </nav>

        <button type="button" class="inline-flex rounded-lg p-2 text-teal md:hidden" @click="open = !open" :aria-expanded="open" aria-controls="mobile-nav">
            <span class="sr-only">Toggle menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    <div id="mobile-nav" class="border-t border-teal/10 px-6 py-4 md:hidden" x-show="open" x-cloak>
        <nav class="flex flex-col gap-3" aria-label="Mobile">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('about') }}" class="nav-link">About Us</a>
            <a href="{{ route('services') }}" class="nav-link">Services</a>
            <a href="{{ route('news.index') }}" class="nav-link">News &amp; Impact</a>
            <a href="{{ $settings->heroCtaUrl() }}" class="btn-primary w-fit">{{ $settings->hero_cta_text ?: 'Get Involved' }}</a>
        </nav>
    </div>
</header>
