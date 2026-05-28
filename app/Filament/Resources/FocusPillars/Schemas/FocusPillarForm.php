<?php

namespace App\Filament\Resources\FocusPillars\Schemas;

use App\Support\FocusPillarIcons;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FocusPillarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                Textarea::make('description')->required()->rows(4)->columnSpanFull(),
                Select::make('icon')
                    ->options(FocusPillarIcons::options())
                    ->default('sparkles')
                    ->required()
                    ->native(false),
                TextInput::make('sort_order')->numeric()->default(0)->required(),
                Toggle::make('is_active')->default(true),
            ]);
    }
}
