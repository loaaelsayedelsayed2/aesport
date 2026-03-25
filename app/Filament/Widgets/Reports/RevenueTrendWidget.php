<?php
// app/Filament/Widgets/Reports/RevenueTrendWidget.php

namespace App\Filament\Widgets\Reports;

use App\Models\Order;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class RevenueTrendWidget extends Widget
{
    protected  string $view = 'filament.widgets.reports.revenue-trend-widget';
    protected int|string|array $columnSpan = 'full';

    public function getData(): array
    {
        $days = collect(range(0, 29))->map(function ($i) {
            $date = Carbon::now()->subDays(29 - $i);
            return [
                'label'   => $date->format('M j'),
                'revenue' => Order::whereDate('created_at', $date)->sum('total_amount'),
            ];
        });

        return [
            'labels'  => $days->pluck('label')->toArray(),
            'revenue' => $days->pluck('revenue')->toArray(),
        ];
    }
}
