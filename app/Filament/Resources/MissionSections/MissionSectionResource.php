<?php

namespace App\Filament\Resources\MissionSections;

use App\Filament\Resources\MissionSections\Pages\CreateMissionSection;
use App\Filament\Resources\MissionSections\Pages\EditMissionSection;
use App\Filament\Resources\MissionSections\Pages\ListMissionSections;
use App\Filament\Resources\MissionSections\Schemas\MissionSectionForm;
use App\Filament\Resources\MissionSections\Tables\MissionSectionsTable;
use App\Models\MissionSection;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MissionSectionResource extends Resource
{
    protected static ?string $model = MissionSection::class;

    protected static ?string $navigationLabel = 'Mission sections';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return MissionSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MissionSectionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMissionSections::route('/'),
            'create' => CreateMissionSection::route('/create'),
            'edit' => EditMissionSection::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user instanceof User && ($user->isAdmin() || $user->isEditor());
    }
}
