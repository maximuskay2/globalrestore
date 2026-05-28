@extends('layouts.app')

@section('title', 'News — ' . $settings->site_name)
@section('meta_description', 'Latest news and updates from Restore Global Initiative on climate action, green skills, and community programmes across the UK.')

@section('content')
    <section class="bg-teal py-20 text-cream">
        <div class="mx-auto max-w-6xl px-6">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cream/70">News &amp; updates</p>
            <h1 class="font-display mt-3 text-4xl font-extrabold md:text-5xl">Stories from the field</h1>
            <p class="mt-6 max-w-2xl text-lg text-cream/85">Programme highlights, community impact, and climate action news from Restore Global Initiative.</p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-20">
        @if ($posts->isEmpty())
            <p class="text-lg text-teal/80">No articles published yet. Check back soon.</p>
        @else
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <article class="card reveal flex flex-col overflow-hidden p-0">
                        @if ($post->featuredImageUrl())
                            <img src="{{ $post->featuredImageUrl() }}" alt="" class="h-40 w-full object-cover" loading="lazy" decoding="async">
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                        <time datetime="{{ $post->published_at->toDateString() }}" class="text-xs font-semibold uppercase tracking-wider text-teal/60">
                            {{ $post->published_at->format('j F Y') }}
                        </time>
                        <h2 class="font-display mt-3 text-xl font-bold text-teal">
                            <a href="{{ route('news.show', $post->slug) }}" class="hover:underline">{{ $post->title }}</a>
                        </h2>
                        @if ($post->excerpt)
                            <p class="mt-3 flex-1 leading-relaxed text-teal/80">{{ $post->excerpt }}</p>
                        @endif
                        <a href="{{ route('news.show', $post->slug) }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-teal transition-all hover:gap-3">
                            Read more <span aria-hidden="true">&rarr;</span>
                        </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @endif
    </section>
@endsection
