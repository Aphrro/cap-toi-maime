<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Cap Toi M\'aime Admin')
            ->darkMode(true)
            ->colors([
                'primary' => Color::hex('#7A1F2E'),
                'info' => Color::hex('#1E8A9B'),
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Annuaire')
                    ->icon('heroicon-o-book-open'),
                NavigationGroup::make()
                    ->label('Membres')
                    ->icon('heroicon-o-users'),
                NavigationGroup::make()
                    ->label('Événements')
                    ->icon('heroicon-o-calendar-days'),
                NavigationGroup::make()
                    ->label('Localisation')
                    ->icon('heroicon-o-map-pin')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Contenu')
                    ->icon('heroicon-o-document-text'),
                NavigationGroup::make()
                    ->label('Messages')
                    ->icon('heroicon-o-envelope')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Paramètres')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\PendingProfessionals::class,
                \App\Filament\Widgets\PendingMembers::class,
                \App\Filament\Widgets\ExpiringMembers::class,
                \App\Filament\Widgets\UpcomingEvents::class,
                \App\Filament\Widgets\QuickActions::class,
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
}
