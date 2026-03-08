<?php

namespace App\Filament\Resources\Sports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Search by name')
            ->actionsColumnLabel('Actions')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Is Active'),
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
