<x-filament::page>
    <div class="space-y-4">

        {{-- Tabs --}}
        <div class="flex gap-2 flex-wrap" style="background-color: #2B2B2B; padding: 10px; border-radius: 12px; margin-bottom: 20px;">
            @foreach([
                'profile'       => 'Profile',
                'notifications' => 'Notifications',
                'password'      => 'Change Password',
                'content'       => 'Content',
            ] as $key => $label)
                <button
                    wire:click="setTab('{{ $key }}')"
                    style="
                        background-color: {{ $activeTab === $key ? '#B91818' : 'transparent' }};
                        color: {{ $activeTab === $key ? '#ffffff' : '#AFAFAF' }};
                        border: none;
                        border-radius: 8px;
                        padding: 8px 20px;
                        font-size: 14px;
                        font-weight: 500;
                        cursor: pointer;
                        transition: all 0.2s;
                    "
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Content Card --}}
        <div style="background-color: #2B2B2B; border-radius: 12px; padding: 24px;">

            {{-- Profile Tab --}}
            @if($activeTab === 'profile')
                <div class="flex items-center gap-5 mb-6">
                    {{-- صورة البروفايل --}}
                    @if(auth()->user()->profile_image)
                        <img
                            src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                            class="rounded-full object-cover"
                            style="width: 80px; height: 80px; border: 2px solid #444;"
                        >
                    @else
                        <div style="
                            width: 80px; height: 80px;
                            border-radius: 50%;
                            background-color: #B91818;
                            display: flex; align-items: center; justify-content: center;
                            font-size: 28px; font-weight: bold; color: white;
                        ">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif

                    {{-- الاسم وزرار Change Photo --}}
                    <div>
                        <p style="color: white; font-size: 18px; font-weight: 600; margin: 0;">
                            {{ auth()->user()->name }}
                        </p>
                        <button style="
                            margin-top: 8px;
                            background-color: #B91818;
                            color: white;
                            border: none;
                            border-radius: 8px;
                            padding: 6px 16px;
                            font-size: 13px;
                            cursor: pointer;
                        ">
                            Change Photo
                        </button>
                    </div>
                </div>
            @endif

            {{-- Notifications Tab --}}
            @if($activeTab === 'notifications')
                <h2 style="color: white; font-size: 18px; font-weight: 600; margin-bottom: 20px;">
                    Email Notification
                </h2>
            @endif

            {{-- الـ Form --}}
            <form wire:submit.prevent="save">
                {{ $this->form }}
            </form>

        </div>
    </div>
</x-filament::page>
