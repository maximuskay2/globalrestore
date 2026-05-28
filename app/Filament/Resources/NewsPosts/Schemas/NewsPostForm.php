<?php

namespace App\Filament\Resources\NewsPosts\Schemas;

use App\Support\Filament\StoredFileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Textarea::make('excerpt')
                    ->rows(3)
                    ->maxLength(500)
                    ->helperText('Short summary for the news listing page.')
                    ->columnSpanFull(),
                StoredFileUpload::apply(
                    FileUpload::make('featured_image_path')
                        ->label('Featured image')
                        ->image()
                        ->directory('news/featured')
                        ->disk('public')
                        ->visibility('public')
                        ->imageEditor()
                )
                    ->helperText('Current featured image is shown below when one is saved. Upload to replace or clear to remove.')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->required()
                    ->rows(12)
                    ->columnSpanFull(),
                DateTimePicker::make('published_at')
                    ->seconds(false)
                    ->native(false),
                Toggle::make('is_published')
                    ->default(false)
                    ->helperText('Only published posts with a date appear on the site.'),
            ]);
    }
}
