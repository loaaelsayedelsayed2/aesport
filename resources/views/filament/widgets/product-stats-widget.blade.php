{{-- resources/views/filament/widgets/product-stats-widget.blade.php --}}

<x-filament-widgets::widget>
    <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:1rem;">
        @foreach($this->getStats() as $stat)
        <div style="
            background: #1c1c1c;
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            border: 1px solid #2a2a2a;
        ">
            <div style="color: {{ $stat['color'] }}; font-weight:600; font-size:0.95rem;">
                {{ $stat['title'] }}
            </div>

            <div style="color: {{ $stat['percent']['up'] ? '#22c55e' : '#ef4444' }}; font-size:0.75rem; font-weight:600;">
                {{ $stat['percent']['up'] ? '↑' : '↓' }} {{ $stat['percent']['value'] }}
            </div>

            <div style="color:white; font-size:1.85rem; font-weight:700; margin-top:0.25rem;">
                {{ $stat['value'] }}
            </div>
        </div>
        @endforeach
    </div>
</x-filament-widgets::widget>
