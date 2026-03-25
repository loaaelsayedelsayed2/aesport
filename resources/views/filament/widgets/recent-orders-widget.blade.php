{{-- resources/views/filament/widgets/recent-orders-widget.blade.php --}}
<x-filament-widgets::widget>
    @php $data = $this->getData(); @endphp
        {{-- Recent Orders --}}
        <div style="background:#1c1c1c; border-radius:12px; padding:1.25rem; border:1px solid #2a2a2a;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <div style="color:white; font-weight:600;">🔄 Recent Orders</div>
                <a href="{{ route('filament.admin.resources.orders.index') }}"
                    style="color:#ef4444; font-size:0.8rem;">See All</a>
            </div>

            <table style=" border-collapse:collapse; font-size:0.8rem;">
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
                    @foreach ($data['orders'] as $order)
                        <tr style="border-bottom:1px solid #2a2a2a;">
                            <td style="padding:8px; color:#ef4444; font-weight:600;">#Ord-{{ $order->order_number }}
                            </td>
                            <td style="padding:8px; color:#ccc;">{{ $order->user?->fname }} {{ $order->user?->lname }}
                            </td>
                            <td style="padding:8px; color:#ccc;">{{ $order->total_amount }}</td>
                            <td style="padding:8px;">
                                <span
                                    style="
                                background: {{ match ($order->status) {
                                    'completed' => '#16a34a',
                                    'cancelled' => '#dc2626',
                                    'pending' => '#d97706',
                                    'delivered' => '#2563eb',
                                    default => '#6b7280',
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

</x-filament-widgets::widget>
