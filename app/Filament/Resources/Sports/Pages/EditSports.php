<?php

namespace App\Filament\Resources\Sports\Pages;

use App\Filament\Resources\Sports\SportsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSports extends EditRecord
{
    protected static string $resource = SportsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
