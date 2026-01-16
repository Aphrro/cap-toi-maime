<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Carbon\Carbon;

class PendingMembers extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = '👥 Adhésions en attente de validation';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Member::query()
                    ->where('status', 'pending')
                    ->with('user')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->description(fn (Member $record) => $record->user?->email),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Demande le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Valider')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Valider cette adhésion ?')
                    ->modalDescription('Le membre pourra accéder à l\'annuaire.')
                    ->action(function (Member $record) {
                        $record->update([
                            'status' => 'active',
                            'membership_start' => Carbon::now(),
                            'membership_end' => Carbon::now()->addYear(),
                        ]);
                        Notification::make()
                            ->title('Adhésion validée ✅')
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Member $record) {
                        $record->update(['status' => 'cancelled']);
                        Notification::make()
                            ->title('Adhésion refusée')
                            ->warning()
                            ->send();
                    }),
            ])
            ->emptyStateHeading('Aucune adhésion en attente 🎉')
            ->emptyStateDescription('Toutes les adhésions ont été traitées.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
