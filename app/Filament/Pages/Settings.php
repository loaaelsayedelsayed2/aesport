<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCog;
    protected static ?string $navigationLabel = 'Settings';
    protected static ?string $title = 'Settings';
    protected static ?string $slug = 'settings';
    protected static ?int $navigationSort = 10;
    protected string $view = 'filament.pages.settings';

    public string $activeTab = 'profile';

    // Profile
    public ?string $admin_name = null;
    public ?string $admin_email = null;
    public ?array $admin_profile_image = [];

    // Notifications
    public bool $notification_order_updates    = false;
    public bool $notification_low_stock_alerts = false;
    public bool $notification_order_create     = false;
    public bool $notification_customer_reviews = false;
    public bool $notification_system_updates   = false;

    // Password
    public string $password = '';
    public string $password_confirmation = '';

    // Content - Site Info
    public ?string $site_name = null;
    public ?array $site_logo = [];

    // Content - Home
    public ?string $home_hero_title = null;
    public ?string $home_hero_desc  = null;
    public ?array $home_hero_image   = [];
    public ?string $home_note_1     = null;
    public ?string $home_note_2     = null;
    public bool $home_promo_active  = false;

    // Content - Filter
    public ?array $filter_page_image_1 = [];
    public ?array $filter_page_image_2 = [];
    public ?array $filter_page_image_3 = [];
    public ?array $filter_page_image_4 = [];
    public bool $filter_active        = false;

    // Content - Wishlist
    public ?array $wishlist_page_image = [];
    public bool $wishlist_active      = false;

    // Content - Cart
    public ?array $cart_page_image = [];
    public bool $cart_active      = false;

    // Content - Contact
    public bool $contact_active = false;
    public ?string $contact_title = null;
    public ?string $contact_subtitle = null;
    public ?string $contact_email = null;
    public ?string $contact_phone = null;
    public ?string $contact_address = null;
    public ?array $contact_banner_image = [];
    public ?array $contact_map_image = [];

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->button()
                ->color('danger')
                ->action('save'),
        ];
    }

    public function mount(): void
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        $this->admin_name  = auth()->user()->name;
        $this->admin_email = auth()->user()->email;
        $this->admin_profile_image = auth()->user()->profile_image
            ? [auth()->user()->profile_image]
            : [];

        $this->notification_order_updates    = (bool)($settings['notification_order_updates'] ?? false);
        $this->notification_low_stock_alerts = (bool)($settings['notification_low_stock_alerts'] ?? false);
        $this->notification_order_create     = (bool)($settings['notification_order_create'] ?? false);
        $this->notification_customer_reviews = (bool)($settings['notification_customer_reviews'] ?? false);
        $this->notification_system_updates   = (bool)($settings['notification_system_updates'] ?? false);

        $this->site_name = $settings['site_name'] ?? null;
        $this->site_logo = isset($settings['site_logo']) ? [$settings['site_logo']] : [];

        $this->home_hero_title  = $settings['home_hero_title'] ?? null;
        $this->home_note_1  = $settings['home_note_1'] ?? null;
        $this->home_note_2  = $settings['home_note_2'] ?? null;
        $this->home_hero_desc   = $settings['home_hero_desc'] ?? null;
        $this->home_hero_image  = isset($settings['home_hero_image']) ? [$settings['home_hero_image']] : [];
        $this->home_promo_active = (bool)($settings['home_promo_active'] ?? false);

        $this->filter_page_image_1 = isset($settings['filter_page_image_1']) ? [$settings['filter_page_image_1']] : [];
        $this->filter_page_image_2 = isset($settings['filter_page_image_2']) ? [$settings['filter_page_image_2']] : [];
        $this->filter_page_image_3 = isset($settings['filter_page_image_3']) ? [$settings['filter_page_image_3']] : [];
        $this->filter_page_image_4 = isset($settings['filter_page_image_4']) ? [$settings['filter_page_image_4']] : [];
        $this->filter_active       = (bool)($settings['filter_active'] ?? false);

        $this->wishlist_page_image = isset($settings['wishlist_page_image']) ? [$settings['wishlist_page_image']] : [];
        $this->wishlist_active     = (bool)($settings['wishlist_active'] ?? false);

        $this->cart_page_image = isset($settings['cart_page_image']) ? [$settings['cart_page_image']] : [];
        $this->cart_active     = (bool)($settings['cart_active'] ?? false);

        $this->contact_active = (bool)($settings['contact_active'] ?? false);
        $this->contact_title = $settings['contact_title'] ?? null;
        $this->contact_subtitle = $settings['contact_subtitle'] ?? null;
        $this->contact_email = $settings['contact_email'] ?? null;
        $this->contact_phone = $settings['contact_phone'] ?? null;
        $this->contact_address = $settings['contact_address'] ?? null;
        $this->contact_banner_image = isset($settings['contact_banner_image']) ? [$settings['contact_banner_image']] : [];
        $this->contact_map_image = isset($settings['contact_map_image']) ? [$settings['contact_map_image']] : [];
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('admin_profile_image')
                ->label('Profile Image')
                ->image()
                ->disk('public')
                ->directory('admin_profiles')
                ->visibility('public')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jpg'])
                ->maxSize(2048)
                ->multiple(false)
                ->preserveFilenames()
                ->imageResizeTargetWidth(500)
                ->imageResizeTargetHeight(500)
                ->hidden(fn() => $this->activeTab !== 'profile'),

            TextInput::make('admin_name')
                ->label('Name')
                ->required()
                ->hidden(fn() => $this->activeTab !== 'profile'),

            TextInput::make('admin_email')
                ->label('Email')
                ->email()
                ->required()
                ->hidden(fn() => $this->activeTab !== 'profile'),

            Toggle::make('notification_order_updates')
                ->label('Order Updates')
                ->hidden(fn() => $this->activeTab !== 'notifications'),

            Toggle::make('notification_low_stock_alerts')
                ->label('Low Stock Alerts')
                ->hidden(fn() => $this->activeTab !== 'notifications'),

            Toggle::make('notification_order_create')
                ->label('Order Create')
                ->hidden(fn() => $this->activeTab !== 'notifications'),

            Toggle::make('notification_customer_reviews')
                ->label('Customer Reviews')
                ->hidden(fn() => $this->activeTab !== 'notifications'),

            Toggle::make('notification_system_updates')
                ->label('System Updates')
                ->hidden(fn() => $this->activeTab !== 'notifications'),

            TextInput::make('password')
                ->label('New Password')
                ->password()
                ->hidden(fn() => $this->activeTab !== 'password'),

            TextInput::make('password_confirmation')
                ->label('Confirm Password')
                ->password()
                ->hidden(fn() => $this->activeTab !== 'password'),

            // Content fields
            TextInput::make('site_name')
                ->label('Site Name')
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('site_logo')
                ->label('Site Logo')
                ->image()
                ->disk('public')
                ->directory('website')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('home_hero_image')
                ->label('Hero Image')
                ->image()
                ->disk('public')
                ->directory('home')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            TextInput::make('home_hero_title')
                ->label('Hero Title')
                ->hidden(fn() => $this->activeTab !== 'content'),

            TextInput::make('home_hero_desc')
                ->label('Hero Description')
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('filter_page_image_1')
                ->label('Filter Image 1')
                ->image()
                ->disk('public')
                ->directory('filter')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('filter_page_image_2')
                ->label('Filter Image 2')
                ->image()
                ->disk('public')
                ->directory('filter')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('filter_page_image_3')
                ->label('Filter Image 3')
                ->image()
                ->disk('public')
                ->directory('filter')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('filter_page_image_4')
                ->label('Filter Image 4')
                ->image()
                ->disk('public')
                ->directory('filter')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('wishlist_page_image')
                ->label('Wishlist Image')
                ->image()
                ->disk('public')
                ->directory('wishlist')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('cart_page_image')
                ->label('Cart Image')
                ->image()
                ->disk('public')
                ->directory('cart')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('contact_banner_image')
                ->label('Contact Banner')
                ->image()
                ->disk('public')
                ->directory('contact')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            FileUpload::make('contact_map_image')
                ->label('Contact Map')
                ->image()
                ->disk('public')
                ->directory('contact')
                ->multiple(false)
                ->hidden(fn() => $this->activeTab !== 'content'),

            TextInput::make('contact_title')
                ->label('Contact Title')
                ->hidden(fn() => $this->activeTab !== 'content'),

            TextInput::make('contact_email')
                ->label('Contact Email')
                ->email()
                ->hidden(fn() => $this->activeTab !== 'content'),
        ];
    }

    public function save(): void
    {
        if (!empty($this->admin_profile_image)) {
            $cleanImage = null;

            foreach ($this->admin_profile_image as $key => $value) {
                if ($value instanceof TemporaryUploadedFile) {
                    $cleanImage = $value;
                    break;
                }
            }

            if (!$cleanImage) {
                foreach ($this->admin_profile_image as $value) {
                    if (is_string($value) && !empty($value)) {
                        $cleanImage = $value;
                        break;
                    }
                }
            }

            if ($cleanImage instanceof TemporaryUploadedFile) {
                $path = $cleanImage->store('admin_profiles', 'public');
                auth()->user()->profile_image = $path;
                auth()->user()->save();

                $this->admin_profile_image = [$path];
            } elseif (is_string($cleanImage)) {
                auth()->user()->profile_image = $cleanImage;
                auth()->user()->save();
                $this->admin_profile_image = [$cleanImage];
            }
        }

        auth()->user()->update([
            'name' => $this->admin_name,
            'email' => $this->admin_email,
        ]);

        // ========== 3. حفظ جميع صور المحتوى ==========
        $imageFields = [
            'site_logo' => 'website',
            'home_hero_image' => 'home',
            'filter_page_image_1' => 'filter',
            'filter_page_image_2' => 'filter',
            'filter_page_image_3' => 'filter',
            'filter_page_image_4' => 'filter',
            'wishlist_page_image' => 'wishlist',
            'cart_page_image' => 'cart',
            'contact_banner_image' => 'contact',
            'contact_map_image' => 'contact',
        ];

        foreach ($imageFields as $field => $directory) {
            if (!empty($this->$field)) {
                // تنظيف المصفوفة بنفس الطريقة
                $cleanImage = null;

                // البحث عن ملف جديد (TemporaryUploadedFile)
                foreach ($this->$field as $key => $value) {
                    if ($value instanceof TemporaryUploadedFile) {
                        $cleanImage = $value;
                        break;
                    }
                }

                // إذا لم نجد ملف جديد، خذ أول مسار نصي
                if (!$cleanImage) {
                    foreach ($this->$field as $value) {
                        if (is_string($value) && !empty($value)) {
                            $cleanImage = $value;
                            break;
                        }
                    }
                }

                // حفظ الصورة
                if ($cleanImage instanceof TemporaryUploadedFile) {
                    $path = $cleanImage->store($directory, 'public');
                    Setting::updateOrCreate(
                        ['key' => $field],
                        ['value' => $path]
                    );
                    // إعادة تعيين المتغير إلى المسار النظيف
                    $this->$field = [$path];
                } elseif (is_string($cleanImage)) {
                    Setting::updateOrCreate(
                        ['key' => $field],
                        ['value' => $cleanImage]
                    );
                    $this->$field = [$cleanImage];
                }
            }
        }

        // ========== 4. حفظ النصوص ==========
        $textFields = [
            'site_name',
            'home_hero_title',
            'home_hero_desc',
            'home_note_1',
            'home_note_2',
            'contact_title',
            'contact_subtitle',
            'contact_email',
            'contact_phone',
            'contact_address'
        ];

        foreach ($textFields as $field) {
            if (isset($this->$field)) {
                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $this->$field]
                );
            }
        }

        // ========== 5. حفظ الحالات المنطقية ==========
        $booleanFields = [
            'home_promo_active',
            'filter_active',
            'wishlist_active',
            'cart_active',
            'contact_active',
            'notification_order_updates',
            'notification_low_stock_alerts',
            'notification_order_create',
            'notification_customer_reviews',
            'notification_system_updates'
        ];

        foreach ($booleanFields as $field) {
            Setting::updateOrCreate(
                ['key' => $field],
                ['value' => $this->$field ? 1 : 0]
            );
        }

        // ========== 6. تغيير كلمة المرور ==========
        if (!empty($this->password)) {
            if ($this->password === $this->password_confirmation) {
                auth()->user()->update(['password' => Hash::make($this->password)]);
                $this->password = '';
                $this->password_confirmation = '';
            } else {
                \Filament\Notifications\Notification::make()
                    ->title('Passwords do not match')
                    ->danger()
                    ->send();
                return;
            }
        }

        // ========== 7. تنظيف نهائي ==========
        // إعادة تحميل البيانات من قاعدة البيانات
        $this->mount();

        \Filament\Notifications\Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }

    protected function getFormModel(): array|string|null
    {
        return null;
    }
}
