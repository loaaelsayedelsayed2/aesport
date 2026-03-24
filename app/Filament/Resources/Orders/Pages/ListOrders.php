<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrdersResource;
use App\Filament\Widgets\OrderStatsWidget;
use App\Filament\Widgets\ReturnedOrdersWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrdersResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStatsWidget::class,
        ];
    }
    protected function getFooterWidgets(): array
    {
        return [
            ReturnedOrdersWidget::class,
        ];
    }
}
