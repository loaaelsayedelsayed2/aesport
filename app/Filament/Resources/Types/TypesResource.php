<?php

namespace App\Filament\Resources\Types;

use App\Filament\Resources\Types\Pages\CreateTypes;
use App\Filament\Resources\Types\Pages\EditTypes;
use App\Filament\Resources\Types\Pages\ListTypes;
use App\Filament\Resources\Types\Schemas\TypesForm;
use App\Filament\Resources\Types\Tables\TypesTable;
use App\Models\Type;
use App\Models\Types;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TypesResource extends Resource
{
    protected static ?string $model = Type::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'Gender/Types';
    protected static ?string $navigationLabel = 'Gender/Types';
    protected static ?string $pluralModelLabel = 'Gender/Types';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Schema $schema): Schema
    {
        return TypesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TypesTable::configure($table);
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
            'index' => ListTypes::route('/'),
            // 'create' => CreateTypes::route('/create'),
            // 'edit' => EditTypes::route('/{record}/edit'),
        ];
    }

    protected static function getTableQuery(): Builder
    {
        return parent::getTableQuery()->withCount('products');
    }
}
