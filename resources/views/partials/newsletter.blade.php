<section class="bg-teal/5 border-y border-teal/10" aria-labelledby="newsletter-heading">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <div class="mx-auto max-w-xl text-center">
            <h2 id="newsletter-heading" class="font-display text-2xl font-bold text-teal">Stay in the loop</h2>
            <p class="mt-3 text-teal/80">Get occasional updates on programmes, events, and ways to get involved.</p>

            @if (session('newsletter_success'))
                <p class="mt-6 rounded-xl bg-teal/10 px-4 py-3 text-sm font-medium text-teal" role="status">
                    {{ session('newsletter_success') }}
                </p>
            @endif

            <form method="POST" action="{{ route('newsletter.store') }}" class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-start">
                @csrf
                <input type="hidden" name="source" value="footer">
                <div class="flex-1 text-left">
                    <label for="newsletter-email" class="sr-only">Email address</label>
                    <input
                        type="email"
                        name="email"
                        id="newsletter-email"
                        required
                        autocomplete="email"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        @class(['form-input', 'form-input-error' => $errors->has('email')])
                        @error('email') aria-invalid="true" aria-describedby="newsletter-email-error" @enderror
                    >
                    @error('email')
                        <p id="newsletter-email-error" class="form-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn-primary shrink-0">Subscribe</button>
            </form>
        </div>
    </div>
</section>
