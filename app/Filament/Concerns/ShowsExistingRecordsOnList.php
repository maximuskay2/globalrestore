<?php

namespace App\Filament\Concerns;

trait ShowsExistingRecordsOnList
{
    public function getSubheading(): ?string
    {
        return 'Each row reflects content on the live site. Use Edit to change existing details or Delete to remove an item.';
    }
}
