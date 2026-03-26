{{-- resources/views/filament/widgets/reports/category-performance-widget.blade.php --}}

<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-white">Product Performance By Category</h2>
            <div class="flex items-center gap-4 text-xs">
                <span class="flex items-center gap-1">
                    <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-gray-400">Revenue</span>
                </span>
                <span class="flex items-center gap-1">
                    <span class="inline-block w-2 h-2 rounded-full bg-blue-500"></span>
                    <span class="text-gray-400">Units Sold</span>
                </span>
            </div>
        </div>

        <canvas id="categoryChart" height="100"></canvas>
    </x-filament::section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('categoryChart').getContext('2d');

            const data = @json($this->getData());

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: 'Revenue ($)',
                            data: data.revenue,
                            backgroundColor: 'rgba(239, 68, 68, 0.8)',
                            borderColor: '#ef4444',
                            borderWidth: 1,
                            borderRadius: 4,
                            yAxisID: 'y',
                        },
                        {
                            label: 'Units Sold',
                            data: data.units,
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderColor: '#3b82f6',
                            borderWidth: 1,
                            borderRadius: 4,
                            yAxisID: 'y1',
                        },
                    ],
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            position: 'left',
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255,255,255,0.08)',
                                borderDash: [4, 4],
                            },
                            ticks: {
                                color: '#9ca3af',
                                callback: (val) => '$' + val.toLocaleString(),
                            },
                            border: { dash: [4, 4] },
                        },
                        y1: {
                            type: 'linear',
                            position: 'right',
                            beginAtZero: true,
                            grid: { drawOnChartArea: false },
                            ticks: { color: '#9ca3af' },
                        },
                        x: {
                            grid: {
                                color: 'rgba(255,255,255,0.08)',
                                borderDash: [4, 4],
                            },
                            ticks: { color: '#9ca3af' },
                            border: { dash: [4, 4] },
                        },
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleColor: '#f9fafb',
                            bodyColor: '#9ca3af',
                            borderColor: '#374151',
                            borderWidth: 1,
                        },
                    },
                },
            });
        });
    </script>
    @endpush
</x-filament-widgets::widget>
