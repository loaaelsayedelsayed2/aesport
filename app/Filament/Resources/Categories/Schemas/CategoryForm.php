<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Category Name')
                    ->placeholder('shoes')
                    ->extraInputAttributes(['class' => 'custom-input-style'])
                    ->required(),
                Select::make('parent_id')
                    ->label('Main Category')
                    ->placeholder('Select Main Category')
                    ->options(function ($get, $record) {
                        $currentId = $record?->id;

                        $categories = Category::when($currentId, function ($query) use ($currentId) {
                            $query->where('id', '!=', $currentId);
                        })
                            ->pluck('name', 'id')
                            ->toArray();

                        return ['' => 'Main'] + $categories;
                    })
                    ->searchable()
                    ->nullable(),
                MultiSelect::make('types')
                    ->label('Types / Genders')
                    ->relationship('types', 'name') 
                    ->searchable()
                    ->placeholder('Select Types'),
                Toggle::make('is_active')
                    ->label('Status')
                    ->helperText('Category Will Be Hidden From Store If Inactive')
                    ->default(true)
                    ->onColor('danger'),
            ])->columns(1);
    }
}
