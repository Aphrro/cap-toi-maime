<?php

namespace App\Filament\Widgets;

use App\Models\Professional;
use App\Models\Member;
use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Pros à valider', Professional::where('validation_status', 'pending')->count())
                ->description('En attente de validation')
                ->color('warning')
                ->icon('heroicon-o-clock')
                ->url(route('filament.admin.resources.professionals.index', ['tableFilters[validation_status][value]' => 'pending'])),

            Stat::make('Pros actifs', Professional::where('validation_status', 'approved')->where('is_active', true)->count())
                ->description('Visibles dans l\'annuaire')
                ->color('success')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Membres actifs', Member::active()->count())
                ->description('Adhésions valides')
                ->color('info')
                ->icon('heroicon-o-users'),

            Stat::make('Événements à venir', Event::upcoming()->published()->count())
                ->description('Speed Dating programmés')
                ->icon('heroicon-o-calendar'),
        ];
    }
}
