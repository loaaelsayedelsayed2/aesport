{{-- resources/views/filament/widgets/welcome-widget.blade.php --}}
<x-filament-widgets::widget>
    @php $data = $this->getData(); @endphp
    <div style="
        background: #1c1c1c;
        border-radius: 12px;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #2a2a2a;
    ">
        <div>
            <div style="color:#f59e0b; font-size:0.85rem; margin-bottom:4px;">👋 Welcome Back ,</div>
            <div style="color:white; font-size:1.75rem; font-weight:700; margin-bottom:8px;">{{ $data['name'] }}</div>
            <div style="color:#888; font-size:0.875rem;">
                you have
                <span style="color:#ef4444; font-weight:600;">{{ $data['newOrders'] }}</span> new orders and
                <span style="color:#ef4444; font-weight:600;">{{ $data['shipments'] }}</span> pending shipments waiting for your action
            </div>
        </div>
        <div style="font-size:5rem; opacity:0.8;">🛍️</div>
    </div>
</x-filament-widgets::widget>
