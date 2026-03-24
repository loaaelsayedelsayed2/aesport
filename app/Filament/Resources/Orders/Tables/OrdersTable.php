<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\Action;
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
            ->query(fn(): Builder => Order::query()->whereNotIn('status', ['return_requested']))
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
                        'processing'        => 'info',
                        'shipped'          => 'info',
                        'delivered',
                        'cancelled'        => 'danger',
                        'returned'         => 'gray',
                        default            => 'gray',
                    })
                    ->action(
                        Action::make('updateStatus')
                            ->form([
                                \Filament\Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'pending'          => 'Pending',
                                        'processing'        => 'Processing',
                                        'shipped'          => 'Shipped',
                                        'delivered'        => 'Delivered',
                                        'cancelled'        => 'Cancelled',
                                        // 'returned'        => 'Returned',
                                    ])
                                    ->native(false)
                                    ->required(),
                            ])
                            ->visible(fn($record) => $record->status != 'returned')
                            ->fillForm(fn($record) => ['status' => $record->status])
                            ->action(fn($record, array $data) => $record->update(['status' => $data['status']]))
                    ),

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
                        'processing'        => 'Processing',
                        'shipped'          => 'Shipped',
                        'delivered'        => 'Delivered',
                        'cancelled'        => 'Cancelled',
                        'returned'        => 'Returned',
                    ]),

                SelectFilter::make('is_payment')
                    ->label('All Payment Method')
                    ->options([
                        '1' => 'Paid',
                        '0' => 'Un Paid',
                    ]),
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
