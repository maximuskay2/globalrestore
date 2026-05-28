<?php

namespace App\Filament\Resources\NewsletterSubscribers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NewsletterSubscriberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')->email()->required()->maxLength(255),
                TextInput::make('source')->maxLength(50)->default('footer'),
                DateTimePicker::make('subscribed_at')->required()->seconds(false),
            ]);
    }
}
