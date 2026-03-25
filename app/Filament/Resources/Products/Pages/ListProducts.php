<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductsResource::class;

    public function getSubheading(): ?string
    {
        return 'manage your product catalog and inventory. ..';
    }
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\ProductStatsWidget::class,
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add Product')
                ->icon('heroicon-o-plus')
                ->modalHeading('Add Product')
                ->modalWidth('lg')
                ->createAnother(false)
                ->modalSubmitActionLabel('Save')
                ->modalSubmitAction(fn($action) => $action->color('danger'))
                ->modalCancelAction(fn($action) => $action->label('Cancel')->color('cancel'))
        ];
    }
}
