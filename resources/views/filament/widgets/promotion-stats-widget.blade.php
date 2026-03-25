{{-- resources/views/filament/widgets/promotion-stats-widget.blade.php --}}

<x-filament-widgets::widget>
    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:1rem;">
        @foreach($this->getStats() as $stat)
        <div style="
            background: #1c1c1c;
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            border: 1px solid #2a2a2a;
        ">
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <div style="
                    background: {{ $stat['iconBg'] }};
                    border-radius: 8px;
                    width: 42px; height: 42px;
                    display:flex; align-items:center; justify-content:center;
                ">
                    <x-dynamic-component :component="$stat['icon']" style="width:22px; height:22px; color:white;" />
                </div>
                <div style="color:white; font-weight:600; font-size:0.95rem;">
                    {{ $stat['title'] }}
                </div>
            </div>

            <div style="color:white; font-size:1.85rem; font-weight:700;">
                {{ $stat['prefix'] }}{{ $stat['value'] }}
            </div>
        </div>
        @endforeach
    </div>
</x-filament-widgets::widget>

