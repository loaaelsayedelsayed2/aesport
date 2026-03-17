<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CouponsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Promotions Name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('e.g. SUMMER20')
                    ->helperText('Unique coupon code customers will enter'),
                Select::make('type')
                    ->label('Type Promotions')
                    ->required()
                    ->options([
                        'discount_code'  => 'Discount Code',
                        'free_shipping'  => 'Free Shipping',
                    ]),

                Select::make('discount_type')
                    ->label('Discount Type')
                    ->required()
                    ->options([
                        'percentage'    => 'Percentage',
                        'fixed'  => 'Fixed Amount',
                        'free_shipping' => 'Free Shipping',
                    ])
                    ->reactive(),

                TextInput::make('discount_amount')
                    ->label('Discount Amount')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('e.g. 25')
                    ->helperText('Enter % or fixed amount depending on type'),
                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),

                DatePicker::make('expiry_date')
                    ->label('Expiry Date')
                    ->required()
                    ->after('start_date'),

                TextInput::make('usage_limit')
                    ->label('Usage Limit')
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Leave empty for unlimited')
                    ->helperText('Maximum number of times this coupon can be used'),

                Toggle::make('is_active')
                    ->label('Active')
                    ->helperText('Enable or disable this coupon immediately')
                    ->default(true),




            ])->columns(1);
    }
}
