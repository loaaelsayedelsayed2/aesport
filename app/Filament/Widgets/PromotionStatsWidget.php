<?php
// app/Filament/Widgets/PromotionStatsWidget.php

namespace App\Filament\Widgets;

use App\Models\Coupon;
use App\Models\Order;
use Filament\Widgets\Widget;

class PromotionStatsWidget extends Widget
{
    protected  string $view = 'filament.widgets.promotion-stats-widget';
    protected int|string|array $columnSpan = 'full';

    public function getStats(): array
    {
        $activePromos = Coupon::where('is_active', true)->count();

        $revenueFromPromos = Order::where('coupon_discount', '>', 0)
            ->sum('total_amount');

        $totalRedemptions = Order::where('coupon_discount', '>', 0)->count();


        return [
            [
                'title' => 'Active Promotions',
                'value' => $activePromos,
                'icon'   => 'heroicon-o-tag',
                'iconBg' => '#2e1f0a',
                'prefix' => '',
            ],
            [
                'title' => 'Revenue from Promos',
                'value' => number_format($revenueFromPromos, 3),
                'icon'   => 'heroicon-o-currency-dollar',
                'iconBg' => '#1a2e0a',
                'prefix' => '',
            ],
            [
                'title' => 'Total Redmptins',
                'value' => number_format($totalRedemptions, 4),
                'icon'   => 'heroicon-o-users',
                'iconBg' => '#0a1a2e',
                'prefix' => '',
            ],
        ];
    }
}
