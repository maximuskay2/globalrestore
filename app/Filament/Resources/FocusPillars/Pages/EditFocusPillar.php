<?php

namespace App\Filament\Resources\FocusPillars\Pages;

use App\Filament\Concerns\ShowsExistingRecordOnEdit;
use App\Filament\Resources\FocusPillars\FocusPillarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFocusPillar extends EditRecord
{
    use ShowsExistingRecordOnEdit;

    protected static string $resource = FocusPillarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
