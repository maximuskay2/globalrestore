@extends('layouts.app')

@section('title', 'Contact — ' . $settings->site_name)
@section('meta_description', 'Contact Restore Global Initiative to volunteer, partner, or request support. Email, Instagram, and X links available.')

@section('content')
    <section class="bg-teal py-20 text-cream">
        <div class="mx-auto max-w-6xl px-6">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cream/70">Get Involved</p>
            <h1 class="font-display mt-3 text-4xl font-extrabold md:text-5xl">Contact Us</h1>
            <p class="mt-6 max-w-2xl text-lg text-cream/85">Volunteer, partner, or request support — we would love to hear from you.</p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-20">
        <div class="grid gap-16 lg:grid-cols-2">
            <div class="reveal">
                <h2 class="font-display text-2xl font-bold text-teal">Reach out directly</h2>
                <p class="mt-4 leading-relaxed text-teal/80">Email us or connect on social media. We aim to respond within a few working days.</p>

                <ul class="mt-8 space-y-4">
                    <li>
                        <span class="text-xs font-semibold uppercase tracking-wider text-teal/60">Email</span>
                        <a href="mailto:{{ $settings->contact_email }}" class="mt-1 block text-lg font-semibold text-teal hover:underline">{{ $settings->contact_email }}</a>
                    </li>
                    <li>
                        <span class="text-xs font-semibold uppercase tracking-wider text-teal/60">Instagram</span>
                        <a href="{{ $settings->instagram_url }}" class="mt-1 block font-semibold text-teal hover:underline" target="_blank" rel="noopener noreferrer">@restore_global_initiative</a>
                    </li>
                    <li>
                        <span class="text-xs font-semibold uppercase tracking-wider text-teal/60">X</span>
                        <a href="{{ $settings->x_url }}" class="mt-1 block font-semibold text-teal hover:underline" target="_blank" rel="noopener noreferrer">@RestoreGlobal_</a>
                    </li>
                </ul>
            </div>

            <div class="card reveal">
                @if (session('success'))
                    <div class="mb-6 rounded-xl bg-teal/10 px-4 py-3 text-sm font-medium text-teal" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                    @csrf
                    <div class="hidden" aria-hidden="true">
                        <label for="company">Company</label>
                        <input type="text" name="company" id="company" tabindex="-1" autocomplete="off">
                    </div>

                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autocomplete="name" @class(['form-input', 'form-input-error' => $errors->has('name')]) @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                        @error('name')<p id="name-error" class="form-error" role="alert">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" @class(['form-input', 'form-input-error' => $errors->has('email')]) @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                        @error('email')<p id="email-error" class="form-error" role="alert">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required @class(['form-input', 'form-input-error' => $errors->has('subject')]) @error('subject') aria-invalid="true" aria-describedby="subject-error" @enderror>
                        @error('subject')<p id="subject-error" class="form-error" role="alert">{{ $message }}</p>@enderror
                    </div>

                    <fieldset>
                        <legend class="form-label">How would you like to get involved?</legend>
                        <div class="mt-3 space-y-3">
                            @foreach ($involvementOptions as $value => $label)
                                <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-teal/15 px-4 py-3 transition hover:border-teal/40 has-[:checked]:border-teal has-[:checked]:bg-teal/5">
                                    <input type="radio" name="involvement_type" value="{{ $value }}" @checked(old('involvement_type') === $value) required class="mt-1 text-teal focus:ring-teal">
                                    <span class="text-sm font-medium text-teal">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('involvement_type')<p id="involvement-error" class="form-error" role="alert">{{ $message }}</p>@enderror
                    </fieldset>

                    <div>
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" rows="5" required @class(['form-input', 'form-input-error' => $errors->has('message')]) @error('message') aria-invalid="true" aria-describedby="message-error" @enderror>{{ old('message') }}</textarea>
                        @error('message')<p id="message-error" class="form-error" role="alert">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn-primary w-full sm:w-auto">Send message</button>
                </form>
            </div>
        </div>
    </section>
@endsection
