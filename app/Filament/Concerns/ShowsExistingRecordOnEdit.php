<?php

namespace App\Filament\Concerns;

trait ShowsExistingRecordOnEdit
{
    public function getSubheading(): ?string
    {
        $record = $this->getRecord();
        $updated = $record?->updated_at;

        if ($updated) {
            return 'Last saved '.$updated->format('j M Y, H:i').'. Fields below show the current saved values — change what you need and save, or delete this record from the header.';
        }

        return 'Fields below show the current saved values. Change what you need and save, or delete this record from the header.';
    }
}
