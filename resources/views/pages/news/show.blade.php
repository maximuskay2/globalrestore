@extends('layouts.app')

@section('title', $post->title . ' — ' . $settings->site_name)
@section('meta_description', $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 160))

@section('content')
    @php
        $postUrl = route('news.show', $post->slug);
        $encodedUrl = urlencode($postUrl);
        $encodedTitle = urlencode($post->title);
    @endphp

    <article class="mx-auto max-w-3xl px-6 py-20">
        <a href="{{ route('news.index') }}" class="text-sm font-semibold text-teal hover:underline">&larr; All news</a>

        <header class="mt-8">
            <time datetime="{{ $post->published_at->toDateString() }}" class="text-xs font-semibold uppercase tracking-wider text-teal/60">
                {{ $post->published_at->format('j F Y') }}
            </time>
            <h1 class="font-display mt-3 text-4xl font-extrabold text-teal md:text-5xl">{{ $post->title }}</h1>
        </header>

        <div class="prose prose-teal mt-10 max-w-none leading-relaxed text-teal/90">
            {!! nl2br(e($post->content)) !!}
        </div>

        <section class="mt-12 rounded-2xl border border-teal/10 bg-white p-6 shadow-sm">
            <h2 class="font-display text-xl font-bold text-teal">Follow & share this impact update</h2>

            <div class="mt-5 flex flex-wrap gap-3">
                @if ($settings->linkedin_url)
                    <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="btn-primary">Follow on LinkedIn</a>
                @endif
                @if ($settings->facebook_url)
                    <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer" class="btn-primary">Visit Facebook</a>
                @endif
                @if ($settings->instagram_url)
                    <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener noreferrer" class="btn-primary">Visit Instagram</a>
                @endif
                @if ($settings->x_url)
                    <a href="{{ $settings->x_url }}" target="_blank" rel="noopener noreferrer" class="btn-primary">Visit X</a>
                @endif
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedUrl }}" target="_blank" rel="noopener noreferrer" class="btn-cream">Share on Facebook</a>
                <a href="https://twitter.com/intent/tweet?text={{ $encodedTitle }}&url={{ $encodedUrl }}" target="_blank" rel="noopener noreferrer" class="btn-cream">Share on X</a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $encodedUrl }}" target="_blank" rel="noopener noreferrer" class="btn-cream">Share on LinkedIn</a>
                <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . $postUrl) }}" target="_blank" rel="noopener noreferrer" class="btn-cream">Share on WhatsApp</a>
            </div>
        </section>

        <section id="comments" class="mt-12">
            <h2 class="font-display text-2xl font-bold text-teal">Comments from users</h2>

            @if (session('comment_success'))
                <div class="mt-4 rounded-xl bg-teal/10 px-4 py-3 text-sm font-medium text-teal" role="status">
                    {{ session('comment_success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('news.comments.store', $post->slug) }}" class="mt-6 space-y-5 rounded-2xl border border-teal/10 bg-white p-6 shadow-sm">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" type="text" required value="{{ old('name') }}" @class(['form-input', 'form-input-error' => $errors->has('name')])>
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}" @class(['form-input', 'form-input-error' => $errors->has('email')])>
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label for="comment" class="form-label">Comment</label>
                    <textarea id="comment" name="comment" rows="5" required @class(['form-input', 'form-input-error' => $errors->has('comment')])>{{ old('comment') }}</textarea>
                    @error('comment')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-primary">Post comment</button>
            </form>

            <div class="mt-8 space-y-4">
                @forelse ($comments as $comment)
                    <article class="rounded-2xl border border-teal/10 bg-white p-5 shadow-sm">
                        <p class="text-sm font-semibold text-teal">{{ $comment->name }}</p>
                        <time class="mt-1 block text-xs uppercase tracking-wide text-teal/55">{{ $comment->created_at->format('j M Y, H:i') }}</time>
                        <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-teal/85">{{ $comment->comment }}</p>
                    </article>
                @empty
                    <p class="text-sm text-teal/70">No comments yet. Be the first to add one.</p>
                @endforelse
            </div>
        </section>
    </article>
@endsection
