<?php

namespace App\Filament\Resources\Sports;

use App\Filament\Resources\Sports\Pages\CreateSports;
use App\Filament\Resources\Sports\Pages\EditSports;
use App\Filament\Resources\Sports\Pages\ListSports;
use App\Filament\Resources\Sports\Schemas\SportsForm;
use App\Filament\Resources\Sports\Tables\SportsTable;
use App\Models\Sport;
use App\Models\Sports;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SportsResource extends Resource
{
    protected static ?string $model = Sport::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $recordTitleAttribute = 'Sports';
    protected static ?string $navigationLabel = 'Sports';
    protected static ?string $pluralModelLabel = 'Sports';
    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Schema $schema): Schema
    {
        return SportsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSports::route('/'),
        ];
    }
}
