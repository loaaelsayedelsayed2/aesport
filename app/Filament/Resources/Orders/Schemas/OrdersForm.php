<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class OrdersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer')
                    ->columnSpanFull()
                    ->schema([
                        Placeholder::make('customer_info')
                            ->label(new HtmlString('<span style="color: #B91818 !important;">Customer Info</span>'))
                            ->content(fn($record) => new HtmlString('
                                <div style="display:flex; gap:2rem; align-items:center;">
                                    <span style="color:white !important;">👤 <b style="color:white !important;">Name:</b> ' . $record?->user?->fname . ' ' . $record?->user?->lname . '</span>
                                    <span style="color:white !important;">📞 <b style="color:white !important;">Phone:</b> ' . $record?->phone . '</span>
                                    <span style="color:white !important;">✉️ <b style="color:white !important;">Email:</b> ' . $record?->email . '</span>
                                </div>
                            ')),

                        Placeholder::make('payment_info')
                            ->label(new HtmlString('<span style="color: #B91818 !important;">Payment Method</span>'))
                            ->content(fn($record) => new HtmlString('
                                <div>
                                    <div style="margin-bottom:6px; color:white !important;"><b style="color:white !important;">Transaction ID</b> : ' . ($record?->transaction_id ?? 'N/A') . '</div>
                                    <div style="color:white !important;"><b style="color:white !important;">Amount</b> : ' . $record?->total_amount . '</div>
                                </div>
                            ')),
                    ]),

                Section::make('Billing Address')
                    ->columnSpanFull()
                    ->schema([
                        Placeholder::make('billing')
                            ->label(new HtmlString('<span style="color: #B91818 !important;">Billing</span>'))
                            ->content(fn($record) => new HtmlString('
                                <table style="width:100%; border-collapse:collapse; color:white;">
                                    <tr><td style="padding:6px 0; font-weight:600; width:120px;">First Name</td><td>: ' . $record?->first_name . '</td></tr>
                                    <tr><td style="padding:6px 0; font-weight:600;">Last Name</td><td>: ' . $record?->last_name . '</td></tr>
                                    <tr><td style="padding:6px 0; font-weight:600;">Email</td><td>: ' . $record?->email . '</td></tr>
                                    <tr><td style="padding:6px 0; font-weight:600;">Address</td><td>: ' . $record?->address . '</td></tr>
                                    <tr><td style="padding:6px 0; font-weight:600;">Country</td><td>: ' . $record?->country . '</td></tr>
                                    <tr><td style="padding:6px 0; font-weight:600;">Phone</td><td>: ' . $record?->phone . '</td></tr>
                                </table>
                            ')),
                    ]),

                Section::make('Items In This Order')
                    ->columnSpanFull()
                    ->schema([
                        Placeholder::make('items')
                            ->label(new HtmlString('<span style="color: #B91818 !important;">Items</span>'))
                            ->content(function ($record) {
                                if (!$record) return '';

                                $items = $record->items()->with(['product', 'size', 'color'])->get();

                                $rows = $items->map(function ($item) {
                                    $image = $item->product?->main_image
                                        ? '<img src="' . asset('storage/' . $item->product->main_image) . '" style="width:48px;height:48px;object-fit:cover;border-radius:6px;">'
                                        : '<div style="width:48px;height:48px;background:#444;border-radius:6px;"></div>';

                                    $color = $item->color?->value
                                        ? '<span style="display:inline-block;width:16px;height:16px;border-radius:50%;background:' . $item->color->value . ';"></span>'
                                        : '-';

                                    return '
                                        <tr style="border-bottom:1px solid #444; color:white;">
                                            <td style="padding:12px 8px;">
                                                <div style="display:flex;align-items:center;gap:10px;">'
                                        . $image .
                                        '<span>' . $item->product?->name . '</span>
                                                </div>
                                            </td>
                                            <td style="padding:12px 8px;">' . $item->price . '</td>
                                            <td style="padding:12px 8px;">' . $item->quantity . '</td>
                                            <td style="padding:12px 8px;">' . $color . '</td>
                                            <td style="padding:12px 8px;">' . ($item->size?->value ?? '-') . '</td>
                                            <td style="padding:12px 8px;">' . $item->total_price . '</td>
                                        </tr>
                                    ';
                                })->join('');

                                return new HtmlString('
                                    <table style="width:100%; border-collapse:collapse;">
                                        <thead>
                                            <tr style="background:#C8232A; color:white;">
                                                <th style="padding:10px 8px; text-align:left;">Product Name</th>
                                                <th style="padding:10px 8px; text-align:left;">Price</th>
                                                <th style="padding:10px 8px; text-align:left;">Qua</th>
                                                <th style="padding:10px 8px; text-align:left;">Color</th>
                                                <th style="padding:10px 8px; text-align:left;">Size</th>
                                                <th style="padding:10px 8px; text-align:left;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>' . $rows . '</tbody>
                                    </table>
                                ');
                            }),
                    ]),

                Section::make('')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Placeholder::make('status_badge')
                                ->label(new HtmlString('<span style="color: #B91818 !important;">Status</span>'))
                                ->content(fn($record) => new HtmlString('
                                    <span style="
                                        background-color:' . match($record?->status) {
                                            'pending'          => '#f59e0b',
                                            'confirmed'        => '#3b82f6',
                                            'shipped'          => '#8b5cf6',
                                            'delivered'        => '#dc2626',
                                            'completed'        => '#22c55e',
                                            'cancelled'        => '#6b7280',
                                            'return_requested' => '#f97316',
                                            'returned'         => '#ec4899',
                                            default            => '#6b7280',
                                        } . ';
                                        color: white;
                                        padding: 6px 16px;
                                        border-radius: 6px;
                                        font-weight: 600;
                                        font-size: 0.875rem;
                                        text-transform: capitalize;
                                    ">' . ucfirst(str_replace('_', ' ', $record?->status ?? '')) . '</span>
                                ')),

                                Placeholder::make('totals')
                                    ->label('')
                                    ->content(fn($record) => new HtmlString('
                                        <div style="display:flex; flex-direction:column; align-items:flex-end; gap:8px; color:white;">
                                            <div style="display:flex; width:300px; justify-content:space-between;"><span>SUBTOTAL :' . $record?->sub_total . '</span></div>
                                            <div style="display:flex; width:300px; justify-content:space-between;"><span>DELIVERY :</span><span>' . ($record?->delivery_fee > 0 ? '$' . $record->delivery_fee : 'Free') . '</span></div>
                                            <div style="display:flex; width:300px; justify-content:space-between;"><span>DISCOUNT :' . $record?->coupon_discount . '</span></div>
                                            <div style="display:flex; width:300px; justify-content:space-between; font-weight:700; font-size:1rem; border-top:1px solid #444; padding-top:8px;"><span>TOTAL :' . $record?->total_amount . '</span></div>
                                        </div>
                                    ')),
                            ]),
                    ]),
            ]);
    }
}
