<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Order::query()->where('status','!=','returned'))
            ->searchPlaceholder('Search by order number')
            ->columns([
                TextColumn::make('order_number')
                    ->label('Order ID')
                    ->searchable()
                    ->color('danger')
                    ->weight('bold')
                    ->formatStateUsing(fn($state) => '# ' . $state),

                TextColumn::make('user.fname')
                    ->label('Customer')
                    ->description(fn($record) => $record->user?->email)
                    ->formatStateUsing(fn($state, $record) => $record->user?->fname . ' ' . $record->user?->lname),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('j M Y g:i A')
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->color(fn($state) => match ($state) {
                        'pending'          => 'warning',
                        'confirmed'        => 'info',
                        'shipped'          => 'info',
                        'delivered',
                        'completed'        => 'success',
                        'cancelled'        => 'danger',
                        'return_requested' => 'warning',
                        'returned'         => 'gray',
                        default            => 'gray',
                    }),

                TextColumn::make('item_count')
                    ->label('Items')
                    ->alignCenter(),

                TextColumn::make('is_payment')
                    ->label('Payment')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Paid' : 'Un Paid')
                    ->color(fn($state) => $state ? 'info' : 'danger'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('All Status')
                    ->options([
                        'pending'          => 'Pending',
                        'confirmed'        => 'Confirmed',
                        'shipped'          => 'Shipped',
                        'delivered'        => 'Delivered',
                        'completed'        => 'Completed',
                        'cancelled'        => 'Cancelled',
                        'return_requested' => 'Return Requested',
                        'returned'         => 'Returned',
                    ]),

                SelectFilter::make('is_payment')
                    ->label('All Payment Method')
                    ->options([
                        '1' => 'Paid',
                        '0' => 'Un Paid',
                    ]),
            ])
            ->recordActions([
            ])
            ->toolbarActions([]);
    }
}
