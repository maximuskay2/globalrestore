<?php

namespace App\Filament\Resources\ServicePillars;

use App\Filament\Resources\ServicePillars\Pages\CreateServicePillar;
use App\Filament\Resources\ServicePillars\Pages\EditServicePillar;
use App\Filament\Resources\ServicePillars\Pages\ListServicePillars;
use App\Filament\Resources\ServicePillars\Schemas\ServicePillarForm;
use App\Filament\Resources\ServicePillars\Tables\ServicePillarsTable;
use App\Models\ServicePillar;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServicePillarResource extends Resource
{
    protected static ?string $model = ServicePillar::class;

    protected static ?string $navigationLabel = 'Services & qualifications';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ServicePillarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServicePillarsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServicePillars::route('/'),
            'create' => CreateServicePillar::route('/create'),
            'edit' => EditServicePillar::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user instanceof User && ($user->isAdmin() || $user->isEditor());
    }
}
