@php
    use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
    use App\Filament\Resources\MissionSections\MissionSectionResource;
    use App\Filament\Resources\NewsPosts\NewsPostResource;
    use App\Filament\Resources\SiteSettings\SiteSettingResource;
    use App\Models\User;

    /** @var User|null $user */
    $user = auth()->user();
    $siteUrl = url('/');
@endphp

<x-filament-widgets::widget>
    <div class="fi-rgi-welcome">
        <p class="fi-rgi-welcome__eyebrow">Restore Global Initiative</p>
        <h2 class="fi-rgi-welcome__title">
            {{ $user?->isAdmin() ? 'Admin command centre' : 'Content workspace' }}
        </h2>
        <p class="fi-rgi-welcome__text">
            @if ($user?->isAdmin())
                Manage mission copy, services, news, media, contact submissions, and site settings — everything that powers the public website.
            @else
                Update mission sections, service pillars, and news articles. Contact submissions and site settings are managed by administrators.
            @endif
        </p>

        <div class="fi-rgi-quick-actions">
            <a href="{{ $siteUrl }}" target="_blank" rel="noopener noreferrer" class="fi-rgi-quick-action">
                <x-filament::icon icon="heroicon-m-arrow-top-right-on-square" class="h-4 w-4" />
                View live site
            </a>

            <a href="{{ NewsPostResource::getUrl() }}" class="fi-rgi-quick-action fi-rgi-quick-action--muted">
                <x-filament::icon icon="heroicon-m-newspaper" class="h-4 w-4" />
                News & blog
            </a>

            <a href="{{ MissionSectionResource::getUrl() }}" class="fi-rgi-quick-action fi-rgi-quick-action--muted">
                <x-filament::icon icon="heroicon-m-book-open" class="h-4 w-4" />
                Mission
            </a>

            @if ($user?->isAdmin())
                <a href="{{ ContactSubmissionResource::getUrl() }}" class="fi-rgi-quick-action fi-rgi-quick-action--muted">
                    <x-filament::icon icon="heroicon-m-inbox" class="h-4 w-4" />
                    Inbox
                </a>

                <a href="{{ SiteSettingResource::getUrl() }}" class="fi-rgi-quick-action fi-rgi-quick-action--muted">
                    <x-filament::icon icon="heroicon-m-cog-6-tooth" class="h-4 w-4" />
                    Site settings
                </a>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
