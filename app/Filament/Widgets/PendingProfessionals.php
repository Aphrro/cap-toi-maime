<?php

namespace App\Filament\Widgets;

use App\Models\Professional;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingProfessionals extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Professionnels en attente de validation';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Professional::where('validation_status', 'pending')->latest()->limit(5))
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo')
                    ->circular()
                    ->label('')
                    ->size(40),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->getStateUsing(fn ($record) => $record->first_name . ' ' . $record->last_name),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Ville'),
                Tables\Columns\TextColumn::make('canton.name')
                    ->label('Canton')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscrit le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => route('filament.admin.resources.professionals.edit', $record)),
                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update([
                        'validation_status' => 'approved',
                        'is_active' => true,
                    ])),
                Tables\Actions\Action::make('reject')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update(['validation_status' => 'rejected'])),
            ])
            ->paginated(false)
            ->emptyStateHeading('Aucun professionnel en attente')
            ->emptyStateDescription('Tous les professionnels ont été validés.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
