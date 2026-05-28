<?php

namespace App\Filament\Resources\MediaAssets\Pages;

use App\Filament\Concerns\ShowsExistingRecordsOnList;
use App\Filament\Resources\MediaAssets\MediaAssetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMediaAssets extends ListRecords
{
    use ShowsExistingRecordsOnList;

    protected static string $resource = MediaAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
