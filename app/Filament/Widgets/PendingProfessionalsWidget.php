<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProfessionalResource;
use App\Models\Professional;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingProfessionalsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Professionnels en attente de validation';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Professional::query()->pending()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->searchable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categorie')
                    ->badge(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Ville'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscription')
                    ->date('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Professional $record) => ProfessionalResource::getUrl('edit', ['record' => $record])),
                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (Professional $record) => $record->approve()),
            ])
            ->paginated([5]);
    }
}
