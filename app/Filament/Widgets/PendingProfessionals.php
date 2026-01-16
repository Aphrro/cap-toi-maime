<?php

namespace App\Filament\Widgets;

use App\Models\Professional;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class PendingProfessionals extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = '🔔 Professionnels en attente de validation';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Professional::query()
                    ->where('validation_status', 'pending')
                    ->with(['category', 'city', 'canton'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->description(fn (Professional $record) => $record->email)
                    ->searchable(['first_name', 'last_name']),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('city.name')
                    ->label('Ville')
                    ->description(fn (Professional $record) => $record->canton?->name),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscrit le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Professional $record) => route('filament.admin.resources.professionals.edit', $record)),

                Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approuver ce professionnel ?')
                    ->modalDescription('Le professionnel sera visible dans l\'annuaire.')
                    ->action(function (Professional $record) {
                        $record->update([
                            'validation_status' => 'approved',
                            'is_active' => true,
                        ]);
                        Notification::make()
                            ->title('Professionnel approuvé ✅')
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Professional $record) {
                        $record->update(['validation_status' => 'rejected']);
                        Notification::make()
                            ->title('Professionnel refusé')
                            ->warning()
                            ->send();
                    }),
            ])
            ->emptyStateHeading('Aucun professionnel en attente 🎉')
            ->emptyStateDescription('Tous les professionnels ont été validés.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
