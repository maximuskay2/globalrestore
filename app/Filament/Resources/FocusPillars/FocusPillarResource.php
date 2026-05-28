<?php

namespace App\Filament\Resources\FocusPillars;

use App\Filament\Resources\FocusPillars\Pages\CreateFocusPillar;
use App\Filament\Resources\FocusPillars\Pages\EditFocusPillar;
use App\Filament\Resources\FocusPillars\Pages\ListFocusPillars;
use App\Filament\Resources\FocusPillars\Schemas\FocusPillarForm;
use App\Filament\Resources\FocusPillars\Tables\FocusPillarsTable;
use App\Models\FocusPillar;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FocusPillarResource extends Resource
{
    protected static ?string $model = FocusPillar::class;

    protected static ?string $navigationLabel = 'Focus pillars';

    protected static ?string $modelLabel = 'focus pillar';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquaresPlus;

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return FocusPillarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FocusPillarsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFocusPillars::route('/'),
            'create' => CreateFocusPillar::route('/create'),
            'edit' => EditFocusPillar::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user instanceof User && ($user->isAdmin() || $user->isEditor());
    }
}
