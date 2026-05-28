<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Submission details')
                    ->description('Read-only copy of the contact form as received.')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('subject'),
                        TextEntry::make('involvement_type')
                            ->label('Involvement')
                            ->formatStateUsing(fn (string $state): string => \App\Models\ContactSubmission::involvementOptions()[$state] ?? $state),
                        TextEntry::make('message')->columnSpanFull(),
                        IconEntry::make('is_read')->boolean()->label('Read'),
                        TextEntry::make('created_at')->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
