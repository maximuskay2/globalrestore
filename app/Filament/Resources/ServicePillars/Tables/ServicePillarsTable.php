<?php

namespace App\Filament\Resources\ServicePillars\Tables;

use App\Enums\ServiceCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicePillarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('summary')
                    ->label('Homepage summary')
                    ->limit(70)
                    ->wrap()
                    ->toggleable(),
                TextColumn::make('category')
                    ->badge()
                    ->formatStateUsing(fn (?ServiceCategory $state): string => $state?->label() ?? '—'),
                IconColumn::make('show_on_home')->boolean()->label('Home'),
                TextColumn::make('sort_order')->sortable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
