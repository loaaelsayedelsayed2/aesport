<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends StatsOverviewWidget
{
    protected function getStats(): array {
    return [
        Stat::make('Total Customers', '36541')
            ->description('3.1% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
    ];
}
}
