<x-filament::page>
    <div class="space-y-4">

        {{-- Tabs --}}
        <div class="flex gap-2 flex-wrap"
            style="background-color: #2B2B2B; padding: 10px; border-radius: 12px; margin-bottom: 16px;">
            @foreach ([
        'profile' => 'Profile',
        'notifications' => 'Notifications',
        'password' => 'Change Password',
        'content' => 'Content',
    ] as $key => $label)
                <button wire:click="setTab('{{ $key }}')"
                    style="
                    background-color: {{ $activeTab === $key ? '#B91818' : 'transparent' }};
                    color: {{ $activeTab === $key ? '#ffffff' : '#AFAFAF' }};
                    border: none; border-radius: 8px; padding: 8px 20px;
                    font-size: 14px; font-weight: 500; cursor: pointer;
                ">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <div style="background-color: #2B2B2B; border-radius: 12px; padding: 24px;">

            {{-- ===== PROFILE ===== --}}
            @if ($activeTab === 'profile')
                <h2 style="color: white; font-size: 18px; font-weight: 600; margin-bottom: 20px;">
                    Profile Information
                </h2>

                <form wire:submit.prevent="save">
                    {{ $this->form }}
                </form>
            @endif

            {{-- ===== NOTIFICATIONS ===== --}}
            @if ($activeTab === 'notifications')
                <h2 style="color: white; font-size: 18px; font-weight: 600;">
                    Notifications
                </h2>
                <div style="display: flex; flex-direction: column;">
                    @foreach ([['key' => 'notification_order_create', 'label' => 'Order Create', 'desc' => 'Receive Notification When New Order Is Created.'], ['key' => 'notification_order_updates', 'label' => 'Order Updates', 'desc' => 'Receive Notification When Orders Are Placed.'], ['key' => 'notification_low_stock_alerts', 'label' => 'Low Stock Alerts', 'desc' => 'Get Notification When Products Are Running Low.'], ['key' => 'notification_customer_reviews', 'label' => 'Customer Reviews', 'desc' => 'Notification For A New Customer Reviews.'], ['key' => 'notification_system_updates', 'label' => 'System Updates', 'desc' => 'Important System Maintenance Notifications.']] as $notif)
                        <div
                            style="
                        display: flex; align-items: center; justify-content: space-between;
                        padding: 18px 0;
                        {{ !$loop->last ? 'border-bottom: 1px solid #3a3a3a;' : '' }}
                    ">
                            <div>
                                <p style="color: white; font-size: 15px; font-weight: 600; margin: 0 0 4px 0;">
                                    {{ $notif['label'] }}</p>
                                <p style="color: #9CA3AF; font-size: 13px; margin: 0;">{{ $notif['desc'] }}</p>
                            </div>
                            <div wire:click="$set('{{ $notif['key'] }}', {{ $this->{$notif['key']} ? 'false' : 'true' }})"
                                style="width: 48px; height: 26px; border-radius: 999px; cursor: pointer;
                                background-color: {{ $this->{$notif['key']} ? '#B91818' : '#555' }};
                                position: relative; flex-shrink: 0;">
                                <div
                                    style="position: absolute; top: 3px;
                                left: {{ $this->{$notif['key']} ? '25px' : '3px' }};
                                width: 20px; height: 20px; border-radius: 50%; background-color: white;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- ===== PASSWORD ===== --}}
            @if ($activeTab === 'password')
                <h2 style="color: white; font-size: 18px; font-weight: 600;">
                    Change Password
                </h2>

                <form wire:submit.prevent="save">
                    {{ $this->form }}
                </form>
            @endif

            {{-- ===== CONTENT ===== --}}
            @if ($activeTab === 'content')

                <h2 style="color: white; font-size: 18px; font-weight: 600; margin-bottom: 20px;">
                    Content Settings
                </h2>

                <form wire:submit.prevent="save" class="space-y-6">

                    {{-- ===== Site Info ===== --}}
                    <div style="background:#1e1e1e;padding:16px;border-radius:12px;margin-bottom: 20px;">
                        <h3 style="color:#e91a2199;margin-bottom:10px;">Site Info</h3>

                        <div class="mb-4">
                            <label style="color:#9CA3AF;font-size:13px;">Site Name</label>
                            <input wire:model.defer="site_name" type="text"
                                style="width:100%;background:#2B2B2B;border:1px solid #3a3a3a;
                            border-radius:8px;padding:10px;color:white;">
                        </div>

                        {{-- FileUpload --}}
                        {{ $this->form->getComponent('site_logo') }}
                    </div>

                    {{-- ===== Home ===== --}}
                    <div style="background:#1e1e1e;padding:16px;border-radius:12px;margin-bottom: 20px;">
                        <h3 style="color:#e91a2199;margin-bottom:10px;">Home</h3>

                        {{ $this->form->getComponent('home_hero_image') }}

                        <input wire:model.defer="home_hero_title" type="text" placeholder="Title..."
                            style="width:100%;margin-top:10px;background:#2B2B2B;border:1px solid #3a3a3a;
                        border-radius:8px;padding:10px;color:white;">

                        <input wire:model.defer="home_hero_desc" type="text" placeholder="Description..."
                            style="width:100%;margin-top:10px;background:#2B2B2B;border:1px solid #3a3a3a;
                        border-radius:8px;padding:10px;color:white;">
                        <div style="background-color: #1e1e1e; border-radius: 12px; padding: 16px;">
                            <div
                                style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                                <div>
                                    <p style="color: white; font-size: 15px; font-weight: 600; margin: 0 0 4px 0;">
                                        Announcement Bar</p>
                                    <p style="color: #9CA3AF; font-size: 12px; margin: 0;">Position : Below Hero Banner
                                    </p>
                                    @if ($home_promo_active)
                                        <span style="color: #22c55e; font-size: 12px;">● Active Now</span>
                                    @else
                                        <span style="color: #6b7280; font-size: 12px;">● Inactive</span>
                                    @endif
                                </div>
                                <div wire:click="$set('home_promo_active', {{ $home_promo_active ? 'false' : 'true' }})"
                                    style="width: 48px; height: 26px; border-radius: 999px; cursor: pointer;
                                background-color: {{ $home_promo_active ? '#B91818' : '#555' }};
                                position: relative; flex-shrink: 0;">
                                    <div
                                        style="position: absolute; top: 3px;
                                left: {{ $home_promo_active ? '25px' : '3px' }};
                                width: 20px; height: 20px; border-radius: 50%; background-color: white;">
                                    </div>
                                </div>
                            </div>
                            <input wire:model.defer="home_note_1" type="text"
                                placeholder="Promo Text 1 (e.g. FREE DELIVERY OVER 250 AED)..."
                                style="width: 100%; background-color: #2B2B2B; border: 1px solid #3a3a3a;
                            border-radius: 8px; padding: 10px 14px; color: white; font-size: 14px;
                            outline: none; box-sizing: border-box; margin-bottom: 10px; display: block;">
                            <input wire:model.defer="home_note_2" type="text"
                                placeholder="Promo Text 2 (e.g. SHOP NOW & PAY LATER)..."
                                style="width: 100%; background-color: #2B2B2B; border: 1px solid #3a3a3a;
                            border-radius: 8px; padding: 10px 14px; color: white; font-size: 14px;
                            outline: none; box-sizing: border-box; display: block;">
                            {{ $this->form->getComponent('home_sec2_title') }}
                        </div>
                    </div>



                    {{-- ===== Filter ===== --}}
                    <div style="background:#1e1e1e;padding:16px;border-radius:12px;margin-bottom: 20px;">
                        <h3 style="color:#e91a2199;margin-bottom:10px;">Filter Images</h3>

                        <div class="grid grid-cols-2 gap-4">
                            {{ $this->form->getComponent('filter_page_image_1') }}
                            {{ $this->form->getComponent('filter_page_image_2') }}
                            {{ $this->form->getComponent('filter_page_image_3') }}
                            {{ $this->form->getComponent('filter_page_image_4') }}
                        </div>
                    </div>

                    {{-- ===== Wishlist ===== --}}
                    <div style="background:#1e1e1e;padding:16px;border-radius:12px;margin-bottom: 20px;">
                        <h3 style="color:#e91a2199;margin-bottom:10px;">Wishlist</h3>

                        {{ $this->form->getComponent('wishlist_page_image') }}
                    </div>

                    {{-- ===== Cart ===== --}}
                    <div style="background:#1e1e1e;padding:16px;border-radius:12px;margin-bottom: 20px;">
                        <h3 style="color:#e91a2199;margin-bottom:10px;">Cart</h3>

                        {{ $this->form->getComponent('cart_page_image') }}
                    </div>
                    {{-- ===== Contact ===== --}}
                    <div style="margin-bottom: 32px;">
                        <p
                            style="color: #9CA3AF; font-size: 12px; font-weight: 600; text-transform: uppercase;
                                letter-spacing: 1px; margin-bottom: 12px;">
                            Contact Page</p>

                        <div style="background-color: #1e1e1e; border-radius: 12px; padding: 16px;">
                            <!-- Active Toggle -->
                            <div
                                style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                                <div>
                                    <p style="color: #e91a2199; font-size: 15px; font-weight: 600; margin: 0 0 4px 0;">
                                        Contact Page Status</p>
                                    <p style="color: #9CA3AF; font-size: 12px; margin: 0;">Enable/disable contact page
                                    </p>
                                    @if ($contact_active)
                                        <span style="color: #22c55e; font-size: 12px;">● Active Now</span>
                                    @else
                                        <span style="color: #6b7280; font-size: 12px;">● Inactive</span>
                                    @endif
                                </div>
                                <div wire:click="$set('contact_active', {{ $contact_active ? 'false' : 'true' }})"
                                    style="width: 48px; height: 26px; border-radius: 999px; cursor: pointer;
                        background-color: {{ $contact_active ? '#B91818' : '#555' }};
                        position: relative; flex-shrink: 0;">
                                    <div
                                        style="position: absolute; top: 3px;
                        left: {{ $contact_active ? '25px' : '3px' }};
                        width: 20px; height: 20px; border-radius: 50%; background-color: white;">
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Email -->
                            <div style="margin-bottom: 16px;">
                                <p style="color: white; font-size: 14px; font-weight: 600; margin: 0 0 8px 0;">Email
                                    Address</p>
                                <input wire:model="contact_email" type="email" placeholder="support@example.com"
                                    style="width: 100%; background-color: #2B2B2B; border: 1px solid #3a3a3a;
                        border-radius: 8px; padding: 10px 14px; color: white; font-size: 14px;
                        outline: none; box-sizing: border-box;">
                            </div>

                            <!-- Contact Phone -->
                            <div style="margin-bottom: 16px;">
                                <p style="color: white; font-size: 14px; font-weight: 600; margin: 0 0 8px 0;">Phone
                                    Number</p>
                                <input wire:model="contact_phone" type="tel" placeholder="+1 234 567 8900"
                                    style="width: 100%; background-color: #2B2B2B; border: 1px solid #3a3a3a;
                        border-radius: 8px; padding: 10px 14px; color: white; font-size: 14px;
                        outline: none; box-sizing: border-box;">
                            </div>

                            <!-- Contact Address -->
                            <div style="margin-bottom: 16px;">
                                <p style="color: white; font-size: 14px; font-weight: 600; margin: 0 0 8px 0;">Physical
                                    Address</p>
                                <textarea wire:model="contact_address" rows="3" placeholder="123 Business St, Suite 100, City, Country"
                                    style="width: 100%; background-color: #2B2B2B; border: 1px solid #3a3a3a;
                        border-radius: 8px; padding: 10px 14px; color: white; font-size: 14px;
                        outline: none; box-sizing: border-box; resize: vertical;"></textarea>
                            </div>
                        </div>
                    </div>

                </form>

            @endif

        </div>
    </div>
</x-filament::page>
