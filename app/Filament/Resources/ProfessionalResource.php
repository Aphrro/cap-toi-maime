<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalResource\Pages;
use App\Models\Professional;
use App\Services\ProfileCompletenessService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfessionalResource extends Resource
{
    protected static ?string $model = Professional::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Annuaire';

    protected static ?string $navigationLabel = 'Professionnels';

    protected static ?string $modelLabel = 'Professionnel';

    protected static ?string $pluralModelLabel = 'Professionnels';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::pending()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Professionnel')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Identite')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->label('Titre')
                                        ->maxLength(50)
                                        ->placeholder('Dr., Prof.'),
                                    Forms\Components\TextInput::make('first_name')
                                        ->label('Prenom')
                                        ->required()
                                        ->maxLength(100),
                                    Forms\Components\TextInput::make('last_name')
                                        ->label('Nom')
                                        ->required()
                                        ->maxLength(100),
                                    Forms\Components\TextInput::make('email')
                                        ->label('Email')
                                        ->email()
                                        ->required()
                                        ->unique(ignoreRecord: true),
                                    Forms\Components\TextInput::make('phone')
                                        ->label('Telephone')
                                        ->tel(),
                                    Forms\Components\TextInput::make('website')
                                        ->label('Site web')
                                        ->url(),
                                ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Localisation')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Forms\Components\TextInput::make('address')
                                    ->label('Adresse')
                                    ->maxLength(255),
                                Forms\Components\Select::make('city_id')
                                    ->label('Ville')
                                    ->relationship('city', 'name')
                                    ->searchable()
                                    ->preload(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Profession')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->label('Categorie')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('specialtiesRelation')
                                    ->label('Specialites')
                                    ->relationship('specialtiesRelation', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                                Forms\Components\Select::make('languages')
                                    ->label('Langues')
                                    ->multiple()
                                    ->options(Professional::LANGUAGES),
                                Forms\Components\Select::make('consultation_type')
                                    ->label('Type de consultation')
                                    ->options(Professional::CONSULTATION_TYPES),
                            ]),

                        Forms\Components\Tabs\Tab::make('Presentation')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Textarea::make('bio')
                                    ->label('Biographie')
                                    ->rows(5)
                                    ->maxLength(2000),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                                    ->label('Photo de profil')
                                    ->collection('avatar')
                                    ->image()
                                    ->imageEditor(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Statut')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Forms\Components\Grid::make(3)->schema([
                                    Forms\Components\Select::make('validation_status')
                                        ->label('Statut de validation')
                                        ->options([
                                            'pending' => 'En attente',
                                            'approved' => 'Approuve',
                                            'rejected' => 'Refuse',
                                        ])
                                        ->required()
                                        ->live(),
                                    Forms\Components\Toggle::make('is_active')
                                        ->label('Actif')
                                        ->default(true),
                                    Forms\Components\Toggle::make('is_verified')
                                        ->label('Verifie'),
                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Mis en avant'),
                                ]),
                                Forms\Components\Textarea::make('rejection_reason')
                                    ->label('Raison du refus')
                                    ->visible(fn ($get) => $get('validation_status') === 'rejected')
                                    ->required(fn ($get) => $get('validation_status') === 'rejected'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->circular()
                    ->label(''),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categorie')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Ville')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('validation_status')
                    ->label('Validation')
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
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscription')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('validation_status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'approved' => 'Approuve',
                        'rejected' => 'Refuse',
                    ]),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categorie')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('approve')
                        ->label('Approuver')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (Professional $record) => $record->validation_status === 'pending')
                        ->requiresConfirmation()
                        ->modalHeading('Approuver ce professionnel ?')
                        ->modalDescription('Le professionnel sera visible dans l\'annuaire.')
                        ->action(fn (Professional $record) => $record->approve()),
                    Tables\Actions\Action::make('reject')
                        ->label('Refuser')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn (Professional $record) => $record->validation_status === 'pending')
                        ->form([
                            Forms\Components\Textarea::make('rejection_reason')
                                ->label('Raison du refus')
                                ->required(),
                        ])
                        ->action(fn (Professional $record, array $data) => $record->reject($data['rejection_reason'])),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListProfessionals::route('/'),
            'create' => Pages\CreateProfessional::route('/create'),
            'edit' => Pages\EditProfessional::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
