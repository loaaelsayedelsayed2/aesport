<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ReturnedOrdersWidget extends TableWidget
{
    protected static ?string $heading = null;
    protected int|string|array $columnSpan = 'full';

    protected function getTableHeader(): ?\Illuminate\Contracts\View\View
    {
        return view('filament.widgets.returned-orders-header');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Order::query()->whereIn('status', ['returned', 'return_requested']))
            ->actionsColumnLabel('Actions')
            ->searchPlaceholder('Search by order number')
            ->columns([
                TextColumn::make('id')
                    ->label('Return ID')
                    ->searchable()
                    ->color('danger')
                    ->weight('bold')
                    ->formatStateUsing(fn($state) => 'RET-' . $state),

                TextColumn::make('order_number')
                    ->label('Order ID')
                    ->searchable()
                    ->color('danger')
                    ->weight('bold')
                    ->formatStateUsing(fn($state) => '#' . $state),


                TextColumn::make('user.fname')
                    ->label('Customer')
                    ->formatStateUsing(fn($state, $record) => $record->user?->fname . ' ' . $record->user?->lname),

                TextColumn::make('reason')
                    ->limit(10)
                    ->label('Reason'),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d-m-Y'),
                TextColumn::make('total_amount')
                    ->label('Amount'),
            ])
            ->filters([])
            ->recordActions([
                Action::make('approve')
                    ->label('✓')
                    ->color('success')
                    ->size('sm')
                    ->button()
                    ->action(function ($record) {
                        $record->update(['status' => 'returned']);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Approve Return')
                    ->modalDescription('Are you sure you want to approve this return request?'),

                Action::make('reject')
                    ->label('✗')
                    ->color('danger')
                    ->size('sm')
                    ->button()
                    ->action(function ($record) {
                        $record->update(['status' => 'delivered']);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Reject Return')
                    ->modalDescription('Are you sure you want to reject this return request?'),
            ])
            ->toolbarActions([]);
    }
}
