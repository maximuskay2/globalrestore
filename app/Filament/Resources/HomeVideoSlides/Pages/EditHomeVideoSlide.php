<?php

namespace App\Filament\Resources\HomeVideoSlides\Pages;

use App\Filament\Concerns\ShowsExistingRecordOnEdit;
use App\Filament\Resources\HomeVideoSlides\HomeVideoSlideResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeVideoSlide extends EditRecord
{
    use ShowsExistingRecordOnEdit;

    protected static string $resource = HomeVideoSlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
