<?php

namespace App\Filament\Resources\Types\Pages;

use App\Filament\Resources\Types\TypesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTypes extends EditRecord
{
    protected static string $resource = TypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
