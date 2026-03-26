<?php

namespace App\Filament\Widgets\Reports;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueTrendWidget extends ChartWidget
{
    protected ?string $heading = 'Revenue & Orders Trend';

    protected int|string|array $columnSpan = 'full';

    protected  ?string $maxHeight = '200px';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        $maxRevenue = Order::whereBetween('created_at', [
            Carbon::now()->subDays(29),
            Carbon::now(),
        ])->max('total_amount');

        return [
            'scales' => [
                'y' => [
                    'max' => $maxRevenue * 1.2,
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(255,255,255,0.08)',
                        'borderDash' => [4, 4],
                    ],
                    'ticks' => [
                        'color' => '#9ca3af',
                    ],
                    'border' => [
                        'dash' => [4, 4],
                    ],
                ],
                'x' => [
                    'grid' => [
                        'color' => 'rgba(255,255,255,0.08)',
                        'borderDash' => [4, 4],
                    ],
                    'ticks' => [
                        'color' => '#9ca3af',
                        'maxTicksLimit' => 6,
                    ],
                    'border' => [
                        'dash' => [4, 4],
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'align' => 'end',
                    'labels' => [
                        'color' => '#ef4444',
                        'boxWidth' => 8,
                        'boxHeight' => 8,
                    ],
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        $days = collect(range(0, 29))->map(function ($i) {
            $date = Carbon::now()->subDays(29 - $i);

            return [
                'label'   => $date->format('M j'),
                'revenue' => Order::whereDate('created_at', $date)->sum('total_amount'),
            ];
        });

        return [
            'labels' => $days->pluck('label')->toArray(),
            'datasets' => [
                [
                    'label'           => 'Revenue',
                    'data'            => $days->pluck('revenue')->toArray(),
                    'borderColor'     => '#ef4444',
                    'backgroundColor' => 'transparent',
                    'borderWidth'     => 2,
                    'tension'         => 0.4,
                    'pointRadius'     => 0,
                ],
            ],
        ];
    }
}
