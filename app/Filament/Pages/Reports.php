<?php
// app/Filament/Pages/Reports.php

namespace App\Filament\Pages;

use App\Filament\Widgets\Reports\ReportStatsWidget;
use App\Filament\Widgets\Reports\RevenueTrendWidget;
use App\Filament\Widgets\Reports\CategoryPerformanceWidget;
use App\Filament\Widgets\Reports\RegionalPerformanceWidget;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Reports extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedChartBar;
    protected  string $view = 'filament.pages.reports';
    protected static ?string $navigationLabel = 'Reports';
    protected static ?string $title = 'Analytics & Reports';
    protected static ?string $slug = 'reports';
    protected static ?int $navigationSort = 9;

    public function getHeaderWidgets(): array
    {
        return [
            ReportStatsWidget::class,
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            RevenueTrendWidget::class,
            CategoryPerformanceWidget::class,
        //     RegionalPerformanceWidget::class,
        ];
    }

    public function getColumns(): int
    {
        return 1;
    }
}
