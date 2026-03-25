<?php
// app/Filament/Widgets/Reports/ReportStatsWidget.php

namespace App\Filament\Widgets\Reports;

use App\Models\Order;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class ReportStatsWidget extends Widget
{
    protected  string $view = 'filament.widgets.reports.report-stats-widget';
    protected int|string|array $columnSpan = 'full';

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

        $avgNow  = $ordersNow > 0 ? $revenueNow / $ordersNow : 0;
        $avgPrev = $ordersPrev > 0 ? $revenuePrev / $ordersPrev : 0;

        return [
            [
                'title'   => 'Total Revenue',
                'value'   => '$' . number_format($revenueNow / 1000, 3) . ' k',
                'percent' => $percent($revenueNow, $revenuePrev),
                'icon'    => 'heroicon-o-currency-dollar',
                'iconBg'  => '#1a2e0a',
            ],
            [
                'title'   => 'Total Orders',
                'value'   => number_format($ordersNow),
                'percent' => $percent($ordersNow, $ordersPrev),
                'icon'    => 'heroicon-o-shopping-cart',
                'iconBg'  => '#0a1a2e',
            ],
            [
                'title'   => 'New Customers',
                'value'   => number_format($customersNow, 3),
                'percent' => $percent($customersNow, $customersPrev),
                'icon'    => 'heroicon-o-user-plus',
                'iconBg'  => '#1a0a2e',
            ],
            [
                'title'   => 'Avg. Order Value',
                'value'   => '$' . number_format($avgNow / 1000, 3) . ' k',
                'percent' => $percent($avgNow, $avgPrev),
                'icon'    => 'heroicon-o-arrow-trending-up',
                'iconBg'  => '#2e0a0a',
            ],
        ];
    }
}
