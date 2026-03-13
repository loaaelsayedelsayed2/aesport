<?php

namespace App\Filament\Fields;

use Filament\Forms\Components\Field;

class ColorPickerField extends Field
{
    protected string $view = 'filament.fields.color-picker-field';

    protected function setUp(): void
    {
        parent::setUp();

        // ── Load: قرا الألوان من variants table لما بيفتح الفورم
        $this->afterStateHydrated(function (ColorPickerField $component): void {
            $record = $component->getRecord();

            if (! $record || ! $record->exists) {
                $component->state([]);
                return;
            }

            $colors = $record->colorVariants()->pluck('value')->toArray();
            $component->state($colors);
        });

        // ── Save: احفظ الألوان في variants table لما بيتحفظ الفورم
        $this->dehydrated(false); // مش هيكتب في products table مباشرة

        $this->saveRelationshipsUsing(function (ColorPickerField $component): void {
            $record = $component->getRecord();
            $colors = (array) ($component->getState() ?? []);

            // امسح القديم واكتب الجديد
            $record->variants()->where('key', 'color')->delete();

            foreach ($colors as $color) {
                $color = strtoupper(trim($color));
                if (preg_match('/^#[0-9A-Fa-f]{6}$/', $color)) {
                    $record->variants()->create([
                        'key'   => 'color',
                        'value' => $color,
                    ]);
                }
            }
        });
    }
}
