<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrdersResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrders extends ViewRecord
{
    protected static string $resource = OrdersResource::class;

    public function getTitle(): string
    {
        return 'Order #' . $this->record->order_number;
    }
    protected function getHeaderActions(): array
    {
        return [];
    }
}
