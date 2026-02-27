<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\Cart;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Search by name or phone')
            ->columns([
                TextColumn::make('fname')
                    ->label('Name')
                    ->formatStateUsing(fn($record) => $record->fname . ' ' . $record->lname)
                    ->searchable(query: function (Builder $query, string $search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('fname', 'like', "%{$search}%")
                                ->orWhere('lname', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                    }),
                TextColumn::make('email')
                    ->label('Email'),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('gender')
                    ->badge(),
                TextColumn::make('location')
                    ->label('Location'),
                TextColumn::make('birthday')
                    ->date()
                    ->sortable(),
                TextColumn::make('birthday'),
                // ✅ عدد الأوردرات (static)
                TextColumn::make('orders_count')
                    ->label('Orders Count')
                    ->state(fn() => rand(1, 10)) // قيمة مؤقتة
                    ->badge()
                    ->color('primary'),

                // ✅ آخر أوردر (static)
                TextColumn::make('last_order_date')
                    ->label('Last Order')
                    ->state(fn() => now()->subDays(rand(1, 30)))
                    ->dateTime()
                    ->badge()
                    ->color('success'),
            ])
            ->filters([
                SelectFilter::make('location')
                    ->label('Filter by Location')
                    ->options(
                        fn() => \App\Models\User::query()
                            ->pluck('location', 'location')
                            ->unique()
                            ->toArray()
                    )
                    ->searchable(),
            ])
            ->recordActions([
                // ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
