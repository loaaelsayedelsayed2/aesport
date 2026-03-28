<x-filament::page>
    <div class="space-y-4">

        {{-- Tabs --}}
        <div class="flex gap-2 flex-wrap"
            style="background-color: #2B2B2B; padding: 10px; border-radius: 12px; margin-bottom: 16px;">
            @foreach([
                'profile'       => 'Profile',
                'notifications' => 'Notifications',
                'password'      => 'Change Password',
                'content'       => 'Content',
            ] as $key => $label)
                <button wire:click="setTab('{{ $key }}')"
                    style="
                        background-color: {{ $activeTab === $key ? '#B91818' : 'transparent' }};
                        color: {{ $activeTab === $key ? '#ffffff' : '#AFAFAF' }};
                        border: none; border-radius: 8px; padding: 8px 20px;
                        font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.2s;
                    ">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Content Card --}}
        <div style="background-color: #2B2B2B; border-radius: 12px; padding: 24px;">

            {{-- ===== Profile Tab ===== --}}
            @if($activeTab === 'profile')
                <h2 style="color: white; font-size: 18px; font-weight: 600; margin-bottom: 20px;">
                    Profile Information
                </h2>

                {{-- صورة + اسم + زرار --}}
                <div style="display: flex; flex-direction: row; align-items: center; gap: 20px; margin-bottom: 24px;">

                    {{-- الصورة --}}
                    @if(auth()->user()->profile_image)
                        <img id="profile-preview"
                            src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                            style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid #444; flex-shrink: 0;">
                    @else
                        <div id="profile-preview-placeholder"
                            style="width: 90px; height: 90px; border-radius: 50%;
                            background-color: #B91818; flex-shrink: 0;
                            display: flex; align-items: center; justify-content: center;
                            font-size: 32px; font-weight: bold; color: white;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif

                    {{-- الاسم + زرار --}}
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <p style="color: white; font-size: 18px; font-weight: 600; margin: 0;">
                            {{ auth()->user()->name }}
                        </p>
                        {{-- الزرار بيضغط على filepond --}}
                        <button type="button" id="change-photo-btn"
                            style="background-color: #B91818; color: white; border: none;
                            border-radius: 8px; padding: 6px 16px; font-size: 13px;
                            cursor: pointer; font-weight: 500; width: fit-content;">
                            Change Photo
                        </button>
                    </div>
                </div>
            @endif

            {{-- ===== Notifications Tab ===== --}}
            @if($activeTab === 'notifications')
                <h2 style="color: white; font-size: 18px; font-weight: 600; margin-bottom: 20px;">
                    Email Notification
                </h2>
            @endif

            {{-- ===== Change Password Tab ===== --}}
            @if($activeTab === 'password')
                <h2 style="color: white; font-size: 18px; font-weight: 600; margin-bottom: 20px;">
                    Change Password
                </h2>
            @endif

            {{-- ===== Content Tab ===== --}}
            @if($activeTab === 'content')
                <h2 style="color: white; font-size: 18px; font-weight: 600; margin-bottom: 20px;">
                    Content Settings
                </h2>
            @endif

            {{-- الـ Form --}}
            <form wire:submit.prevent="save">
                {{ $this->form }}
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // لما الصفحة تحمل نربط الزرار بالـ filepond
            function bindChangePhoto() {
                const btn = document.getElementById('change-photo-btn');
                if (btn) {
                    btn.onclick = function () {
                        // نضغط على الـ browse button بتاع filepond
                        const filePondInput = document.querySelector('.filepond--browser');
                        if (filePondInput) {
                            filePondInput.click();
                        }
                    };
                }
            }

            bindChangePhoto();

            // بعد كل Livewire update نربط تاني
            document.addEventListener('livewire:navigated', bindChangePhoto);
            Livewire.hook('commit', ({ succeed }) => {
                succeed(() => {
                    setTimeout(bindChangePhoto, 200);

                    // نحدث الصورة في الـ preview
                    setTimeout(() => {
                        const preview = document.querySelector('.filepond--item-panel');
                        if (preview) {
                            const img = document.getElementById('profile-preview');
                            const placeholder = document.getElementById('profile-preview-placeholder');
                            const previewImg = document.querySelector('.filepond--image-preview img');
                            if (previewImg && img) {
                                img.src = previewImg.src;
                            }
                        }
                    }, 500);
                });
            });
        });
    </script>

</x-filament::page>
