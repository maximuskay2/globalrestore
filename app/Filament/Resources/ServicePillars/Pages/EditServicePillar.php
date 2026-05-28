<?php

namespace App\Filament\Resources\ServicePillars\Pages;

use App\Filament\Concerns\ShowsExistingRecordOnEdit;
use App\Filament\Resources\ServicePillars\ServicePillarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServicePillar extends EditRecord
{
    use ShowsExistingRecordOnEdit;

    protected static string $resource = ServicePillarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
