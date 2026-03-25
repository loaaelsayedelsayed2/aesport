<?php
// app/Filament/Widgets/OrdersDonutChart.php
namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersDonutChart extends ChartWidget
{
    protected  ?string $heading = 'Total Orders';
    protected int|string|array $columnSpan = 1;
        protected static ?int $sort = 3;


    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        return [
            'labels' => ['New', 'Completed', 'Delivered'],
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => [
                        Order::where('status','pending')->count(),
                        Order::where('status','completed')->count(),
                        Order::where('status','delivered')->count(),
                    ],
                    'backgroundColor' => ['#22c55e', '#3b82f6', '#ef4444'],
                ],
            ],
        ];
    }
}
