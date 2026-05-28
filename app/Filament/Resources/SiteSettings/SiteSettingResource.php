<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettings\Schemas\SiteSettingForm;
use App\Models\SiteSetting;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationLabel = 'Global settings';

    protected static ?string $modelLabel = 'site settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return SiteSettingForm::configure($schema);
    }

    public static function getPages(): array
    {
        return [
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => SiteSetting::current()]);
    }

    /**
     * The Welcome widget calls `getUrl()` without a page name, which defaults to "index".
     * This resource is a singleton, so we route "index" to the edit page.
     *
     * @param  array<mixed>  $parameters
     */
    public static function getIndexUrl(
        array $parameters = [],
        bool $isAbsolute = true,
        ?string $panel = null,
        ?Model $tenant = null,
        bool $shouldGuessMissingParameters = false
    ): string {
        return static::getUrl(
            'edit',
            ['record' => SiteSetting::current()],
            $isAbsolute,
            $panel,
            $tenant,
            $shouldGuessMissingParameters
        );
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        return static::authorizeUser();
    }

    protected static function authorizeUser(): bool
    {
        $user = auth()->user();

        return $user instanceof User && $user->isAdmin();
    }
}
