<?php

namespace App\Filament\Resources\Types\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Symfony\Component\Console\Color;

class TypesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label('Category Name')
                ->placeholder('Men')
                ->extraInputAttributes(['class' => 'custom-input-style'])
                ->required(),
                // Select::make('parent_id')
                //     ->label('Parent Type')
                //     ->options(function () {
                //         return \App\Models\Type::pluck('name', 'id');
                //     })
                //     ->nullable(),
                Toggle::make('is_active')
                    ->label('Status')
                    ->helperText('Category Will Be Hidden From Store If Inactive')
                    ->default(true)
                    ->onColor('danger'),
            ])->columns(1);
    }
}
