<?php
// app/Filament/Widgets/ProductStatsWidget.php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class ProductStatsWidget extends Widget
{
    protected  string $view = 'filament.widgets.product-stats-widget';
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

        $totalNow  = Product::count();
        $totalPrev = Product::where('created_at', '<', $thisMonth)->count();

        $outNow    = Product::where('in_stock', false)->count();
        $outPrev   = Product::where('in_stock', false)->whereBetween('updated_at', [$lastMonth, $lastMonthEnd])->count();

        $lowNow    = Product::where('in_stock', true)->where('quantity', '<=', 10)->count();
        $lowPrev   = Product::where('in_stock', true)->where('quantity', '<=', 10)->whereBetween('updated_at', [$lastMonth, $lastMonthEnd])->count();

        $valueNow  = Product::sum('price');
        $valuePrev = Product::where('created_at', '<', $thisMonth)->sum('price');

        return [
            [
                'title'   => 'Total Products',
                'value'   => number_format($totalNow),
                'percent' => $percent($totalNow, $totalPrev),
                'color'   => '#3b82f6',
            ],
            [
                'title'   => 'Out Of Stock',
                'value'   => number_format($outNow),
                'percent' => $percent($outNow, $outPrev),
                'color'   => '#ef4444',
            ],
            [
                'title'   => 'Low Stock',
                'value'   => number_format($lowNow),
                'percent' => $percent($lowNow, $lowPrev),
                'color'   => '#f59e0b',
            ],
            [
                'title'   => 'Total Value',
                'value'   => '$' . number_format($valueNow, 3),
                'percent' => $percent($valueNow, $valuePrev),
                'color'   => '#22c55e',
            ],
        ];
    }
}
