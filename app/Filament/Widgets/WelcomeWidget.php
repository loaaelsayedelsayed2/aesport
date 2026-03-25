<?php
// app/Filament/Widgets/WelcomeWidget.php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class WelcomeWidget extends Widget
{
    protected  string $view = 'filament.widgets.welcome-widget';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 1;

    public function getData(): array
    {
        $user        = Auth::user();
        $newOrders   = Order::where('status', 'pending')->count();
        $shipments   = Order::where('status', 'shipped')->count();

        return [
            'name'      => $user?->fname ?? 'Admin',
            'newOrders' => $newOrders,
            'shipments' => $shipments,
        ];
    }
}
