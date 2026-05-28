<footer class="mt-24 bg-teal text-cream">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <div class="grid gap-12 md:grid-cols-3">
            <div>
                <img src="{{ asset('images/brand/logo-192.png') }}" alt="{{ $settings->site_name }} logo" class="mb-4 h-14 w-14" width="56" height="56" loading="lazy" decoding="async">
                <p class="font-display text-lg font-bold">{{ $settings->site_name }}</p>
                <p class="mt-3 text-sm leading-relaxed text-cream/80">{{ $settings->footer_statement }}</p>
                @if ($settings->companies_house_number)
                    <p class="mt-2 text-xs text-cream/60">Company number {{ $settings->companies_house_number }}</p>
                @endif
            </div>

            <div>
                <h2 class="font-display text-sm font-bold uppercase tracking-wider text-cream/70">Explore</h2>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link">Our Services</a></li>
                    <li><a href="{{ route('news.index') }}" class="footer-link">News &amp; Impact</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link">Contact</a></li>
                    @if ($settings->privacy_policy_url)
                        <li><a href="{{ $settings->privacy_policy_url }}" class="footer-link" target="_blank" rel="noopener noreferrer">Privacy policy</a></li>
                    @endif
                    @if ($settings->terms_url)
                        <li><a href="{{ $settings->terms_url }}" class="footer-link" target="_blank" rel="noopener noreferrer">Terms of service</a></li>
                    @endif
                </ul>
            </div>

            <div>
                <h2 class="font-display text-sm font-bold uppercase tracking-wider text-cream/70">Connect</h2>
                <ul class="mt-4 space-y-2 text-sm">
                    <li>
                        <a href="mailto:{{ $settings->contact_email }}" class="footer-link">{{ $settings->contact_email }}</a>
                    </li>
                    <li>
                        <a href="{{ $settings->instagram_url }}" class="footer-link" target="_blank" rel="noopener noreferrer">Instagram</a>
                    </li>
                    <li>
                        <a href="{{ $settings->x_url }}" class="footer-link" target="_blank" rel="noopener noreferrer">X (Twitter)</a>
                    </li>
                    @if ($settings->linkedin_url)
                        <li>
                            <a href="{{ $settings->linkedin_url }}" class="footer-link" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        </li>
                    @endif
                    @if ($settings->facebook_url)
                        <li>
                            <a href="{{ $settings->facebook_url }}" class="footer-link" target="_blank" rel="noopener noreferrer">Facebook</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="mt-12 border-t border-cream/15 pt-8 text-center text-xs text-cream/60">
            &copy; {{ date('Y') }} {{ $settings->site_name }}. Registered UK Community Interest Company. All rights reserved.
        </div>
    </div>
</footer>
