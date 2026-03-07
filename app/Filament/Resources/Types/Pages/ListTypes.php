<?php

namespace App\Filament\Resources\Types\Pages;

use App\Filament\Resources\Types\TypesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTypes extends ListRecords
{
    protected static string $resource = TypesResource::class;
    public function getSubheading(): ?string
    {
        return 'manage your types/genders and create merchanding collections ..';
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                    ->label('Add Type')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Add Type')
                    ->modalWidth('lg')
                    ->createAnother(false)
                    ->modalSubmitActionLabel('Save')
                    ->modalSubmitAction(fn ($action) => $action->color('danger'))
                    ->modalCancelAction(fn ($action) => $action->label('Cancel')->color('gray')),
        ];
    }
}
