<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Fields\ColorPickerField;
use App\Filament\Fields\SizePickerField;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'default' => 1,
                'lg'      => 2,
            ])
            ->components([

                // =================== LEFT COLUMN ===================
                Section::make()
                    ->columnSpan(1)
                    ->schema([
                        FileUpload::make('main_image')
                            ->label('Main Image')
                            ->image()
                            ->required()
                            ->imageEditor()
                            ->panelLayout('grid')
                            ->columnSpanFull()
                            ->disk('public')
                            ->directory('products')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jpg']),

                        Repeater::make('images')
                            ->relationship('images')
                            ->label('Additional Images')
                            ->hint('Maximum 10 Images')
                            ->hintColor('gray')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Image')
                                    ->image()
                                    ->imageEditor()
                                    ->required()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jpg']),
                            ])
                            ->addActionLabel('+ Add Image')
                            ->maxItems(10)
                            ->minItems(1)
                            ->defaultItems(0)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(5)
                            ->required()
                            ->placeholder('Enter product description...')
                            ->columnSpanFull(),

                        // ✅ Color picker — replaces Repeater variant color
                        ColorPickerField::make('colors')
                            ->label('Product Colors')
                            ->columnSpanFull(),
                    ]),

                // =================== RIGHT COLUMN ===================
                Section::make()
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('name')
                            ->label('Product Name')
                            ->placeholder('Handball Spezial Shoes')
                            ->required()
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            Select::make('brand')
                                ->label('Brand')
                                ->relationship('brand', 'name')
                                ->placeholder('Choose brand')
                                ->searchable()
                                ->required()
                                ->preload(),

                            Select::make('type')
                                ->label('Gender / Type')
                                ->relationship('type', 'name')
                                ->multiple()
                                ->searchable()
                                ->preload(),
                        ]),

                        Grid::make(2)->schema([
                            Select::make('category')
                                ->label('Category')
                                ->relationship('category', 'name')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->required(),

                            Select::make('sports')
                                ->label('Sports')
                                ->relationship('sports', 'name')
                                ->placeholder('Choose sports')
                                ->multiple()
                                ->searchable()
                                ->preload(),
                        ]),

                        Grid::make(1)->schema([
                            TextInput::make('price')
                                ->label('Price')
                                ->placeholder('80')
                                ->numeric()
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            Select::make('discount_type')
                                ->label('Discount Type')
                                ->options([
                                    'Fixed' => 'fixed',
                                    'Percentage' => 'percentage',
                                ]),

                            TextInput::make('discount_price')
                                ->label('Discount')
                                ->placeholder('10')
                                ->numeric(),
                        ]),

                        // ✅ Size picker — replaces Repeater variant size
                        SizePickerField::make('sizes')
                            ->label('Product Sizes')
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            Select::make('in_stock')
                                ->label('Stock Status')
                                ->options([
                                    1 => 'In Stock',
                                    0 => 'Out of Stock',
                                ])
                                ->required()
                                ->default(1),

                            TextInput::make('quantity')
                                ->label('Quantity in Stock')
                                ->numeric()
                                ->required()
                                ->placeholder('1234'),
                        ]),

                        Textarea::make('additional_info')
                            ->label('Additional Info')
                            ->rows(3)
                            ->placeholder('Free shipping & returns: On all orders over $150')
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Active / Visible')
                            ->default(true)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
