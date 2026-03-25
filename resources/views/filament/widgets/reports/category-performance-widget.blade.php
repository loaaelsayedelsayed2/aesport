{{-- resources/views/filament/widgets/reports/category-performance-widget.blade.php --}}
<x-filament-widgets::widget>
    @php $data = $this->getData(); @endphp
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">

        {{-- Category Bar Chart --}}
        <div style="background:#1c1c1c; border-radius:12px; padding:1.25rem; border:1px solid #2a2a2a;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <div style="color:white; font-weight:600;">Product Performance By Category</div>
                <div style="display:flex; gap:1rem; font-size:0.75rem;">
                    <span style="display:flex; align-items:center; gap:4px;"><span style="width:10px;height:10px;background:#ef4444;border-radius:2px;display:inline-block;"></span><span style="color:#ccc;">Revenue</span></span>
                    <span style="display:flex; align-items:center; gap:4px;"><span style="width:10px;height:10px;background:#fff;border-radius:2px;display:inline-block;"></span><span style="color:#ccc;">Units Sold</span></span>
                </div>
            </div>
            <canvas id="categoryChart" height="160"></canvas>
        </div>

        {{-- Regional Performance --}}
        <div style="background:#1c1c1c; border-radius:12px; padding:1.25rem; border:1px solid #2a2a2a;">
            <div style="color:white; font-weight:600; margin-bottom:1rem;">Regional Performance</div>
            @php
                $regions = [
                    ['name' => 'Cairo', 'orders' => 1452, 'amount' => 14, 'percent' => 90],
                    ['name' => 'Giza', 'orders' => 1200, 'amount' => 12, 'percent' => 75],
                    ['name' => 'Alexandria', 'orders' => 980, 'amount' => 10, 'percent' => 60],
                    ['name' => 'Luxor', 'orders' => 600, 'amount' => 7, 'percent' => 40],
                    ['name' => 'Aswan', 'orders' => 300, 'amount' => 4, 'percent' => 20],
                ];
            @endphp
            @foreach($regions as $region)
            <div style="margin-bottom:1rem;">
                <div style="display:flex; justify-content:space-between; margin-bottom:4px;">
                    <div>
                        <div style="color:white; font-size:0.85rem; font-weight:600;">{{ $region['name'] }}</div>
                        <div style="color:#666; font-size:0.75rem;">{{ number_format($region['orders']) }} Orders</div>
                    </div>
                    <div style="color:white; font-weight:600;">{{ $region['amount'] }} K</div>
                </div>
                <div style="background:#2a2a2a; border-radius:4px; height:6px;">
                    <div style="background:#ef4444; height:6px; border-radius:4px; width:{{ $region['percent'] }}%;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const catCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(catCtx, {
            type: 'bar',
            data: {
                labels: @json($data['labels']),
                datasets: [
                    {
                        label: 'Revenue',
                        data: @json($data['revenue']),
                        backgroundColor: '#ef4444',
                        borderRadius: 4,
                    },
                    {
                        label: 'Units Sold',
                        data: @json($data['units']),
                        backgroundColor: '#ffffff',
                        borderRadius: 4,
                        barThickness: 8,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#666' }, grid: { color: '#2a2a2a' } },
                    y: { ticks: { color: '#666' }, grid: { color: '#2a2a2a' } },
                }
            }
        });
    </script>
</x-filament-widgets::widget>
