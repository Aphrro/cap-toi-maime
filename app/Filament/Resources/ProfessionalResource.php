<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalResource\Pages;
use App\Models\Professional;
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
                                Forms\Components\FileUpload::make('profile_photo')
                                    ->label('Photo de profil')
                                    ->image()
                                    ->avatar()
                                    ->directory('professionals/photos')
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('1:1')
                                    ->imageResizeTargetWidth('400')
                                    ->imageResizeTargetHeight('400'),
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
                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\Select::make('canton_id')
                                        ->label('Canton')
                                        ->relationship('canton', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->live(),
                                    Forms\Components\Select::make('city_id')
                                        ->label('Ville')
                                        ->relationship('city', 'name', fn ($query, $get) =>
                                            $query->when($get('canton_id'), fn ($q, $v) => $q->where('canton_id', $v))
                                        )
                                        ->required()
                                        ->searchable()
                                        ->preload(),
                                ]),
                                Forms\Components\TextInput::make('address')
                                    ->label('Adresse')
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Tabs\Tab::make('Profession')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Forms\Components\Select::make('profession_id')
                                    ->label('Profession')
                                    ->relationship('profession', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('category_id')
                                    ->label('Categorie')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('specialties')
                                    ->label('Specialites')
                                    ->relationship('specialties', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                                Forms\Components\Select::make('reimbursementTypes')
                                    ->label('Types de remboursement')
                                    ->relationship('reimbursementTypes', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->helperText('LAMal, ASCA, RME, AI, etc.'),
                                Forms\Components\Select::make('languages')
                                    ->label('Langues')
                                    ->multiple()
                                    ->options(Professional::LANGUAGES),
                                Forms\Components\Section::make('Modes de consultation')
                                    ->schema([
                                        Forms\Components\Grid::make(3)->schema([
                                            Forms\Components\Toggle::make('mode_cabinet')
                                                ->label('En cabinet'),
                                            Forms\Components\Toggle::make('mode_visio')
                                                ->label('En visio'),
                                            Forms\Components\Toggle::make('mode_domicile')
                                                ->label('A domicile'),
                                        ]),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Presentation')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\RichEditor::make('who_am_i')
                                    ->label('Qui suis-je ?')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                                    ->helperText('Presentation personnelle du professionnel'),
                                Forms\Components\RichEditor::make('my_approach')
                                    ->label('Mon approche')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                                    ->helperText('Description de l\'approche therapeutique'),
                                Forms\Components\Textarea::make('bio')
                                    ->label('Biographie courte')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->helperText('Resume pour les listes'),
                                Forms\Components\Section::make('Video de presentation')
                                    ->description('Optionnel - Permet aux familles de decouvrir le professionnel')
                                    ->schema([
                                        Forms\Components\TextInput::make('video_url')
                                            ->label('URL de la video')
                                            ->url()
                                            ->helperText('Lien YouTube ou Vimeo')
                                            ->live(),
                                        Forms\Components\Select::make('video_type')
                                            ->label('Type de video')
                                            ->options([
                                                'youtube' => 'YouTube',
                                                'vimeo' => 'Vimeo',
                                            ])
                                            ->visible(fn ($get) => filled($get('video_url'))),
                                    ])
                                    ->collapsible()
                                    ->collapsed(),
                            ]),

                        Forms\Components\Tabs\Tab::make('FAQ')
                            ->icon('heroicon-o-question-mark-circle')
                            ->schema([
                                Forms\Components\Placeholder::make('faq_info')
                                    ->content('Questions frequentes personnalisees pour ce professionnel.')
                                    ->columnSpanFull(),
                                Forms\Components\Repeater::make('personal_faq')
                                    ->label('')
                                    ->schema([
                                        Forms\Components\TextInput::make('question')
                                            ->label('Question')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\RichEditor::make('answer')
                                            ->label('Reponse')
                                            ->toolbarButtons(['bold', 'italic', 'bulletList', 'link'])
                                            ->required(),
                                    ])
                                    ->defaultItems(0)
                                    ->addActionLabel('Ajouter une question')
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['question'] ?? 'Nouvelle question'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Statut')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Forms\Components\Section::make('Validation')
                                    ->schema([
                                        Forms\Components\Select::make('validation_status')
                                            ->label('Statut de validation')
                                            ->options([
                                                'pending' => 'En attente',
                                                'approved' => 'Approuve',
                                                'rejected' => 'Refuse',
                                            ])
                                            ->required()
                                            ->live(),
                                        Forms\Components\Textarea::make('rejection_reason')
                                            ->label('Raison du refus')
                                            ->visible(fn ($get) => $get('validation_status') === 'rejected')
                                            ->required(fn ($get) => $get('validation_status') === 'rejected')
                                            ->helperText('Cette raison sera communiquee au professionnel'),
                                    ]),
                                Forms\Components\Section::make('Disponibilite')
                                    ->description('Code couleur affiche sur la fiche')
                                    ->schema([
                                        Forms\Components\Radio::make('availability_status')
                                            ->label('')
                                            ->options([
                                                'available' => 'Disponible - Prend de nouveaux patients',
                                                'limited' => 'Limite - RDV sous 2-4 semaines',
                                                'waitlist' => 'Liste d\'attente',
                                            ])
                                            ->default('available'),
                                    ]),
                                Forms\Components\Section::make('Options')
                                    ->schema([
                                        Forms\Components\Grid::make(3)->schema([
                                            Forms\Components\Toggle::make('is_active')
                                                ->label('Actif')
                                                ->default(true),
                                            Forms\Components\Toggle::make('is_verified')
                                                ->label('Verifie'),
                                            Forms\Components\Toggle::make('is_featured')
                                                ->label('Mis en avant'),
                                        ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo')
                    ->circular()
                    ->label('')
                    ->defaultImageUrl(fn (Professional $record) =>
                        'https://ui-avatars.com/api/?name=' . urlencode($record->full_name ?? 'P') . '&background=random'
                    ),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable()
                    ->description(fn (Professional $record) => $record->email),
                Tables\Columns\TextColumn::make('profession.name')
                    ->label('Profession')
                    ->badge()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Ville')
                    ->description(fn (Professional $record) => $record->canton?->name)
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('availability_status')
                    ->label('Dispo')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'available' => 'Dispo',
                        'limited' => 'Limite',
                        'waitlist' => 'Attente',
                        default => '?',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'available' => 'success',
                        'limited' => 'warning',
                        'waitlist' => 'gray',
                        default => 'gray',
                    }),
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
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\SelectFilter::make('availability_status')
                    ->label('Disponibilite')
                    ->options([
                        'available' => 'Disponible',
                        'limited' => 'Limite',
                        'waitlist' => 'Liste d\'attente',
                    ]),
                Tables\Filters\SelectFilter::make('profession_id')
                    ->label('Profession')
                    ->relationship('profession', 'name'),
                Tables\Filters\SelectFilter::make('canton_id')
                    ->label('Canton')
                    ->relationship('canton', 'name'),
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
