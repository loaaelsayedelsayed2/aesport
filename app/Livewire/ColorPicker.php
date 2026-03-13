<?php

namespace App\Livewire;

use Livewire\Component;

class ColorPicker extends Component
{
    public string $statePath = '';
    public array $colors = [];

    public array $palette = [
        '#FFFFFF', '#F5F5F5', '#D3D3D3', '#A9A9A9',
        '#808080', '#555555', '#333333', '#000000',
        '#FFB3B3', '#FF6B6B', '#FF0000', '#CC0000',
        '#FFD9B3', '#FF9900', '#FF6600', '#E65C00',
        '#FFFACD', '#FFD700', '#FFC200', '#E6AC00',
        '#C8F0C8', '#90EE90', '#4CAF50', '#2E7D32',
        '#B3DCFF', '#66B2FF', '#2196F3', '#0D47A1',
        '#D9B3FF', '#B366FF', '#9C27B0', '#6A0080',
        '#FFB3DD', '#FF66B2', '#E91E63', '#880E4F',
        '#F5DEB3', '#D2691E', '#8B4513', '#3E2000',
    ];

    public function mount(string $statePath, array $colors = []): void
    {
        $this->statePath = $statePath;
        $this->colors    = $colors;
    }

    public function addColor(string $color): void
    {
        $color = strtoupper(trim($color));

        if (! preg_match('/^#[0-9A-Fa-f]{6}$/', $color)) {
            return;
        }

        if (! in_array($color, $this->colors)) {
            $this->colors[] = $color;
        }

        $this->dispatch('colorsUpdated', statePath: $this->statePath, colors: $this->colors);
    }

    public function removeColor(int $index): void
    {
        array_splice($this->colors, $index, 1);
        $this->colors = array_values($this->colors);

        $this->dispatch('colorsUpdated', statePath: $this->statePath, colors: $this->colors);
    }

    public function render()
    {
        return view('livewire.color-picker');
    }
}
