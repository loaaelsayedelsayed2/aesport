<?php

namespace App\Filament\Fields;

use Filament\Forms\Components\Field;

class SizePickerField extends Field
{
    protected string $view = 'filament.fields.size-picker-field';

    protected function setUp(): void
    {
        parent::setUp();

        // ── Load: قرا المقاسات من variants table لما بيفتح الفورم
        $this->afterStateHydrated(function (SizePickerField $component): void {
            $record = $component->getRecord();

            if (! $record || ! $record->exists) {
                $component->state([]);
                return;
            }

            $sizes = $record->sizeVariants()->pluck('value')->toArray();
            $component->state($sizes);
        });

        // ── Save: احفظ المقاسات في variants table لما بيتحفظ الفورم
        $this->dehydrated(false); // مش هيكتب في products table مباشرة

        $this->saveRelationshipsUsing(function (SizePickerField $component): void {
            $record = $component->getRecord();
            $sizes  = (array) ($component->getState() ?? []);

            // امسح القديم واكتب الجديد
            $record->variants()->where('key', 'size')->delete();

            foreach ($sizes as $size) {
                $size = strtoupper(trim($size));
                if ($size !== '') {
                    $record->variants()->create([
                        'key'   => 'size',
                        'value' => $size,
                    ]);
                }
            }
        });
    }
}
