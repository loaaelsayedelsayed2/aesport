<?php
// app/Filament/Widgets/RecentOrdersWidget.php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\Widget;

class RecentOrdersWidget extends Widget
{
    protected  string $view = 'filament.widgets.recent-orders-widget';
    protected int|string|array $columnSpan = 1;
    protected static ?int $sort = 3;

    public function getData(): array
    {
        $orders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $total     = Order::count();
        $new       = Order::where('status', 'pending')->count();
        $completed = Order::where('status', 'completed')->count();
        $delivered = Order::where('status', 'delivered')->count();

        return compact('orders', 'total', 'new', 'completed', 'delivered');
    }
}
