<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('fname')
                    ->required(),
                TextInput::make('lname')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                Textarea::make('image')
                    ->columnSpanFull(),
                Textarea::make('location')
                    ->columnSpanFull(),
                Select::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female']),
                Select::make('role')
                    ->options(['admin' => 'Admin', 'user' => 'User'])
                    ->default('user')
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                DatePicker::make('birthday'),
            ]);
    }
}
