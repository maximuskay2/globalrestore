<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static string|null $navigationLabel = 'Dashboard';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    public function getTitle(): string|Htmlable
    {
        return 'Dashboard';
    }

    public function getHeading(): string|Htmlable|null
    {
        $name = auth()->user()?->name;

        return $name
            ? "Welcome back, {$name}"
            : 'Welcome back';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Your command centre for site content, submissions, and settings.';
    }

    /**
     * @return int|array<string, int|null>
     */
    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'lg' => 2,
            'xl' => 3,
        ];
    }
}
