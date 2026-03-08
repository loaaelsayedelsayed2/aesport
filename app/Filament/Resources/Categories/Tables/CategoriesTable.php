<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Search by name')
            ->actionsColumnLabel('Actions')
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Is Active'),
                TextColumn::make('parent.name')
                    ->label('Main Category')
                    ->sortable()
                    ->default('Main'),
                TextColumn::make('types.name')
                    ->label('Types')
                    ->badge()
                    ->separator(',')
                    ->color('danger'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->color('white'),
                DeleteAction::make()
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
            ])
            ->toolbarActions([]);
    }
}
