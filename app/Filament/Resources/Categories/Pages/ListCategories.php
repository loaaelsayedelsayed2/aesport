<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    public function getSubheading(): ?string
    {
        return 'manage your categories and create merchanding collections ..';
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                    ->label('Add Category')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Add Category')
                    ->modalWidth('lg')
                    ->createAnother(false)
                    ->modalSubmitActionLabel('Save')
                    ->modalSubmitAction(fn ($action) => $action->color('danger'))
                    ->modalCancelAction(fn ($action) => $action->label('Cancel')->color('gray')),
        ];
    }
}
