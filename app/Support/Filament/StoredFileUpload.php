<?php

namespace App\Support\Filament;

use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Arr;

class StoredFileUpload
{
    /**
     * FileUpload expects an array of paths; the database stores a single path string.
     */
    public static function apply(FileUpload $field): FileUpload
    {
        return $field
            ->formatStateUsing(
                fn (mixed $state): array => filled($state)
                    ? (is_array($state) ? array_values($state) : [$state])
                    : []
            )
            ->dehydrateStateUsing(
                fn (mixed $state): ?string => is_array($state)
                    ? (Arr::first(array_filter($state)) ?: null)
                    : (filled($state) ? (string) $state : null)
            );
    }
}
