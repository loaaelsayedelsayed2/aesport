<?php
// app/Filament/Widgets/TopProductsWidget.php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Storage;

class TopProductsWidget extends Widget
{
    protected  string $view = 'filament.widgets.top-products-widget';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 4;

    public function getProducts(): array
    {
        return OrderItem::with('product.category')
            ->selectRaw('product_id, SUM(quantity) as total_sales, SUM(total_price) as total_amount')
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get()
            ->toArray();
    }
}
