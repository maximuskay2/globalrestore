<?php

namespace App\Filament\Resources\ServicePillars\Pages;

use App\Filament\Concerns\ShowsExistingRecordsOnList;
use App\Filament\Resources\ServicePillars\ServicePillarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServicePillars extends ListRecords
{
    use ShowsExistingRecordsOnList;

    protected static string $resource = ServicePillarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
