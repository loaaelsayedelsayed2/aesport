<?php
// app/Filament/Widgets/Reports/CategoryPerformanceWidget.php

namespace App\Filament\Widgets\Reports;

use App\Models\Category;
use App\Models\OrderItem;
use Filament\Widgets\Widget;

class CategoryPerformanceWidget extends Widget
{
    protected  string $view = 'filament.widgets.reports.category-performance-widget';
    protected int|string|array $columnSpan = 'full';

    public function getData(): array
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
            'labels'  => $categories->pluck('name')->toArray(),
            'revenue' => $categories->pluck('revenue')->toArray(),
            'units'   => $categories->pluck('units')->toArray(),
        ];
    }
}
