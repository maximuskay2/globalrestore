<?php

namespace App\Filament\Resources\ContactSubmissions\Pages;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListContactSubmissions extends ListRecords
{
    protected static string $resource = ContactSubmissionResource::class;

    public function getSubheading(): ?string
    {
        return 'Open View to read the full submission. Delete removes it from the inbox.';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
