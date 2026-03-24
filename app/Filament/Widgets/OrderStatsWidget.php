<?php
// app/Filament/Widgets/OrderStatsWidget.php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class OrderStatsWidget extends Widget
{
    protected  string $view = 'filament.widgets.order-stats-widget';
    protected int|string|array $columnSpan = 'full';

    public function getStats(): array
    {
        $now        = Carbon::now();
        $thisMonth  = $now->copy()->startOfMonth();
        $lastMonth  = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();

        $calc = fn($query, $start, $end) => $query()->whereBetween('created_at', [$start, $end])->count();

        $percent = function ($current, $previous) {
            if ($previous == 0) return ['value' => '+0%', 'up' => true];
            $diff = (($current - $previous) / $previous) * 100;
            return ['value' => ($diff >= 0 ? '+' : '') . number_format($diff, 1) . '%', 'up' => $diff >= 0];
        };

        $totalNow      = $calc(fn() => Order::query(), $thisMonth, $now);
        $totalPrev     = $calc(fn() => Order::query(), $lastMonth, $lastMonthEnd);

        $completeNow   = $calc(fn() => Order::where('status', 'completed'), $thisMonth, $now);
        $completePrev  = $calc(fn() => Order::where('status', 'completed'), $lastMonth, $lastMonthEnd);

        $cancelNow     = $calc(fn() => Order::where('status', 'cancelled'), $thisMonth, $now);
        $cancelPrev    = $calc(fn() => Order::where('status', 'cancelled'), $lastMonth, $lastMonthEnd);

        $deliveredNow  = $calc(fn() => Order::where('status', 'delivered'), $thisMonth, $now);
        $deliveredPrev = $calc(fn() => Order::where('status', 'delivered'), $lastMonth, $lastMonthEnd);

        return [
            [
                'title'   => 'Total Orders',
                'value'   => number_format($totalNow),
                'prev'    => $totalPrev,
                'percent' => $percent($totalNow, $totalPrev),
                'icon'    => '🛒',
                'iconBg'  => '#1a1a2e',
            ],
            [
                'title'   => 'Complete Orders',
                'value'   => number_format($completeNow),
                'prev'    => $completePrev,
                'percent' => $percent($completeNow, $completePrev),
                'icon'    => '📊',
                'iconBg'  => '#1a2a3e',
            ],
            [
                'title'   => 'Canceled Orders',
                'value'   => number_format($cancelNow),
                'prev'    => $cancelPrev,
                'percent' => $percent($cancelNow, $cancelPrev),
                'icon'    => '🚫',
                'iconBg'  => '#2e1a1a',
            ],
            [
                'title'   => 'Total Delivered',
                'value'   => number_format($deliveredNow),
                'prev'    => $deliveredPrev,
                'percent' => $percent($deliveredNow, $deliveredPrev),
                'icon'    => '🚚',
                'iconBg'  => '#2e2a1a',
            ],
        ];
    }
}
