<?php

namespace App\Filament\Widgets;

use App\Models\ParentProfile;
use App\Models\Professional;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Parents inscrits', User::where('user_type', 'parent')->count())
                ->description('Total des comptes parents')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),

            Stat::make('Professionnels', Professional::approved()->count())
                ->description('Visibles dans l\'annuaire')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('info'),

            Stat::make('En attente', Professional::pending()->count())
                ->description('Professionnels a valider')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Utilisateurs actifs', User::where('is_active', true)->count())
                ->description('Comptes actifs')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('primary'),
        ];
    }
}
