<?php

namespace App\Filament\Resources\Sports\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SportsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                FileUpload::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->directory('sports')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                    ->required(),
                Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true),
            ])->columns(1);
    }
}
