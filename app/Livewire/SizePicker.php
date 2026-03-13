<?php

namespace App\Livewire;

use Livewire\Component;

class SizePicker extends Component
{
    public string $statePath = '';
    public array $sizes = [];

    public array $presets = [
        'clothing' => ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL'],
        'shoes'    => ['36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47'],
        'other'    => ['One Size', 'Free Size'],
    ];

    public function mount(string $statePath, array $sizes = []): void
    {
        $this->statePath = $statePath;
        $this->sizes     = $sizes;
    }

    public function addSize(string $size): void
    {
        $size = strtoupper(trim($size));

        if ($size === '') {
            return;
        }

        if (! in_array($size, $this->sizes)) {
            $this->sizes[] = $size;
        }

        $this->dispatch('sizesUpdated', statePath: $this->statePath, sizes: $this->sizes);
    }

    public function addSizes(array $sizes): void
    {
        foreach ($sizes as $size) {
            $size = strtoupper(trim($size));
            if ($size !== '' && ! in_array($size, $this->sizes)) {
                $this->sizes[] = $size;
            }
        }

        $this->dispatch('sizesUpdated', statePath: $this->statePath, sizes: $this->sizes);
    }

    public function removeSize(int $index): void
    {
        array_splice($this->sizes, $index, 1);
        $this->sizes = array_values($this->sizes);

        $this->dispatch('sizesUpdated', statePath: $this->statePath, sizes: $this->sizes);
    }

    public function render()
    {
        return view('livewire.size-picker');
    }
}
