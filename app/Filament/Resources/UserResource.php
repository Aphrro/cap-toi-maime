<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Paramètres';

    protected static ?string $navigationLabel = 'Utilisateurs';

    protected static ?string $modelLabel = 'Utilisateur';

    protected static ?string $pluralModelLabel = 'Utilisateurs';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('member_status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telephone')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\Select::make('user_type')
                            ->label('Type')
                            ->options([
                                'admin' => 'Administrateur',
                                'parent' => 'Parent',
                                'professional' => 'Professionnel',
                            ])
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Statut membre')
                    ->schema([
                        Forms\Components\Select::make('member_status')
                            ->label('Statut adhesion')
                            ->options([
                                'pending' => 'En attente',
                                'approved' => 'Approuve',
                                'rejected' => 'Refuse',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('association_member_id')
                            ->label('ID membre association')
                            ->maxLength(50),
                        Forms\Components\DateTimePicker::make('member_approved_at')
                            ->label('Approuve le')
                            ->disabled(),
                        Forms\Components\Textarea::make('member_rejection_reason')
                            ->label('Raison du refus')
                            ->rows(2)
                            ->visible(fn ($get) => $get('member_status') === 'rejected'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Suspension')
                    ->schema([
                        Forms\Components\DateTimePicker::make('suspended_at')
                            ->label('Suspendu le')
                            ->disabled(),
                        Forms\Components\Textarea::make('suspension_reason')
                            ->label('Raison de la suspension')
                            ->rows(2),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('member_status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'En attente',
                        'approved' => 'Approuve',
                        'rejected' => 'Refuse',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('user_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'professional' => 'info',
                        'parent' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin' => 'Admin',
                        'professional' => 'Pro',
                        'parent' => 'Parent',
                        default => $state,
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('association_member_id')
                    ->label('ID Membre')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscription')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('member_status')
                    ->label('Statut membre')
                    ->options([
                        'pending' => 'En attente',
                        'approved' => 'Approuve',
                        'rejected' => 'Refuse',
                    ]),
                Tables\Filters\SelectFilter::make('user_type')
                    ->label('Type')
                    ->options([
                        'admin' => 'Administrateur',
                        'parent' => 'Parent',
                        'professional' => 'Professionnel',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif'),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (User $record): bool => $record->member_status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Approuver ce membre ?')
                    ->modalDescription('Le membre recevra un email de confirmation et aura acces a l\'annuaire.')
                    ->action(function (User $record) {
                        $record->approveMembership();
                        Notification::make()
                            ->title('Membre approuve')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (User $record): bool => $record->member_status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('reason')
                            ->label('Raison du refus')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (User $record, array $data) {
                        $record->rejectMembership($data['reason']);
                        Notification::make()
                            ->title('Membre refuse')
                            ->warning()
                            ->send();
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('suspend')
                    ->label('Suspendre')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->visible(fn (User $record) => !$record->isSuspended() && $record->member_status === 'approved')
                    ->form([
                        Forms\Components\Textarea::make('suspension_reason')
                            ->label('Raison de la suspension')
                            ->required(),
                    ])
                    ->action(fn (User $record, array $data) => $record->suspend($data['suspension_reason'])),
                Tables\Actions\Action::make('unsuspend')
                    ->label('Reactiver')
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->visible(fn (User $record) => $record->isSuspended())
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->unsuspend()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('approve_bulk')
                        ->label('Approuver la selection')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $count = 0;
                            foreach ($records as $record) {
                                if ($record->member_status === 'pending') {
                                    $record->approveMembership();
                                    $count++;
                                }
                            }
                            Notification::make()
                                ->title("$count membre(s) approuve(s)")
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
