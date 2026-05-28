<?php

namespace App\Filament\Resources\MediaAssets\Schemas;

use App\Support\Filament\StoredFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MediaAssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Image')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, ?string $operation, $get) {
                                if ($operation === 'create' && blank($get('slug'))) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->maxLength(120)
                            ->unique(ignoreRecord: true)
                            ->helperText('Optional. Use in templates, e.g. home-hero'),
                        StoredFileUpload::apply(
                            FileUpload::make('file_path')
                                ->label('Image file')
                                ->image()
                                ->disk('public')
                                ->directory('media')
                                ->visibility('public')
                                ->maxSize(5120)
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                ->imageEditor()
                        )
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->helperText('JPEG, PNG, or WebP up to 5 MB. The current file is shown when editing — upload to replace.'),
                        TextInput::make('alt_text')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Required for accessibility and SEO.'),
                        Textarea::make('caption')
                            ->rows(2)
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
