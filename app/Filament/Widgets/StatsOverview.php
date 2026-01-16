<?php

namespace App\Filament\Widgets;

use App\Models\Professional;
use App\Models\Member;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $pendingPros = Professional::where('validation_status', 'pending')->count();
        $pendingMembers = Member::where('status', 'pending')->count();
        $activeMembers = Member::where('status', 'active')->count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        return [
            Stat::make('Pros en attente', $pendingPros)
                ->description('À valider')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingPros > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.professionals.index', [
                    'tableFilters[validation_status][value]' => 'pending'
                ])),

            Stat::make('Membres en attente', $pendingMembers)
                ->description('Adhésions à valider')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color($pendingMembers > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.members.index', [
                    'tableFilters[status][value]' => 'pending'
                ])),

            Stat::make('Membres actifs', $activeMembers)
                ->description('Adhésions valides')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Messages non lus', $unreadMessages)
                ->description('À traiter')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'danger' : 'gray')
                ->url(route('filament.admin.resources.contact-messages.index')),
        ];
    }
}
