{{-- resources/views/filament/widgets/reports/revenue-trend-widget.blade.php --}}
<x-filament-widgets::widget>
    @php $data = $this->getData(); @endphp
    <div style="background:#1c1c1c; border-radius:12px; padding:1.25rem; border:1px solid #2a2a2a;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div style="color:white; font-weight:600;">Revenue & Orders Trend</div>
            <span style="color:#ef4444; font-size:0.8rem;">Revenue ($)</span>
        </div>
        <canvas id="revenueTrendChart" height="80"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const trendCtx = document.getElementById('revenueTrendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: 'Revenue',
                    data: @json($data['revenue']),
                    borderColor: '#ef4444',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 0,
                }]
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
