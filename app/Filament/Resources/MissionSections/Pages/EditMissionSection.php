<?php

namespace App\Filament\Resources\MissionSections\Pages;

use App\Filament\Concerns\ShowsExistingRecordOnEdit;
use App\Filament\Resources\MissionSections\MissionSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMissionSection extends EditRecord
{
    use ShowsExistingRecordOnEdit;

    protected static string $resource = MissionSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
