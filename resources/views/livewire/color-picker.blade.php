<div
    x-data="{
        open: false,
        currentColor: '#FF5733',
        hexInput: '#FF5733',
        pickerColor: '#FF5733',
        setColor(c) {
            this.currentColor = c;
            this.hexInput     = c;
            this.pickerColor  = c;
        },
        hexChanged() {
            const v = this.hexInput;
            if (/^#[0-9A-Fa-f]{6}$/.test(v)) {
                this.currentColor = v.toUpperCase();
                this.pickerColor  = v;
            }
        },
        pickerChanged(val) {
            this.currentColor = val.toUpperCase();
            this.hexInput     = val.toUpperCase();
        }
    }"
    style="position:relative"
>
    {{-- CHIPS ROW --}}
    <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;min-height:40px">

        @foreach ($colors as $index => $color)
            <div style="position:relative;width:36px;height:36px">
                <div
                    style="width:36px;height:36px;border-radius:50%;background:{{ $color }};border:2px solid {{ ($color === '#FFFFFF' || $color === '#F5F5F5') ? '#D1D5DB' : $color }};cursor:default"
                    title="{{ $color }}"
                ></div>
                <button
                    type="button"
                    wire:click="removeColor({{ $index }})"
                    onmouseenter="this.style.display='flex'"
                    onmouseleave="this.style.display='none'"
                    style="display:none;position:absolute;top:-4px;right:-4px;width:16px;height:16px;border-radius:50%;background:#ef4444;color:#fff;font-size:11px;border:none;cursor:pointer;align-items:center;justify-content:center;padding:0;line-height:1"
                >×</button>
            </div>
        @endforeach

        <button
            type="button"
            @click="open = !open"
            style="width:36px;height:36px;border-radius:50%;border:2px dashed #9ca3af;background:transparent;cursor:pointer;font-size:20px;color:#9ca3af;display:flex;align-items:center;justify-content:center;line-height:1;padding:0"
        >+</button>
    </div>

    {{-- INLINE DROPDOWN --}}
    <div
        x-show="open"
        x-transition
        @click.outside="open = false"
        style="margin-top:8px;width:100%;border-radius:12px;border:1px solid #374151;background:#1f2937;padding:16px;box-shadow:0 10px 25px rgba(0,0,0,0.4)"
        x-cloak
    >
        <p style="font-size:13px;font-weight:500;color:#f3f4f6;margin:0 0 12px">Choose a color</p>

        <div style="display:grid;grid-template-columns:repeat(8,1fr);gap:6px;margin-bottom:12px">
            @foreach ($palette as $pc)
                <button
                    type="button"
                    @click="setColor('{{ $pc }}')"
                    style="width:100%;aspect-ratio:1/1;border-radius:50%;background:{{ $pc }};border:2px solid {{ ($pc === '#FFFFFF' || $pc === '#F5F5F5') ? '#6b7280' : 'transparent' }};cursor:pointer;padding:0;transition:transform .1s"
                    :style="currentColor === '{{ $pc }}' ? 'transform:scale(1.2);outline:2px solid #fff;outline-offset:1px' : ''"
                    title="{{ $pc }}"
                ></button>
            @endforeach
        </div>

        <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px">
            <div
                style="width:36px;height:36px;border-radius:50%;flex-shrink:0;border:1px solid #4b5563"
                :style="'background:' + currentColor"
            ></div>
            <input
                type="text"
                x-model="hexInput"
                @input="hexChanged()"
                maxlength="7"
                placeholder="#FF5733"
                style="flex:1;height:36px;padding:0 10px;border-radius:8px;border:1px solid #4b5563;background:#111827;color:#f3f4f6;font-size:13px;outline:none"
            />
        </div>

        <input
            type="color"
            x-model="pickerColor"
            @input="pickerChanged($event.target.value)"
            style="width:100%;height:40px;border-radius:8px;border:1px solid #4b5563;background:#111827;cursor:pointer;padding:2px;margin-bottom:12px;display:block"
        />

        <div style="display:flex;gap:8px">
            <button
                type="button"
                @click="open = false"
                style="flex:1;height:36px;border-radius:8px;border:1px solid #4b5563;background:transparent;color:#9ca3af;font-size:13px;cursor:pointer"
            >Cancel</button>
            <button
                type="button"
                @click="$wire.addColor(currentColor); open = false;"
                style="flex:1;height:36px;border-radius:8px;border:none;background:#2563eb;color:#fff;font-size:13px;font-weight:500;cursor:pointer"
            >Add Color</button>
        </div>
    </div>
    <style>[x-cloak]{display:none!important}</style>
</div>
