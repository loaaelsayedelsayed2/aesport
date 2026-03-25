{{-- resources/views/filament/widgets/recent-orders-widget.blade.php --}}
<x-filament-widgets::widget>
    @php $data = $this->getData(); @endphp
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">

        {{-- Recent Orders --}}
        <div style="background:#1c1c1c; border-radius:12px; padding:1.25rem; border:1px solid #2a2a2a;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <div style="color:white; font-weight:600;">🔄 Recent Orders</div>
                <a href="{{ route('filament.admin.resources.orders.index') }}" style="color:#ef4444; font-size:0.8rem;">See All</a>
            </div>

            <table style="width:100%; border-collapse:collapse; font-size:0.8rem;">
                <thead>
                    <tr style="background:#ef4444;">
                        <th style="padding:8px; text-align:left; color:white; border-radius:4px 0 0 4px;">Order Id</th>
                        <th style="padding:8px; text-align:left; color:white;">Customer</th>
                        <th style="padding:8px; text-align:left; color:white;">Price</th>
                        <th style="padding:8px; text-align:left; color:white;">Status</th>
                        <th style="padding:8px; text-align:left; color:white; border-radius:0 4px 4px 0;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['orders'] as $order)
                    <tr style="border-bottom:1px solid #2a2a2a;">
                        <td style="padding:8px; color:#ef4444; font-weight:600;">#Ord-{{ $order->order_number }}</td>
                        <td style="padding:8px; color:#ccc;">{{ $order->user?->fname }} {{ $order->user?->lname }}</td>
                        <td style="padding:8px; color:#ccc;">{{ $order->total_amount }}</td>
                        <td style="padding:8px;">
                            <span style="
                                background: {{ match($order->status) {
                                    'completed' => '#16a34a',
                                    'cancelled' => '#dc2626',
                                    'pending'   => '#d97706',
                                    'delivered' => '#2563eb',
                                    default     => '#6b7280',
                                } }};
                                color:white; padding:2px 8px; border-radius:4px; font-size:0.75rem;
                            ">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td style="padding:8px; color:#22c55e; font-weight:600;">{{ $order->total_amount }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Donut Chart --}}
        <div style="background:#1c1c1c; border-radius:12px; padding:1.25rem; border:1px solid #2a2a2a;">
            <div style="color:white; font-weight:600; margin-bottom:1rem;">🛒 Total Order</div>
            <div style="display:flex; flex-direction:column; align-items:center; gap:1rem;">
                <canvas id="orderDonut" width="200" height="200"></canvas>
                <div style="display:flex; flex-direction:column; gap:6px; width:100%;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <div style="display:flex; align-items:center; gap:6px;"><span style="width:12px;height:12px;background:#22c55e;border-radius:50%;display:inline-block;"></span><span style="color:#ccc; font-size:0.82rem;">New</span></div>
                        <span style="color:#ccc; font-size:0.82rem;">{{ $data['new'] }} Order</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <div style="display:flex; align-items:center; gap:6px;"><span style="width:12px;height:12px;background:#3b82f6;border-radius:50%;display:inline-block;"></span><span style="color:#ccc; font-size:0.82rem;">Completed</span></div>
                        <span style="color:#ccc; font-size:0.82rem;">{{ $data['completed'] }} Order</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <div style="display:flex; align-items:center; gap:6px;"><span style="width:12px;height:12px;background:#ef4444;border-radius:50%;display:inline-block;"></span><span style="color:#ccc; font-size:0.82rem;">Delivered</span></div>
                        <span style="color:#ccc; font-size:0.82rem;">{{ $data['delivered'] }} Order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('orderDonut').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['New', 'Completed', 'Delivered'],
                datasets: [{
                    data: [{{ $data['new'] }}, {{ $data['completed'] }}, {{ $data['delivered'] }}],
                    backgroundColor: ['#22c55e', '#3b82f6', '#ef4444'],
                    borderWidth: 0,
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true },
                },
            },
            plugins: [{
                id: 'centerText',
                beforeDraw(chart) {
                    const { width, height, ctx } = chart;
                    ctx.restore();
                    ctx.font = 'bold 14px sans-serif';
                    ctx.fillStyle = '#888';
                    ctx.textAlign = 'center';
                    ctx.fillText('Total', width / 2, height / 2 - 8);
                    ctx.font = 'bold 20px sans-serif';
                    ctx.fillStyle = '#fff';
                    ctx.fillText('{{ $data['total'] }}', width / 2, height / 2 + 14);
                    ctx.save();
                }
            }]
        });
    </script>
</x-filament-widgets::widget>
