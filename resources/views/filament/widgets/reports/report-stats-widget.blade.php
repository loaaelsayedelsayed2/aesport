{{-- resources/views/filament/widgets/reports/report-stats-widget.blade.php --}}
<x-filament-widgets::widget>
    <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:1rem;">
        @foreach($this->getStats() as $stat)
        <div style="background:#1c1c1c; border-radius:12px; padding:1.25rem; display:flex; flex-direction:column; gap:0.5rem; border:1px solid #2a2a2a;">
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <div style="background:{{ $stat['iconBg'] }}; border-radius:8px; width:36px; height:36px; display:flex; align-items:center; justify-content:center;">
                    <x-dynamic-component :component="$stat['icon']" style="width:18px; height:18px; color:white;" />
                </div>
                <div style="color:white; font-weight:600; font-size:0.85rem;">{{ $stat['title'] }}</div>
            </div>
            <div style="color:white; font-size:1.5rem; font-weight:700;">{{ $stat['value'] }}</div>
            <div style="color:{{ $stat['percent']['up'] ? '#22c55e' : '#ef4444' }}; font-size:0.78rem; font-weight:600;">
                {{ $stat['percent']['up'] ? '↑' : '↓' }} {{ $stat['percent']['value'] }}
            </div>
        </div>
        @endforeach
    </div>
</x-filament-widgets::widget>
