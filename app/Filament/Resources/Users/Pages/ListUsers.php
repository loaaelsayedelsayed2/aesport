<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Filament\Resources\Users\Widgets\StatsUserOverview;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getSubheading(): ?string
    {
        return 'View and manage your customers.';
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    public function getTableRecordClasses(): ?array
    {
        return [
            'hover:bg-gray-50',
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsUserOverview::class,
        ];
    }
}
