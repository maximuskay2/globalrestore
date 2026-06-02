<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General')
                    ->description('Core site identity and footer copy shown on every page.')
                    ->schema([
                        TextInput::make('site_name')->required()->maxLength(255),
                        Textarea::make('footer_statement')
                            ->label('CIC footer statement')
                            ->required()
                            ->rows(3)
                            ->helperText('Legal notice shown in the site footer.'),
                        TextInput::make('companies_house_number')
                            ->label('Companies House number')
                            ->maxLength(20)
                            ->helperText('Optional. Shown in the footer when provided (e.g. 12345678).'),
                    ]),
                Section::make('Homepage hero')
                    ->description('Navigation bar CTA and hero header copy.')
                    ->schema([
                        TextInput::make('hero_headline')
                            ->label('Hero title')
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),
                        Textarea::make('hero_subheadline')
                            ->label('Hero subtitle')
                            ->rows(4)
                            ->columnSpanFull(),
                        FileUpload::make('hero_background_paths')
                            ->label('Hero background images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->directory('site/hero')
                            ->disk('public')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('Upload multiple images for auto-sliding hero backgrounds. Drag to reorder display sequence.')
                            ->columnSpanFull(),
                        TextInput::make('hero_cta_text')
                            ->label('Primary CTA button text')
                            ->maxLength(80)
                            ->default('Get Involved'),
                        TextInput::make('hero_cta_url')
                            ->label('Primary CTA button URL')
                            ->url()
                            ->maxLength(500)
                            ->helperText('Leave empty to link to the contact page.'),
                    ])
                    ->columns(2),
                Section::make('Impact statistics')
                    ->description('Large counters on the homepage impact banner.')
                    ->schema([
                        TextInput::make('impact_stat_1_number')->label('Stat 1 — number')->maxLength(32),
                        TextInput::make('impact_stat_1_label')->label('Stat 1 — label')->maxLength(255),
                        TextInput::make('impact_stat_2_number')->label('Stat 2 — number')->maxLength(32),
                        TextInput::make('impact_stat_2_label')->label('Stat 2 — label')->maxLength(255),
                        TextInput::make('impact_stat_3_number')->label('Stat 3 — number')->maxLength(32),
                        TextInput::make('impact_stat_3_label')->label('Stat 3 — label')->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('Homepage video slider')
                    ->description('Controls the copy and CTA shown beside the homepage video slider section.')
                    ->schema([
                        TextInput::make('video_slider_heading')
                            ->label('Section heading')
                            ->maxLength(255),
                        Textarea::make('video_slider_description')
                            ->label('Section description')
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('video_slider_cta_text')
                            ->label('CTA button text')
                            ->maxLength(80),
                        TextInput::make('video_slider_cta_url')
                            ->label('CTA button URL')
                            ->url()
                            ->maxLength(500)
                            ->helperText('Leave empty to link to the contact page on the current domain.'),
                    ])
                    ->columns(2),
                Section::make('SEO defaults')
                    ->schema([
                        Textarea::make('meta_description_default')
                            ->rows(3)
                            ->maxLength(320)
                            ->helperText('Used when a page does not set its own meta description (max ~160 characters recommended).')
                            ->columnSpanFull(),
                    ]),
                Section::make('Contact & social')
                    ->schema([
                        TextInput::make('contact_email')->email()->required(),
                        TextInput::make('instagram_url')->url(),
                        TextInput::make('x_url')->label('X (Twitter) URL')->url(),
                        TextInput::make('linkedin_url')->url(),
                        TextInput::make('facebook_url')->url(),
                    ])
                    ->columns(2),
                Section::make('Footer legal links')
                    ->schema([
                        TextInput::make('privacy_policy_url')
                            ->label('Privacy policy URL')
                            ->url()
                            ->maxLength(500),
                        TextInput::make('terms_url')
                            ->label('Terms of service URL')
                            ->url()
                            ->maxLength(500),
                    ])
                    ->columns(2),
            ]);
    }
}
