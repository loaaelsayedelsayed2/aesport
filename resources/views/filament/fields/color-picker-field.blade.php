<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @livewire('color-picker', [
        'statePath' => $getStatePath(),
        'colors'    => (array) ($getState() ?? []),
    ], key('color-picker-' . $getStatePath()))

    <input
        type="hidden"
        x-data="{}"
        x-init="
            $wire.on('colorsUpdated', ({ statePath, colors }) => {
                if (statePath === '{{ $getStatePath() }}') {
                    $wire.set('{{ $getStatePath() }}', colors)
                }
            })
        "
    />
</x-dynamic-component>
