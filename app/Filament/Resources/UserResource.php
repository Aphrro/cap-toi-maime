<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Utilisateurs';

    protected static ?string $navigationLabel = 'Utilisateurs';

    protected static ?string $modelLabel = 'Utilisateur';

    protected static ?string $pluralModelLabel = 'Utilisateurs';

    protected static ?int $navigationSort = 1;

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
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telephone')
                    ->searchable()
                    ->toggleable(),
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
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
                Tables\Columns\IconColumn::make('suspended_at')
                    ->label('Suspendu')
                    ->boolean()
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->getStateUsing(fn (User $record) => $record->suspended_at !== null),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscription')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user_type')
                    ->label('Type')
                    ->options([
                        'admin' => 'Administrateur',
                        'parent' => 'Parent',
                        'professional' => 'Professionnel',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif'),
                Tables\Filters\TernaryFilter::make('suspended')
                    ->label('Suspendu')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('suspended_at'),
                        false: fn (Builder $query) => $query->whereNull('suspended_at'),
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('suspend')
                    ->label('Suspendre')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->visible(fn (User $record) => !$record->isSuspended())
                    ->form([
                        Forms\Components\Textarea::make('suspension_reason')
                            ->label('Raison de la suspension')
                            ->required(),
                    ])
                    ->action(fn (User $record, array $data) => $record->suspend($data['suspension_reason'])),
                Tables\Actions\Action::make('unsuspend')
                    ->label('Reactiver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (User $record) => $record->isSuspended())
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->unsuspend()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
