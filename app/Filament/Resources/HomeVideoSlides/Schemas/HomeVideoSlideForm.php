<?php

namespace App\Filament\Resources\HomeVideoSlides\Schemas;

use App\Support\Filament\StoredFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomeVideoSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slide content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('video_url')
                            ->label('YouTube / Vimeo / direct video URL')
                            ->url()
                            ->maxLength(500)
                            ->helperText('Optional if uploading a file. Supports YouTube, Vimeo, or direct MP4/WebM links.')
                            ->columnSpanFull(),
                        StoredFileUpload::apply(
                            FileUpload::make('video_file_path')
                                ->label('Upload video file')
                                ->disk('public')
                                ->directory('home/videos')
                                ->visibility('public')
                                ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime'])
                                ->maxSize(102400)
                        )
                            ->required(fn (string $operation, $get): bool => $operation === 'create' && blank($get('video_url')))
                            ->helperText('MP4, WebM, or MOV up to 100 MB.'),
                        StoredFileUpload::apply(
                            FileUpload::make('thumbnail_path')
                                ->label('Thumbnail image')
                                ->image()
                                ->disk('public')
                                ->directory('home/videos')
                                ->visibility('public')
                                ->imageEditor()
                        )
                            ->helperText('Shown as slide preview image.'),
                        Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
