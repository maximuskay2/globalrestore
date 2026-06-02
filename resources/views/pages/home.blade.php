@extends('layouts.app')

@section('title', $settings->site_name . ' — Home')
@section('meta_description', $settings->meta_description_default ?? 'Restore Global Initiative empowers UK communities through green skills, clean energy, and climate action.')

@section('content')
    @php($heroBackgrounds = $settings->heroBackgroundUrls())
    @php($videoSlides = $homeVideoSlides->filter(fn ($slide) => $slide->isPlayable())->map->toPlayerPayload()->values())
    {{-- Section 1: Hero --}}
    <section
        class="hero-section relative overflow-hidden bg-teal text-cream"
        x-data="{
            slides: {{ \Illuminate\Support\Js::from($heroBackgrounds) }},
            activeSlide: 0,
            init() {
                if (this.slides.length > 1) {
                    setInterval(() => {
                        this.activeSlide = (this.activeSlide + 1) % this.slides.length
                    }, 5000)
                }
            }
        }"
    >
        @if (count($heroBackgrounds) > 0)
            {{-- Desktop: image slider on the right half only --}}
            <div class="hero-bg-desktop" aria-hidden="true">
                <template x-for="(slide, index) in slides" :key="'desktop-' + slide">
                    <img
                        :src="slide"
                        alt=""
                        class="hero-bg-desktop__slide"
                        x-show="index === activeSlide"
                        x-transition.opacity.duration.700ms
                        loading="eager"
                        decoding="async"
                        fetchpriority="high"
                    >
                </template>
                <div class="hero-bg-desktop__overlay"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(242,237,228,0.12),transparent_50%)]"></div>
        @endif

        <div class="hero-inner relative z-10 mx-auto max-w-7xl px-6 py-12 sm:py-16 md:py-28">
            <div class="md:grid md:grid-cols-2 md:gap-0">
                <div @class([
                    'hero-copy',
                    'max-w-xl' => count($heroBackgrounds) === 0,
                    'hero-copy-panel' => count($heroBackgrounds) > 0,
                ])>
                    <p class="reveal mb-3 text-xs font-semibold uppercase tracking-[0.2em] text-cream/70 sm:text-sm">UK Community Interest Company</p>
                    <h1 class="reveal font-display text-3xl font-extrabold leading-tight sm:text-4xl lg:text-[2.75rem] lg:leading-[1.15]">
                        {{ $settings->hero_headline }}
                    </h1>
                    @if ($settings->hero_subheadline)
                        <p class="reveal mt-4 text-base leading-relaxed text-cream/85 sm:mt-5 sm:text-lg">
                            {{ $settings->hero_subheadline }}
                        </p>
                    @endif
                    <div class="reveal mt-8 flex flex-wrap gap-3 sm:mt-10">
                        <a href="{{ $settings->heroCtaUrl() }}" class="btn-cream">
                            {{ $settings->hero_cta_text ?: 'Get Involved' }}
                        </a>
                        <a href="{{ route('about') }}" class="btn-outline-cream">About Us</a>
                        <a href="{{ route('services') }}" class="btn-outline-cream">Our Services</a>
                    </div>
                </div>
                <div class="hidden md:block" aria-hidden="true"></div>
            </div>

            {{-- Mobile: image slider below text and buttons --}}
            @if (count($heroBackgrounds) > 0)
                <div class="hero-mobile-gallery md:hidden" aria-hidden="true">
                    <template x-for="(slide, index) in slides" :key="'mobile-' + slide">
                        <img
                            :src="slide"
                            alt=""
                            class="hero-mobile-gallery__slide"
                            x-show="index === activeSlide"
                            x-transition.opacity.duration.700ms
                            loading="eager"
                            decoding="async"
                        >
                    </template>
                </div>
            @endif
        </div>
    </section>

    {{-- Section 2: Video slider --}}
    @if ($videoSlides->isNotEmpty())
        <section class="mx-auto max-w-6xl px-6 py-20 md:py-24" aria-labelledby="video-slider-heading">
            <div
                class="grid items-center gap-10 lg:grid-cols-[1fr_1.15fr]"
                x-data="homeVideoSlider({{ \Illuminate\Support\Js::from($videoSlides) }})"
                @keydown.escape.window="closeModal()"
            >
                <div class="max-w-lg">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal/60">Media showcase</p>
                    <h2 id="video-slider-heading" class="font-display mt-3 text-3xl font-bold text-teal md:text-4xl">
                        {{ $settings->video_slider_heading ?: 'Our Work in Action' }}
                    </h2>
                    <p class="mt-4 text-lg leading-relaxed text-teal/75">
                        {{ $settings->video_slider_description ?: 'Watch highlights from Restore Global Initiative programmes — green skills training, clean energy outreach, and community climate action making a difference across the UK.' }}
                    </p>
                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="{{ $settings->videoSliderCtaUrl() }}" class="btn-primary">
                            {{ $settings->video_slider_cta_text ?: 'Contact Us' }}
                        </a>
                    </div>
                </div>

                <div class="video-slider-track-wrap">
                    <div
                        class="video-slider-track"
                        :style="`transform: translateX(-${active * slideStepPx}px);`"
                    >
                        <template x-for="(slide, idx) in slides" :key="slide.id">
                            <article class="video-slider-card">
                                <button
                                    type="button"
                                    class="video-slider-card__button"
                                    @click="openModal(slide)"
                                    :aria-label="'Play video: ' + slide.title"
                                >
                                    <template x-if="slide.thumbnail">
                                        <img :src="slide.thumbnail" :alt="slide.title" class="video-slider-card__media">
                                    </template>
                                    <template x-if="!slide.thumbnail && slide.directVideo">
                                        <video
                                            :src="slide.directVideo"
                                            class="video-slider-card__media"
                                            muted
                                            loop
                                            playsinline
                                            autoplay
                                            preload="metadata"
                                        ></video>
                                    </template>
                                    <template x-if="!slide.thumbnail && !slide.directVideo">
                                        <div class="video-slider-card__fallback" aria-hidden="true"></div>
                                    </template>
                                    <span class="video-slider-card__play" aria-hidden="true">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </span>
                                    <span class="video-slider-card__shade"></span>
                                    <span class="video-slider-card__title" x-text="slide.title"></span>
                                </button>
                            </article>
                        </template>
                    </div>

                    <template x-if="slides.length > 1">
                        <div class="video-slider-dots" role="tablist" aria-label="Video slides">
                            <template x-for="(slide, idx) in slides" :key="'dot-' + slide.id">
                                <button
                                    type="button"
                                    class="video-slider-dot"
                                    :class="{ 'is-active': idx === active }"
                                    @click="goTo(idx)"
                                    :aria-label="'Go to slide ' + (idx + 1)"
                                    :aria-selected="idx === active"
                                ></button>
                            </template>
                        </div>
                    </template>
                </div>

                {{-- In-page modal (no navigation away) --}}
                <div
                    x-show="modalOpen"
                    x-cloak
                    class="video-slider-modal"
                    role="dialog"
                    aria-modal="true"
                    :aria-label="modalSlide ? 'Playing: ' + modalSlide.title : 'Video player'"
                >
                    <button type="button" class="video-slider-modal__backdrop" @click="closeModal()" aria-label="Close video"></button>
                    <div class="video-slider-modal__panel">
                        <button type="button" class="video-slider-modal__close" @click="closeModal()" aria-label="Close video">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <template x-if="modalSlide && modalSlide.embed">
                            <iframe
                                class="video-slider-modal__frame"
                                :src="modalEmbedUrl(modalSlide)"
                                title="Video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                            ></iframe>
                        </template>
                        <template x-if="modalSlide && modalSlide.directVideo && !modalSlide.embed">
                            <video
                                class="video-slider-modal__frame"
                                :src="modalSlide.directVideo"
                                controls
                                playsinline
                                autoplay
                            ></video>
                        </template>
                        <p class="video-slider-modal__caption" x-show="modalSlide" x-text="modalSlide?.title"></p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Section 3: Focus pillars --}}
    @if ($focusPillars->isNotEmpty())
        <section class="mx-auto max-w-6xl px-6 py-24" aria-labelledby="focus-pillars-heading">
            <div class="reveal mx-auto max-w-3xl text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal/60">Purpose beyond profit</p>
                <h2 id="focus-pillars-heading" class="font-display mt-3 text-3xl font-bold text-teal md:text-4xl">Our core focus</h2>
                <p class="mt-4 text-lg leading-relaxed text-teal/75">Community outreach initiatives driving equity, mentorship, and green pathways.</p>
            </div>
            <div class="mt-14 grid gap-8 md:grid-cols-3">
                @foreach ($focusPillars as $pillar)
                    <article class="card reveal flex flex-col">
                        <x-focus-pillar-icon :name="$pillar->icon" />
                        <h3 class="font-display mt-6 text-xl font-bold text-teal">{{ $pillar->title }}</h3>
                        <p class="mt-4 flex-1 leading-relaxed text-teal/80">{{ $pillar->description }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Section 4: Training & services on homepage --}}
    @if ($qualificationServices->isNotEmpty() || $communityServices->isNotEmpty() || $uncategorizedServices->isNotEmpty())
        <section class="bg-cream-muted/50 py-24" aria-labelledby="home-services-heading">
            <div class="mx-auto max-w-6xl px-6">
                <div class="reveal max-w-3xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal/60">Training &amp; qualifications</p>
                    <h2 id="home-services-heading" class="font-display mt-3 text-3xl font-bold text-teal md:text-4xl">Green skills &amp; community services</h2>
                    <p class="mt-4 text-lg leading-relaxed text-teal/75">Vocational pathways and wraparound support designed for real-world impact.</p>
                </div>

                <div class="mt-14 grid gap-12 lg:grid-cols-2">
                    @if ($qualificationServices->isNotEmpty())
                        <div class="reveal">
                            <h3 class="font-display text-xl font-bold text-teal">Vocational qualifications</h3>
                            <ul class="mt-6 space-y-6">
                                @foreach ($qualificationServices as $service)
                                    <li class="rounded-2xl border border-teal/10 bg-white p-6 shadow-sm">
                                        <h4 class="font-display font-bold text-teal">{{ $service->title }}</h4>
                                        <div class="prose-teal mt-3 text-sm leading-relaxed text-teal/85 whitespace-pre-line">{{ $service->displaySummary() }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($communityServices->isNotEmpty())
                        <div class="reveal">
                            <h3 class="font-display text-xl font-bold text-teal">Community services</h3>
                            <ul class="mt-6 space-y-6">
                                @foreach ($communityServices as $service)
                                    <li class="rounded-2xl border border-teal/10 bg-white p-6 shadow-sm">
                                        <h4 class="font-display font-bold text-teal">{{ $service->title }}</h4>
                                        <div class="prose-teal mt-3 text-sm leading-relaxed text-teal/85 whitespace-pre-line">{{ $service->displaySummary() }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                @if ($uncategorizedServices->isNotEmpty())
                    <ul class="mt-12 grid gap-6 md:grid-cols-2">
                        @foreach ($uncategorizedServices as $service)
                            <li class="card reveal">
                                <h4 class="font-display font-bold text-teal">{{ $service->title }}</h4>
                                <p class="mt-3 text-sm leading-relaxed text-teal/85 whitespace-pre-line">{{ $service->displaySummary() }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <p class="reveal mt-10 text-center">
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-teal transition-all hover:gap-3">
                        View all services <span aria-hidden="true">&rarr;</span>
                    </a>
                </p>
            </div>
        </section>
    @endif

    {{-- Section 5: Impact statistics --}}
    @if (count($settings->impactStats()) > 0)
        <section class="bg-teal py-20 text-cream" aria-labelledby="impact-heading">
            <div class="mx-auto max-w-6xl px-6">
                <h2 id="impact-heading" class="sr-only">Community impact</h2>
                <div class="grid gap-10 text-center md:grid-cols-3">
                    @foreach ($settings->impactStats() as $stat)
                        <div class="reveal">
                            <p class="font-display text-5xl font-extrabold tracking-tight md:text-6xl">{{ $stat['number'] }}</p>
                            <p class="mx-auto mt-4 max-w-xs text-sm leading-relaxed text-cream/85 md:text-base">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Section 6: Latest news --}}
    @if ($latestNews->isNotEmpty())
        <section class="mx-auto max-w-6xl px-6 py-24" aria-labelledby="latest-news-heading">
            <div class="reveal flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal/60">Latest from the community</p>
                    <h2 id="latest-news-heading" class="font-display mt-3 text-3xl font-bold text-teal">News &amp; impact stories</h2>
                </div>
                <a href="{{ route('news.index') }}" class="text-sm font-semibold text-teal hover:underline">View all news</a>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach ($latestNews as $post)
                    <article class="card reveal overflow-hidden p-0">
                        @if ($post->featuredImageUrl())
                            <img src="{{ $post->featuredImageUrl() }}" alt="" class="h-44 w-full object-cover" loading="lazy" decoding="async">
                        @else
                            <div class="flex h-44 items-center justify-center bg-teal/5 text-teal/30">
                                <span class="font-display text-sm font-semibold uppercase tracking-wider">{{ $settings->site_name }}</span>
                            </div>
                        @endif
                        <div class="p-6">
                            @if ($post->published_at)
                                <time class="text-xs font-medium uppercase tracking-wider text-teal/50" datetime="{{ $post->published_at->toDateString() }}">
                                    {{ $post->published_at->format('j M Y') }}
                                </time>
                            @endif
                            <h3 class="font-display mt-2 text-lg font-bold text-teal">
                                <a href="{{ route('news.show', $post->slug) }}" class="hover:underline">{{ $post->title }}</a>
                            </h3>
                            @if ($post->excerpt)
                                <p class="mt-3 text-sm leading-relaxed text-teal/75 line-clamp-3">{{ $post->excerpt }}</p>
                            @endif
                            <a href="{{ route('news.show', $post->slug) }}" class="mt-4 inline-flex text-sm font-semibold text-teal">Read more <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection
