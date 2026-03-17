<?php

namespace App\Filament\Resources\Coupons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CouponsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Search by name')
            ->actionsColumnLabel('Actions')
            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Type'),
                TextColumn::make('discount_type')
                    ->label('DiscountType'),
                TextColumn::make('discount_amount')
                    ->label('Value'),
                TextColumn::make('expiry_date')
                    ->label('Duration'),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ((int) $state) {
                        0 => 'Inactive',
                        1 => 'Active',
                    })
                    ->color(fn($state) => match ((int) $state) {
                        0 => 'warning',
                        1 => 'success',
                    }),
                TextColumn::make('usage_limit')->label('Usage'),
                TextColumn::make('expiry_date')
                    ->label('Duration')
                    ->formatStateUsing(fn($state, $record) => $record->start_date . " / " . "\n" . $state),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->color('white'),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
            ])
            ->toolbarActions([]);
    }
}
