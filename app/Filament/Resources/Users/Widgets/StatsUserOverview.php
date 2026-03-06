<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsUserOverview extends StatsOverviewWidget
{
    protected static bool $isLazy = false;

    // protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 1;

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {


        $totalNow = User::count();

        $totalLastMonth = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $totalPercentage = $totalLastMonth > 0
            ? (($totalNow - $totalLastMonth) / $totalLastMonth) * 100
            : 0;



        $thisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonth = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $newPercentage = $lastMonth > 0
            ? (($thisMonth - $lastMonth) / $lastMonth) * 100
            : 0;



        $activeThisWeek = User::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ])->count();

        $activeLastWeek = User::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();

        $activePercentage = $activeLastWeek > 0
            ? (($activeThisWeek - $activeLastWeek) / $activeLastWeek) * 100
            : 0;

        return [

            $this->buildStat(
                new \Illuminate\Support\HtmlString(
                    '<span style="color:#2563eb !important; font-weight:600;">Total Customers</span>'
                ),
                $totalNow,
                $totalPercentage,
                'info'
            ),

            $this->buildStat(
                'New This Month',
                $thisMonth,
                $newPercentage,
                'success'
            ),

            $this->buildStat(
                'Active Customers',
                $activeThisWeek,
                $activePercentage,
                'warning'
            ),
        ];
    }


    private function buildStat($title, $value, $percentage, $color)
    {
        $isUp = $percentage > 0;
        $isDown = $percentage < 0;

        return Stat::make($title, $value)
            ->color($color)
            ->description(
                $percentage == 0
                    ? 'No Change'
                    : (($isUp ? '+' : '') . number_format($percentage, 1) . '%')
            )
            ->descriptionIcon(
                $percentage == 0
                    ? 'heroicon-m-minus'
                    : ($isUp
                        ? 'heroicon-m-arrow-trending-up'
                        : 'heroicon-m-arrow-trending-down'
                    ),
                IconPosition::Before
            )
            ->descriptionColor(
                $percentage == 0
                    ? 'gray'
                    : ($isUp ? 'success' : 'danger')
            );
    }
}
