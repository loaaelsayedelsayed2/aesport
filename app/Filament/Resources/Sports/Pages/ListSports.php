<?php

namespace App\Filament\Resources\Sports\Pages;

use App\Filament\Resources\Sports\SportsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSports extends ListRecords
{
    protected static string $resource = SportsResource::class;

    public function getSubheading(): ?string
    {
        return 'manage your sports and create merchanding collections ..';
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                    ->label('Add Sport')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Add Sport')
                    ->modalWidth('lg')
                    ->createAnother(false)
                    ->modalSubmitActionLabel('Save')
                    ->modalSubmitAction(fn ($action) => $action->color('danger'))
                    ->modalCancelAction(fn ($action) => $action->label('Cancel')->color('cancel'))
        ];
    }
}
