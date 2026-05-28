<?php

namespace App\Filament\Resources\NewsPosts\Pages;

use App\Filament\Concerns\ShowsExistingRecordOnEdit;
use App\Filament\Resources\NewsPosts\NewsPostResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNewsPost extends EditRecord
{
    use ShowsExistingRecordOnEdit;

    protected static string $resource = NewsPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
