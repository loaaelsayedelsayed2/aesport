<div
    x-data="{
        open: false,
        selected: [],
        customInput: '',
        togglePreset(size) {
            const idx = this.selected.indexOf(size);
            if (idx === -1) this.selected.push(size);
            else this.selected.splice(idx, 1);
        },
        isSelected(size) {
            return this.selected.includes(size);
        },
        addAll() {
            const toAdd = [...this.selected];
            if (this.customInput.trim()) toAdd.push(this.customInput.trim());
            if (toAdd.length) $wire.addSizes(toAdd);
            this.selected    = [];
            this.customInput = '';
            this.open        = false;
        }
    }"
    style="position:relative"
>
    {{-- CHIPS ROW --}}
    <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;min-height:40px">

        @foreach ($sizes as $index => $size)
            <div style="position:relative">
                <span style="display:inline-flex;align-items:center;height:32px;padding:0 12px;border-radius:8px;border:1px solid #e5e7eb;background:#111827;color:#f3f4f6;font-size:13px;font-weight:500;cursor:default">
                    {{ $size }}
                </span>
                <button
                    type="button"
                    wire:click="removeSize({{ $index }})"
                    onmouseenter="this.style.display='flex'"
                    onmouseleave="this.style.display='none'"
                    style="display:none;position:absolute;top:-4px;right:-4px;width:16px;height:16px;border-radius:50%;background:#ef4444;color:#fff;font-size:11px;border:none;cursor:pointer;align-items:center;justify-content:center;padding:0;line-height:1"
                >×</button>
            </div>
        @endforeach

        <button
            type="button"
            @click="open = !open; selected = []; customInput = ''"
            style="height:32px;padding:0 12px;border-radius:8px;border:2px dashed #9ca3af;background:transparent;color:#9ca3af;font-size:13px;cursor:pointer;display:flex;align-items:center;gap:4px"
        >
            <span style="font-size:18px;line-height:1">+</span> Add Size
        </button>
    </div>

    {{-- INLINE DROPDOWN --}}
    <div
        x-show="open"
        x-transition
        @click.outside="open = false"
        style="margin-top:8px;width:100%;border-radius:12px;border:1px solid #374151;background:#1f2937;padding:16px;box-shadow:0 10px 25px rgba(0,0,0,0.4)"
        x-cloak
    >
        <p style="font-size:13px;font-weight:500;color:#f3f4f6;margin:0 0 4px">Choose sizes</p>
        <p style="font-size:11px;color:#6b7280;margin:0 0 12px">Tap to select · or type custom below</p>

        {{-- Clothing --}}
        <p style="font-size:10px;color:#6b7280;text-transform:uppercase;letter-spacing:.06em;margin:0 0 6px">Clothing</p>
        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px">
            @foreach ($presets['clothing'] as $size)
                @if(in_array($size, $sizes))
                    <span style="height:30px;padding:0 10px;border-radius:6px;border:1px solid #374151;background:#111827;color:#4b5563;font-size:12px;display:inline-flex;align-items:center;text-decoration:line-through">{{ $size }}</span>
                @else
                    <button
                        type="button"
                        @click="togglePreset('{{ $size }}')"
                        :style="isSelected('{{ $size }}') ? 'background:#f3f4f6;color:#111827;border-color:#f3f4f6' : 'background:#111827;color:#d1d5db;border-color:#374151'"
                        style="height:30px;padding:0 10px;border-radius:6px;border:1px solid;font-size:12px;cursor:pointer;transition:all .1s"
                    >{{ $size }}</button>
                @endif
            @endforeach
        </div>

        {{-- Shoes --}}
        <p style="font-size:10px;color:#6b7280;text-transform:uppercase;letter-spacing:.06em;margin:0 0 6px">Shoes</p>
        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px">
            @foreach ($presets['shoes'] as $size)
                @if(in_array($size, $sizes))
                    <span style="height:30px;padding:0 10px;border-radius:6px;border:1px solid #374151;background:#111827;color:#4b5563;font-size:12px;display:inline-flex;align-items:center;text-decoration:line-through">{{ $size }}</span>
                @else
                    <button
                        type="button"
                        @click="togglePreset('{{ $size }}')"
                        :style="isSelected('{{ $size }}') ? 'background:#f3f4f6;color:#111827;border-color:#f3f4f6' : 'background:#111827;color:#d1d5db;border-color:#374151'"
                        style="height:30px;padding:0 10px;border-radius:6px;border:1px solid;font-size:12px;cursor:pointer;transition:all .1s"
                    >{{ $size }}</button>
                @endif
            @endforeach
        </div>

        {{-- Custom input --}}
        <input
            type="text"
            x-model="customInput"
            @keydown.enter="addAll()"
            placeholder="Custom (e.g. 46, XXL, S/M)"
            maxlength="15"
            style="width:100%;height:36px;padding:0 10px;border-radius:8px;border:1px solid #4b5563;background:#111827;color:#f3f4f6;font-size:13px;outline:none;margin-bottom:12px;box-sizing:border-box"
        />

        {{-- Actions --}}
        <div style="display:flex;gap:8px">
            <button
                type="button"
                @click="open = false; selected = []; customInput = ''"
                style="flex:1;height:36px;border-radius:8px;border:1px solid #4b5563;background:transparent;color:#9ca3af;font-size:13px;cursor:pointer"
            >Cancel</button>
            <button
                type="button"
                @click="addAll()"
                style="flex:1;height:36px;border-radius:8px;border:none;background:#2563eb;color:#fff;font-size:13px;font-weight:500;cursor:pointer"
            >Add Sizes</button>
        </div>
    </div>
    <style>[x-cloak]{display:none!important}</style>
</div>
