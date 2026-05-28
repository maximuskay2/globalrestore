@extends('layouts.app')

@section('title', 'Our Services — ' . $settings->site_name)
@section('meta_description', 'Explore Restore Global Initiative programmes: green awareness campaigns, community clean energy projects, and digital sustainability learning.')

@section('content')
    <section class="bg-teal py-20 text-cream">
        <div class="mx-auto max-w-6xl px-6">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cream/70">What We Do</p>
            <h1 class="font-display mt-3 max-w-3xl text-4xl font-extrabold md:text-5xl">Our Services &amp; Activities</h1>
            <p class="mt-6 max-w-2xl text-lg text-cream/85">Three interconnected pillars driving awareness, grassroots action, and digital learning for sustainability.</p>
        </div>
    </section>

    <section class="mx-auto max-w-4xl px-6 py-20" aria-labelledby="services-pillars" x-data="{ open: {{ $pillars->first()?->id ?? 'null' }} }">
        <h2 id="services-pillars" class="sr-only">Service pillars</h2>
        <div class="space-y-4">
            @foreach ($pillars as $pillar)
                <article class="card overflow-hidden reveal">
                    <button
                        type="button"
                        id="pillar-toggle-{{ $pillar->id }}"
                        class="flex w-full items-center justify-between gap-4 text-left"
                        @click="open = open === {{ $pillar->id }} ? null : {{ $pillar->id }}"
                        :aria-expanded="open === {{ $pillar->id }}"
                        aria-controls="pillar-panel-{{ $pillar->id }}"
                    >
                        <h3 class="font-display text-lg font-bold text-teal md:text-xl">{{ $pillar->title }}</h3>
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-teal/10 text-teal transition" :class="open === {{ $pillar->id }} && 'rotate-45 bg-teal text-cream'" aria-hidden="true">+</span>
                    </button>
                    <div
                        id="pillar-panel-{{ $pillar->id }}"
                        role="region"
                        aria-labelledby="pillar-toggle-{{ $pillar->id }}"
                        class="mt-4 border-t border-teal/10 pt-4"
                        x-show="open === {{ $pillar->id }}"
                        x-transition
                    >
                        <p class="leading-relaxed text-teal/85">{{ $pillar->content }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
