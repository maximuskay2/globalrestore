<?php

namespace App\Filament\Resources\HomeVideoSlides;

use App\Filament\Resources\HomeVideoSlides\Pages\CreateHomeVideoSlide;
use App\Filament\Resources\HomeVideoSlides\Pages\EditHomeVideoSlide;
use App\Filament\Resources\HomeVideoSlides\Pages\ListHomeVideoSlides;
use App\Filament\Resources\HomeVideoSlides\Schemas\HomeVideoSlideForm;
use App\Filament\Resources\HomeVideoSlides\Tables\HomeVideoSlidesTable;
use App\Models\HomeVideoSlide;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeVideoSlideResource extends Resource
{
    protected static ?string $model = HomeVideoSlide::class;

    protected static ?string $navigationLabel = 'Video slider';

    protected static ?string $modelLabel = 'video slide';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPlayCircle;

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return HomeVideoSlideForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeVideoSlidesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomeVideoSlides::route('/'),
            'create' => CreateHomeVideoSlide::route('/create'),
            'edit' => EditHomeVideoSlide::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user instanceof User && ($user->isAdmin() || $user->isEditor());
    }
}
