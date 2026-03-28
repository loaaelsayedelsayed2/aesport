<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;

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
    public array $admin_profile_image = [];


    // Notifications
    public bool $notification_order_updates = false;
    public bool $notification_low_stock_alerts = false;
    public bool $notification_order_create = false;
    public bool $notification_customer_reviews = false;
    public bool $notification_system_updates = false;

    // Password
    public string $password = '';
    public string $password_confirmation = '';

    // Content
    public ?string $site_name = null;
    public ?string $home_hero_title = null;
    public ?string $home_hero_desc = null;
    public ?string $home_note_1 = null;
    public ?string $home_note_2 = null;
    public ?string $filter_page_image_1 = null;
    public ?string $filter_page_image_2 = null;
    public ?string $filter_page_image_3 = null;
    public ?string $filter_page_image_4 = null;
    public ?string $wishlist_page_image = null;
    public ?string $cart_page_image = null;

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

        $this->admin_name = auth()->user()->name;
        $this->admin_email = auth()->user()->email;
        $this->admin_profile_image = auth()->user()->profile_image
            ? [auth()->user()->profile_image]
            : [];

        $this->notification_order_updates    = (bool)($settings['notification_order_updates'] ?? false);
        $this->notification_low_stock_alerts = (bool)($settings['notification_low_stock_alerts'] ?? false);
        $this->notification_order_create     = (bool)($settings['notification_order_create'] ?? false);
        $this->notification_customer_reviews = (bool)($settings['notification_customer_reviews'] ?? false);
        $this->notification_system_updates   = (bool)($settings['notification_system_updates'] ?? false);

        $this->site_name           = $settings['site_name'] ?? null;
        $this->home_hero_title     = $settings['home_hero_title'] ?? null;
        $this->home_hero_desc      = $settings['home_hero_desc'] ?? null;
        $this->home_note_1         = $settings['home_note_1'] ?? null;
        $this->home_note_2         = $settings['home_note_2'] ?? null;
        $this->filter_page_image_1 = $settings['filter_page_image_1'] ?? null;
        $this->filter_page_image_2 = $settings['filter_page_image_2'] ?? null;
        $this->filter_page_image_3 = $settings['filter_page_image_3'] ?? null;
        $this->filter_page_image_4 = $settings['filter_page_image_4'] ?? null;
        $this->wishlist_page_image = $settings['wishlist_page_image'] ?? null;
        $this->cart_page_image     = $settings['cart_page_image'] ?? null;
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    protected function getFormSchema(): array
    {
        return match ($this->activeTab) {
            'profile' => [
                FileUpload::make('admin_profile_image')
                    ->label('Profile Image')
                    ->image()
                    ->disk('public')
                    ->directory('admin_profiles')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jpg']),
                TextInput::make('admin_name')->label('Name')->required(),
                TextInput::make('admin_email')->label('Email')->email()->required(),
            ],
            'notifications' => [
                Toggle::make('notification_order_updates')->label('Order Updates'),
                Toggle::make('notification_low_stock_alerts')->label('Low Stock Alerts'),
                Toggle::make('notification_order_create')->label('Order Create'),
                Toggle::make('notification_customer_reviews')->label('Customer Reviews'),
                Toggle::make('notification_system_updates')->label('System Updates'),
            ],
            'password' => [
                TextInput::make('password')->label('New Password')->password(),
                TextInput::make('password_confirmation')->label('Confirm Password')->password(),
            ],
            'content' => [
                TextInput::make('site_name')->label('Site Name'),
                TextInput::make('home_hero_title')->label('Home Hero Title'),
                TextInput::make('home_hero_desc')->label('Home Hero Description'),
                TextInput::make('home_note_1')->label('Home Note 1'),
                TextInput::make('home_note_2')->label('Home Note 2'),
                TextInput::make('filter_page_image_1')->label('Filter Image 1'),
                TextInput::make('filter_page_image_2')->label('Filter Image 2'),
                TextInput::make('filter_page_image_3')->label('Filter Image 3'),
                TextInput::make('filter_page_image_4')->label('Filter Image 4'),
                TextInput::make('wishlist_page_image')->label('Wishlist Image'),
                TextInput::make('cart_page_image')->label('Cart Image'),
            ],
            default => [],
        };
    }

    public function save(): void
    {
        auth()->user()->update([
            'name'  => $this->admin_name,
            'email' => $this->admin_email,
        ]);

        if (!empty($this->admin_profile_image)) {
            $file = array_values($this->admin_profile_image)[0];

            // لو TemporaryUploadedFile نقله للـ public disk
            if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                $path = $file->store('admin_profiles', 'public');
                auth()->user()->update(['profile_image' => $path]);
            } else {
                auth()->user()->update(['profile_image' => $file]);
            }
        }

        $keys = [
            'notification_order_updates',
            'notification_low_stock_alerts',
            'notification_order_create',
            'notification_customer_reviews',
            'notification_system_updates',
            'site_name',
            'home_hero_title',
            'home_hero_desc',
            'home_note_1',
            'home_note_2',
            'filter_page_image_1',
            'filter_page_image_2',
            'filter_page_image_3',
            'filter_page_image_4',
            'wishlist_page_image',
            'cart_page_image',
        ];

        foreach ($keys as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $this->$key]
            );
        }

        if ($this->password) {
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
