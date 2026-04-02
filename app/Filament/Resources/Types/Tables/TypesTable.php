<?php

namespace App\Filament\Resources\Types\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class TypesTable
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
                    ->label('Type Name'),
                ToggleColumn::make('is_active')
                    ->label('Is Active'),
                TextColumn::make('products_count')
                    ->label('Product Count')
                    ->counts('products'),
            ])
            ->filters([])
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
