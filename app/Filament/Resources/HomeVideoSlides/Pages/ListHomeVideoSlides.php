<?php

namespace App\Filament\Resources\HomeVideoSlides\Pages;

use App\Filament\Concerns\ShowsExistingRecordsOnList;
use App\Filament\Resources\HomeVideoSlides\HomeVideoSlideResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeVideoSlides extends ListRecords
{
    use ShowsExistingRecordsOnList;

    protected static string $resource = HomeVideoSlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
