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
                ->label('Type Name')
                ->placeholder('Men')
                ->extraInputAttributes(['class' => 'custom-input-style'])
                ->required(),

                Toggle::make('is_active')
                    ->label('Status')
                    ->helperText('Type Will Be Hidden From Store If Inactive')
                    ->default(true)
                    ->onColor('danger'),
            ])->columns(1);
    }
}
