<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
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
                            ->label('main_image')
                            ->image()
                            ->required()
                            ->imageEditor()
                            ->panelLayout('grid')
                            ->columnSpanFull()
                            ->disk('public')
                            ->directory('products')
                            ->extraAttributes(['class' => 'dark-upload'])
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
                            ->label('description')
                            ->rows(5)
                            ->required()
                            ->placeholder('Enter product description...')
                            ->columnSpanFull(),

                        Repeater::make('color_variants')
                            ->relationship(
                                name: 'variants',
                                modifyQueryUsing: fn($query) => $query->where('key', 'color')
                            )
                            ->label('Product Color')
                            ->schema([
                                Hidden::make('key')->default('color'),
                                TextInput::make('value')
                                    ->label('Color')
                                    ->hiddenLabel()
                                    ->extraAttributes(['class' => 'color-value-input']),
                            ])
                            ->grid(8)
                            ->addActionLabel('+')
                            ->minItems(0)
                            ->defaultItems(0)
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'color-picker-repeater']),
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
                                ->placeholder('choose brand')
                                ->searchable()
                                ->required()
                                ->preload(),

                            Select::make('type')
                                ->label('Gender/Type')
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
                                ->placeholder('choose sports')
                                ->multiple()
                                ->searchable()
                                ->preload(),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('price')
                                ->label('Price')
                                ->placeholder('80')
                                ->numeric()
                                ->required(),

                            TextInput::make('discount_price')
                                ->label('Discount')
                                ->placeholder('10')
                                ->numeric(),
                        ]),

                        Repeater::make('size_variants')
                            ->relationship(
                                name: 'variants',
                                modifyQueryUsing: fn($query) => $query->where('key', 'size')
                            )
                            ->label('Product Size')
                            ->schema([
                                Hidden::make('key')->default('size'),
                                TextInput::make('value')
                                    ->label('Size')
                                    ->hiddenLabel()
                                    ->extraAttributes(['class' => 'size-value-input']),
                            ])
                            ->minItems(0)
                            ->defaultItems(0)
                            ->addActionLabel('+')
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'size-picker-repeater']),

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
                            ->label('additional_info')
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
