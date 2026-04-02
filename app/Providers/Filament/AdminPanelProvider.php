<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\DashboardStatsWidget;
use App\Filament\Widgets\OrdersDonutChart;
use App\Filament\Widgets\RecentOrdersWidget;
use App\Filament\Widgets\TopProductsWidget;
use App\Filament\Widgets\WelcomeWidget;
use App\Models\Setting;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Enums\DarkModeMode;
use Filament\Enums\ThemeMode;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->defaultThemeMode(ThemeMode::Dark)
            ->darkMode(false)
            ->id('admin')
            ->path('admin')
            ->brandLogo(asset('storage/' . Setting::where('key','site_logo')->first()->value))
            ->login()
            ->authGuard('admin')
            ->globalSearch(false)
            ->colors([
                'primary' => Color::hex('#B91818'),
                'danger' => Color::Red,
                'gray' => Color::hex('#FFFFFF'),
                'info' => Color::hex('#2186FF'),
                'success' => Color::hex('#34A853'),
                'warning' => Color::Yellow,
                'cancel' => Color::hex('#948e8e00')
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                WelcomeWidget::class,
                DashboardStatsWidget::class,
                RecentOrdersWidget::class,
                OrdersDonutChart::class,
                TopProductsWidget::class,

            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function getColumns(): int
    {
        return 2; // هيخلّيهم جنب بعض
    }
}
