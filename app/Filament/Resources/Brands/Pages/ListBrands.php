<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBrands extends ListRecords
{
    protected static string $resource = BrandsResource::class;

    public function getSubheading(): ?string
    {
        return 'manage your Brands and create merchanding collections ..';
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                    ->label('Add Brand')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Add Brand')
                    ->modalWidth('lg')
                    ->createAnother(false)
                    ->modalSubmitActionLabel('Save')
                    ->modalSubmitAction(fn ($action) => $action->color('danger'))
                    ->modalCancelAction(fn ($action) => $action->label('Cancel')->color('cancel'))
        ];
    }
}
