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
use Filament\Schemas\Components\Tabs;
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

    public array $data = [];
    public string $password = '';
    public string $password_confirmation = '';
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
        // Load key/value settings from DB
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->data = $settings;

        // Load admin info
        $this->data['admin_name'] = auth()->user()->name;
        $this->data['admin_email'] = auth()->user()->email;
        $this->data['admin_profile_image'] = auth()->user()->profile_image ?? null;
    }

    protected function getFormSchema(): array
    {
        return [
            Tabs::make('Settings')->tabs([

                // ---------------- Profile ----------------
                Tabs\Tab::make('Profile')->schema([
                    FileUpload::make('admin_profile_image')
                        ->label('Profile Image')
                        ->image()
                        ->directory('admin_profiles'),
                    TextInput::make('admin_name')->label('Name')->required(),
                    TextInput::make('admin_email')->label('Email')->email()->required(),
                ]),

                // ---------------- Notifications ----------------
                Tabs\Tab::make('Notifications')->schema([
                    Toggle::make('notification_order_updates')->label('Order Updates'),
                    Toggle::make('notification_low_stock_alerts')->label('Low Stock Alerts'),
                    Toggle::make('notification_order_create')->label('Order Create'),
                    Toggle::make('notification_customer_reviews')->label('Customer Reviews'),
                    Toggle::make('notification_system_updates')->label('System Updates'),
                ]),

                // ---------------- Change Password ----------------
                Tabs\Tab::make('Change Password')->schema([
                    TextInput::make('password')->label('New Password')->password(),
                    TextInput::make('password_confirmation')->label('Confirm Password')->password(),
                ]),

                // ---------------- Content ----------------
                Tabs\Tab::make('Content')->schema([
                    TextInput::make('site_name')->label('Site Name')->required(),
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
                ]),
            ]),
        ];
    }

    public function save()
    {
        // ---------------- Save Profile ----------------
        auth()->user()->update([
            'name' => $this->data['admin_name'] ?? auth()->user()->name,
            'email' => $this->data['admin_email'] ?? auth()->user()->email,
        ]);

        if (!empty($this->data['admin_profile_image'])) {
            auth()->user()->update([
                'profile_image' => $this->data['admin_profile_image'],
            ]);
        }

        // ---------------- Save Notifications & Content ----------------
        foreach ($this->data as $key => $value) {
            if (in_array($key, ['admin_name','admin_email','admin_profile_image'])) continue;

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // ---------------- Change Password ----------------
        if ($this->password) {
            if ($this->password === $this->password_confirmation) {
                auth()->user()->update([
                    'password' => Hash::make($this->password),
                ]);
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
