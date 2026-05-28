@php
    use Filament\Support\Enums\Width;

    $livewire ??= null;
    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= (filament()->getSimplePageMaxContentWidth() ?? Width::Large);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }

    $brandName = config('brand.name');
    $heroHeadline = config('brand.hero.headline');
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    <div class="fi-rgi-auth">
        <aside class="fi-rgi-auth__brand" aria-hidden="true">
            <div class="fi-rgi-auth__brand-inner">
                <img
                    src="{{ asset('images/brand/logo.svg') }}"
                    alt=""
                    class="fi-rgi-auth__logo"
                    width="160"
                    height="48"
                />

                <h1 class="fi-rgi-auth__headline">
                    {{ $heroHeadline }}
                </h1>

                <p class="fi-rgi-auth__tagline">
                    Secure content management for mission copy, services, news, and community engagement.
                </p>

                <ul class="fi-rgi-auth__features">
                    <li class="fi-rgi-auth__feature">
                        <span class="fi-rgi-auth__feature-icon" aria-hidden="true">
                            <x-filament::icon icon="heroicon-m-shield-check" class="h-4 w-4" />
                        </span>
                        <span>Role-based access for admins and editors</span>
                    </li>
                    <li class="fi-rgi-auth__feature">
                        <span class="fi-rgi-auth__feature-icon" aria-hidden="true">
                            <x-filament::icon icon="heroicon-m-globe-alt" class="h-4 w-4" />
                        </span>
                        <span>Manage the public website from one place</span>
                    </li>
                    <li class="fi-rgi-auth__feature">
                        <span class="fi-rgi-auth__feature-icon" aria-hidden="true">
                            <x-filament::icon icon="heroicon-m-inbox" class="h-4 w-4" />
                        </span>
                        <span>Review contact submissions and newsletter signups</span>
                    </li>
                </ul>

                <p class="relative z-10 mt-8 text-xs text-white/50">
                    {{ config('brand.legal.footer_statement') }}
                </p>
            </div>
        </aside>

        <div class="fi-rgi-auth__panel">
            <div class="fi-rgi-auth-mobile-brand">
                <img src="{{ asset('images/brand/logo.svg') }}" alt="{{ $brandName }}" width="140" height="42" />
                <span>{{ $brandName }}</span>
            </div>

            <div class="fi-simple-layout fi-rgi-auth-page w-full max-w-md">
                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $renderHookScopes) }}

                <div class="fi-simple-main-ctn w-full">
                    <main
                        @class([
                            'fi-simple-main w-full',
                            ($maxContentWidth instanceof Width) ? "fi-width-{$maxContentWidth->value}" : $maxContentWidth,
                        ])
                    >
                        {{ $slot }}
                    </main>
                </div>

                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $renderHookScopes) }}
                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
            </div>
        </div>
    </div>
</x-filament-panels::layout.base>
