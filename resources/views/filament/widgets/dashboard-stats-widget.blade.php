{{-- resources/views/filament/widgets/dashboard-stats-widget.blade.php --}}
<x-filament-widgets::widget>
    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:1rem;">
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
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <div style="background:{{ $stat['iconBg'] }}; border-radius:8px; width:38px; height:38px; display:flex; align-items:center; justify-content:center;">
                    <x-dynamic-component :component="$stat['icon']" style="width:20px; height:20px; color:white;" />
                </div>
                <div>
                    <div style="color:white; font-weight:600; font-size:0.85rem;">{{ $stat['title'] }}</div>
                    <div style="color:#555; font-size:0.72rem;">From Last 124 (Last 7 Day)</div>
                </div>
            </div>
            <div style="color:white; font-size:1.6rem; font-weight:700;">{{ $stat['value'] }}</div>
            <div style="color:{{ $stat['percent']['up'] ? '#22c55e' : '#ef4444' }}; font-size:0.78rem; font-weight:600;">
                {{ $stat['percent']['up'] ? '↑' : '↓' }} {{ $stat['percent']['value'] }}
            </div>
        </div>
        @endforeach
    </div>
</x-filament-widgets::widget>
