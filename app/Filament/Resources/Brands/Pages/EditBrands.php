<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBrands extends EditRecord
{
    protected static string $resource = BrandsResource::class;

    protected function afterSave(): void
    {
        $this->saveVariants();
    }

    private function saveVariants(): void
    {
        $record = $this->getRecord();
        $data = $this->form->getRawState();

        $colors = json_decode($data['color_variants_json'] ?? '[]', true);
        $record->variants()->where('key', 'color')->delete();
        foreach ($colors as $color) {
            $record->variants()->create(['key' => 'color', 'value' => $color]);
        }

        $sizes = json_decode($data['size_variants_json'] ?? '[]', true);
        $record->variants()->where('key', 'size')->delete();
        foreach ($sizes as $size) {
            $record->variants()->create(['key' => 'size', 'value' => $size]);
        }
    }
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
