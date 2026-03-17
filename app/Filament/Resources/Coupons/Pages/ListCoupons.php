<?php

namespace App\Filament\Resources\Coupons\Pages;

use App\Filament\Resources\Coupons\CouponsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCoupons extends ListRecords
{
    protected static string $resource = CouponsResource::class;

    public function getSubheading(): ?string
    {
        return 'manage promotional campaigns and marketing tools ..';
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add promotions')
                ->icon('heroicon-o-plus')
                ->modalHeading('Add promotions')
                ->modalWidth('lg')
                ->createAnother(false)
                ->modalSubmitActionLabel('Save')
                ->modalSubmitAction(fn($action) => $action->color('danger'))
                ->modalCancelAction(fn($action) => $action->label('Cancel')->color('cancel'))
        ];
    }
}
