<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Membres';

    protected static ?string $navigationGroup = 'Membres';

    protected static ?string $modelLabel = 'Membre';

    protected static ?string $pluralModelLabel = 'Membres';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations membre')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Utilisateur')
                        ->relationship('user', 'email')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('email')->email()->required(),
                            Forms\Components\TextInput::make('password')->password()->required(),
                        ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Prenom')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(100),
                    ]),
                    Forms\Components\TextInput::make('phone')
                        ->label('Telephone')
                        ->tel()
                        ->maxLength(20),
                ]),
            Forms\Components\Section::make('Adhesion')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\DatePicker::make('membership_start')
                            ->label('Debut adhesion')
                            ->required()
                            ->default(now()),
                        Forms\Components\DatePicker::make('membership_end')
                            ->label('Fin adhesion')
                            ->required()
                            ->default(now()->addYear()),
                    ]),
                    Forms\Components\Select::make('status')
                        ->label('Statut')
                        ->options([
                            'pending' => 'En attente',
                            'active' => 'Actif',
                            'expired' => 'Expire',
                            'cancelled' => 'Annule',
                        ])
                        ->required()
                        ->default('pending')
                        ->native(false),
                    Forms\Components\Textarea::make('admin_notes')
                        ->label('Notes internes')
                        ->rows(3),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telephone'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'active' => 'success',
                        'expired' => 'gray',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'En attente',
                        'active' => 'Actif',
                        'expired' => 'Expire',
                        'cancelled' => 'Annule',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('membership_end')
                    ->label('Fin adhesion')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(fn ($record) => $record->membership_end && $record->membership_end < now()->addDays(30) ? 'warning' : null),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscrit le')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'active' => 'Actif',
                        'expired' => 'Expire',
                        'cancelled' => 'Annule',
                    ]),
                Tables\Filters\Filter::make('expiring_soon')
                    ->label('Expire sous 30 jours')
                    ->query(fn ($query) => $query->expiringSoon()),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('activate')
                        ->label('Activer')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn ($record) => $record->status === 'pending')
                        ->requiresConfirmation()
                        ->action(fn ($record) => $record->update(['status' => 'active'])),
                    Tables\Actions\Action::make('renew')
                        ->label('Renouveler (+1 an)')
                        ->icon('heroicon-o-arrow-path')
                        ->color('info')
                        ->visible(fn ($record) => $record->status === 'active')
                        ->requiresConfirmation()
                        ->action(fn ($record) => $record->update([
                            'membership_end' => $record->membership_end->addYear(),
                        ])),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::pending()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
