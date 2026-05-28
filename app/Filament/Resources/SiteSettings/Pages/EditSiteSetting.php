<?php

namespace App\Filament\Resources\SiteSettings\Pages;

use App\Filament\Resources\SiteSettings\SiteSettingResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditSiteSetting extends EditRecord
{
    protected static string $resource = SiteSettingResource::class;

    protected static ?string $title = 'Global site settings';

    public function getTitle(): string|Htmlable
    {
        return 'Global site settings';
    }

    public function getSubheading(): ?string
    {
        $updated = $this->getRecord()->updated_at;

        if ($updated) {
            return 'Last saved '.$updated->format('j M Y, H:i').'. Every field below is what visitors see on the live site — edit and save to update.';
        }

        return 'Every field below is what visitors see on the live site — edit and save to update.';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): ?string
    {
        return null;
    }
}
