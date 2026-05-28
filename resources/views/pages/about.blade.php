@extends('layouts.app')

@section('title', 'About Us — ' . $settings->site_name)
@section('meta_description', 'Learn how Restore Global Initiative supports vulnerable households, women, and young adults through inclusive climate action and green skills in the UK.')

@section('content')
    <section class="bg-teal py-20 text-cream">
        <div class="mx-auto max-w-6xl px-6">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cream/70">About Us</p>
            <h1 class="font-display mt-3 max-w-3xl text-4xl font-extrabold md:text-5xl">Our Mission</h1>
            <p class="mt-6 max-w-2xl text-lg text-cream/85">Restore Global Initiative exists to empower communities through inclusive climate action, green skills, and sustainable livelihoods.</p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-20" aria-labelledby="mission-sections">
        <h2 id="mission-sections" class="sr-only">Mission focus areas</h2>
        <div class="space-y-10">
            @foreach ($sections as $section)
                <article class="card reveal border-l-4 border-teal pl-8 md:pl-10">
                    <h3 class="font-display text-2xl font-bold text-teal">{{ $section->title }}</h3>
                    <p class="mt-4 text-lg leading-relaxed text-teal/85">{{ $section->content }}</p>
                </article>
            @endforeach
        </div>
    </section>
@endsection
