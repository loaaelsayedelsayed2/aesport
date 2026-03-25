{{-- resources/views/filament/widgets/top-products-widget.blade.php --}}
<x-filament-widgets::widget>
    <div style="background:#1c1c1c; border-radius:12px; padding:1.25rem; border:1px solid #2a2a2a;">
        <div style="color:white; font-weight:600; margin-bottom:1rem;">🎁 Top Products</div>
        <table style="width:100%; border-collapse:collapse; font-size:0.82rem;">
            <thead>
                <tr style="background:#ef4444;">
                    <th style="padding:10px; text-align:left; color:white;">Product Name</th>
                    <th style="padding:10px; text-align:left; color:white;">Category</th>
                    <th style="padding:10px; text-align:left; color:white;">Price</th>
                    <th style="padding:10px; text-align:left; color:white;">Sales</th>
                    <th style="padding:10px; text-align:left; color:white;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($this->getProducts() as $item)
                <tr style="border-bottom:1px solid #2a2a2a;">
                    <td style="padding:10px; color:#ccc; display:flex; align-items:center; gap:8px;">
                        @if($item['product']['main_image'])
                            <img src="{{ Storage::url($item['product']['main_image']) }}" style="width:36px; height:36px; border-radius:6px; object-fit:cover;">
                        @endif
                        {{ $item['product']['name'] }}
                    </td>
                    <td style="padding:10px; color:#ccc;">{{ $item['product']['category'][0]['name'] ?? 'N/A' }}</td>
                    <td style="padding:10px; color:#ccc;">{{ $item['product']['price'] }}</td>
                    <td style="padding:10px; color:#ccc;">{{ $item['total_sales'] }}</td>
                    <td style="padding:10px; color:#22c55e; font-weight:600;">{{ number_format($item['total_amount'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-widgets::widget>
