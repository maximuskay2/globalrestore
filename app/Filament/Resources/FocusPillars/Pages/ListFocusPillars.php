<?php

namespace App\Filament\Resources\FocusPillars\Pages;

use App\Filament\Concerns\ShowsExistingRecordsOnList;
use App\Filament\Resources\FocusPillars\FocusPillarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFocusPillars extends ListRecords
{
    use ShowsExistingRecordsOnList;

    protected static string $resource = FocusPillarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
