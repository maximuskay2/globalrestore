<?php

namespace App\Filament\Resources\MissionSections\Pages;

use App\Filament\Concerns\ShowsExistingRecordsOnList;
use App\Filament\Resources\MissionSections\MissionSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMissionSections extends ListRecords
{
    use ShowsExistingRecordsOnList;

    protected static string $resource = MissionSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
