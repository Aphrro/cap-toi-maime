<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ExpiringMembers extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Adhésions expirant sous 30 jours';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Member::expiringSoon(30)->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->getStateUsing(fn ($record) => $record->first_name . ' ' . $record->last_name),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('membership_end')
                    ->label('Expire le')
                    ->date('d/m/Y')
                    ->color('warning'),
                Tables\Columns\TextColumn::make('days_remaining')
                    ->label('Jours restants')
                    ->getStateUsing(fn ($record) => now()->diffInDays($record->membership_end))
                    ->suffix(' jours')
                    ->color(fn ($state) => $state < 7 ? 'danger' : 'warning'),
            ])
            ->actions([
                Tables\Actions\Action::make('renew')
                    ->label('Renouveler (+1 an)')
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update([
                        'membership_end' => $record->membership_end->addYear()
                    ])),
                Tables\Actions\Action::make('contact')
                    ->label('Contacter')
                    ->icon('heroicon-o-envelope')
                    ->url(fn ($record) => 'mailto:' . $record->user->email),
            ])
            ->paginated(false)
            ->emptyStateHeading('Aucune adhésion proche de l\'expiration')
            ->emptyStateDescription('Toutes les adhésions sont à jour.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
