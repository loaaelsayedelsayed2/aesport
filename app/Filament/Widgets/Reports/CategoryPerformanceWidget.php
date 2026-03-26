<?php
// app/Filament/Widgets/Reports/CategoryPerformanceWidget.php

namespace App\Filament\Widgets\Reports;

use App\Models\Category;
use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;

class CategoryPerformanceWidget extends ChartWidget
{
    protected ?string $heading = 'Product Performance By Category';

    protected int|string|array $columnSpan = 'full';

    protected  ?string $maxHeight = '250px';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $categories = Category::withCount('products')
            ->take(5)
            ->get()
            ->map(fn($cat) => [
                'name'    => $cat->name,
                'revenue' => OrderItem::whereHas('product.category', fn($q) => $q->where('categories.id', $cat->id))
                                ->sum('total_price'),
                'units'   => OrderItem::whereHas('product.category', fn($q) => $q->where('categories.id', $cat->id))
                                ->sum('quantity'),
            ]);

        return [
            'labels' => $categories->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label'           => 'Revenue ($)',
                    'data'            => $categories->pluck('revenue')->toArray(),
                    'backgroundColor' => 'rgba(239, 68, 68, 0.8)',
                    'borderColor'     => '#ef4444',
                    'borderWidth'     => 1,
                    'borderRadius'    => 4,
                    'yAxisID'         => 'y',
                ],
                [
                    'label'           => 'Units Sold',
                    'data'            => $categories->pluck('units')->toArray(),
                    'backgroundColor' => 'rgba(255, 255, 255, 0.8)',
                    'borderColor'     => '#ffffff',
                    'borderWidth'     => 1,
                    'borderRadius'    => 4,
                    'yAxisID'         => 'y1',
                ],
            ],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type'        => 'linear',
                    'position'    => 'left',
                    'beginAtZero' => true,
                    'grid'        => [
                        'color'      => 'rgba(255,255,255,0.08)',
                        'borderDash' => [4, 4],
                    ],
                    'ticks'  => ['color' => '#9ca3af'],
                    'border' => ['dash' => [4, 4]],
                ],
                'y1' => [
                    'type'        => 'linear',
                    'position'    => 'right',
                    'beginAtZero' => true,
                    'grid'        => ['drawOnChartArea' => false],
                    'ticks'       => ['color' => '#9ca3af'],
                ],
                'x' => [
                    'grid'   => [
                        'color'      => 'rgba(255,255,255,0.08)',
                        'borderDash' => [4, 4],
                    ],
                    'ticks'  => ['color' => '#9ca3af'],
                    'border' => ['dash' => [4, 4]],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display'  => true,
                    'position' => 'top',
                    'align'    => 'end',
                    'labels'   => [
                        'color'     => '#9ca3af',
                        'boxWidth'  => 8,
                        'boxHeight' => 8,
                    ],
                ],
                'tooltip' => [
                    'backgroundColor' => '#1f2937',
                    'titleColor'      => '#f9fafb',
                    'bodyColor'       => '#9ca3af',
                    'borderColor'     => '#374151',
                    'borderWidth'     => 1,
                ],
            ],
        ];
    }
}
