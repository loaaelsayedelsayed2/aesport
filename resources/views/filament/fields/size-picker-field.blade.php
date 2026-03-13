
<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @livewire('size-picker', [
        'statePath' => $getStatePath(),
        'sizes'     => (array) ($getState() ?? []),
    ], key('size-picker-' . $getStatePath()))

    <input
        type="hidden"
        x-data="{}"
        x-init="
            $wire.on('sizesUpdated', ({ statePath, sizes }) => {
                if (statePath === '{{ $getStatePath() }}') {
                    $wire.set('{{ $getStatePath() }}', sizes)
                }
            })
        "
    />
</x-dynamic-component>
