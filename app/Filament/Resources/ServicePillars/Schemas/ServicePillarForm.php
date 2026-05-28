<?php

namespace App\Filament\Resources\ServicePillars\Schemas;

use App\Enums\ServiceCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServicePillarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service details')
                    ->schema([
                        TextInput::make('title')
                            ->label('Service name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Select::make('category')
                            ->options(ServiceCategory::options())
                            ->native(false)
                            ->helperText('Used on the homepage to group vocational vs community offerings.'),
                        TextInput::make('sort_order')->numeric()->default(0)->required(),
                        Toggle::make('is_active')->default(true),
                        Toggle::make('show_on_home')
                            ->label('Show on homepage')
                            ->default(false)
                            ->helperText('When enabled, appears in the landing page training & services section.'),
                    ])
                    ->columns(2),
                Textarea::make('summary')
                    ->label('Homepage summary')
                    ->rows(5)
                    ->helperText('Short text for the homepage (bullet points welcome). Full copy below is used on the Services page.')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Full description (Services page)')
                    ->required()
                    ->rows(8)
                    ->columnSpanFull(),
            ]);
    }
}
