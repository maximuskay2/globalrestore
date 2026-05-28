<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Resources\MediaAssets\MediaAssetResource;
use App\Filament\Resources\MissionSections\MissionSectionResource;
use App\Filament\Resources\NewsPosts\NewsPostResource;
use App\Filament\Resources\NewsletterSubscribers\NewsletterSubscriberResource;
use App\Filament\Resources\ServicePillars\ServicePillarResource;
use App\Models\ContactSubmission;
use App\Models\MediaAsset;
use App\Models\MissionSection;
use App\Models\NewsPost;
use App\Models\NewsletterSubscriber;
use App\Models\ServicePillar;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = -1;

    protected int|string|array $columnSpan = 'full';

    protected ?string $heading = 'At a glance';

    protected ?string $description = 'Key counts across your content and engagement';

    /**
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        /** @var User|null $user */
        $user = auth()->user();

        $stats = [
            Stat::make('Mission sections', MissionSection::query()->count())
                ->description('About page blocks')
                ->descriptionIcon(Heroicon::OutlinedBookOpen)
                ->icon(Heroicon::OutlinedBookOpen)
                ->color('primary')
                ->url(MissionSectionResource::getUrl()),

            Stat::make('Service pillars', ServicePillar::query()->count())
                ->description('Services accordion items')
                ->descriptionIcon(Heroicon::OutlinedSquares2x2)
                ->icon(Heroicon::OutlinedSquares2x2)
                ->color('primary')
                ->url(ServicePillarResource::getUrl()),

            Stat::make('News articles', NewsPost::query()->count())
                ->description(
                    NewsPost::query()->published()->count().' published'
                )
                ->descriptionIcon(Heroicon::OutlinedNewspaper)
                ->icon(Heroicon::OutlinedNewspaper)
                ->color('success')
                ->url(NewsPostResource::getUrl()),

            Stat::make('Media assets', MediaAsset::query()->count())
                ->description('Images & files')
                ->descriptionIcon(Heroicon::OutlinedPhoto)
                ->icon(Heroicon::OutlinedPhoto)
                ->color('gray')
                ->url(MediaAssetResource::getUrl()),
        ];

        if ($user?->isAdmin()) {
            $unread = ContactSubmission::query()->where('is_read', false)->count();

            array_unshift(
                $stats,
                Stat::make('Contact submissions', ContactSubmission::query()->count())
                    ->description($unread > 0 ? "{$unread} unread" : 'All caught up')
                    ->descriptionIcon($unread > 0 ? Heroicon::OutlinedBellAlert : Heroicon::OutlinedInbox)
                    ->descriptionColor($unread > 0 ? 'warning' : 'success')
                    ->icon(Heroicon::OutlinedInbox)
                    ->color($unread > 0 ? 'warning' : 'primary')
                    ->url(ContactSubmissionResource::getUrl()),
            );

            $stats[] = Stat::make('Newsletter subscribers', NewsletterSubscriber::query()->count())
                ->description('Footer signups')
                ->descriptionIcon(Heroicon::OutlinedEnvelope)
                ->icon(Heroicon::OutlinedEnvelope)
                ->color('info')
                ->url(NewsletterSubscriberResource::getUrl());
        }

        return $stats;
    }
}
