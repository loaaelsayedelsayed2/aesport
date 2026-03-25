<?php
// app/Filament/Widgets/DashboardStatsWidget.php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class DashboardStatsWidget extends Widget
{
    protected  string $view = 'filament.widgets.dashboard-stats-widget';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;

    public function getStats(): array
    {
        $now          = Carbon::now();
        $thisMonth    = $now->copy()->startOfMonth();
        $lastMonth    = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();

        $percent = function ($current, $previous) {
            if ($previous == 0) return ['value' => '+0%', 'up' => true];
            $diff = (($current - $previous) / $previous) * 100;
            return ['value' => ($diff >= 0 ? '+' : '') . number_format($diff, 1) . '%', 'up' => $diff >= 0];
        };

        $revenueNow  = Order::whereBetween('created_at', [$thisMonth, $now])->sum('total_amount');
        $revenuePrev = Order::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->sum('total_amount');

        $ordersNow  = Order::whereBetween('created_at', [$thisMonth, $now])->count();
        $ordersPrev = Order::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();

        $customersNow  = User::whereBetween('created_at', [$thisMonth, $now])->count();
        $customersPrev = User::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();

        return [
            [
                'title'   => 'Total Revenue',
                'value'   => number_format($revenueNow, 3),
                'percent' => $percent($revenueNow, $revenuePrev),
                'icon'    => 'heroicon-o-currency-dollar',
                'iconBg'  => '#1a2e0a',
            ],
            [
                'title'   => 'Total Orders',
                'value'   => number_format($ordersNow, 3),
                'percent' => $percent($ordersNow, $ordersPrev),
                'icon'    => 'heroicon-o-shopping-cart',
                'iconBg'  => '#0a1a2e',
            ],
            [
                'title'   => 'Total Customers',
                'value'   => number_format($customersNow),
                'percent' => $percent($customersNow, $customersPrev),
                'icon'    => 'heroicon-o-users',
                'iconBg'  => '#1a0a2e',
            ],
        ];
    }
}
