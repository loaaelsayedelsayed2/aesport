<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Search by name')
            ->actionsColumnLabel('Actions')
            ->columns([
                ImageColumn::make('main_image')
                    ->label('Image')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Name')
                    ->limit(10)
                    ->searchable(),
                TextColumn::make('model_number')
                    ->label('SKU'),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('red')
                    ->separator(','),
                TextColumn::make('quantity')
                    ->label('Stock'),
                TextColumn::make('price')
                    ->label('Price'),
                TextColumn::make('in_stock')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match((int) $state) {
                        0 => 'Out of Stock',
                        1 => 'In Stock',
                    })
                    ->color(fn ($state) => match((int) $state) {
                        0 => 'danger',
                        1 => 'success',
                    }),

                ToggleColumn::make('is_active')
                    ->label('Is Active'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->color('white'),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
            ])
            ->toolbarActions([
            ]);
    }
}
