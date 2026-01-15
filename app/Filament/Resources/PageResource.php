<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Pages';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $modelLabel = 'Page';

    protected static ?string $pluralModelLabel = 'Pages';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            // === INFORMATIONS GÉNÉRALES ===
            Forms\Components\Section::make('Informations générales')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Titre de la page')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set, $record) =>
                            $record === null ? $set('slug', Str::slug($state)) : null
                        ),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->helperText('URL de la page: /slug'),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Page active')
                        ->default(true),
                ])->columns(3),

            // === SEO ===
            Forms\Components\Section::make('SEO')
                ->schema([
                    Forms\Components\TextInput::make('meta.title')
                        ->label('Meta Title')
                        ->maxLength(70)
                        ->helperText('Titre affiché dans Google (max 70 caractères)'),
                    Forms\Components\Textarea::make('meta.description')
                        ->label('Meta Description')
                        ->rows(2)
                        ->maxLength(160)
                        ->helperText('Description affichée dans Google (max 160 caractères)'),
                    Forms\Components\TextInput::make('meta.keywords')
                        ->label('Keywords')
                        ->helperText('Mots-clés séparés par des virgules'),
                ])->columns(1)->collapsed(),

            // === CONTENU DYNAMIQUE ===
            Forms\Components\Tabs::make('Contenu de la page')
                ->tabs([
                    // === TAB HERO ===
                    Forms\Components\Tabs\Tab::make('Hero')
                        ->icon('heroicon-o-sparkles')
                        ->schema([
                            Forms\Components\TextInput::make('content.hero.title')
                                ->label('Titre principal')
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('content.hero.subtitle')
                                ->label('Sous-titre')
                                ->rows(3)
                                ->columnSpanFull(),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.hero.button_text')
                                    ->label('Texte du bouton'),
                                Forms\Components\TextInput::make('content.hero.button_url')
                                    ->label('URL du bouton'),
                            ]),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\ColorPicker::make('content.hero.background_color')
                                    ->label('Couleur de fond'),
                                Forms\Components\ColorPicker::make('content.hero.text_color')
                                    ->label('Couleur du texte'),
                            ]),
                            Forms\Components\FileUpload::make('content.hero.background_image')
                                ->label('Image de fond')
                                ->image()
                                ->directory('pages/hero'),
                            Forms\Components\FileUpload::make('content.hero.image')
                                ->label('Image illustration')
                                ->image()
                                ->directory('pages/hero'),
                        ]),

                    // === TAB RECHERCHE (pour accueil) ===
                    Forms\Components\Tabs\Tab::make('Recherche')
                        ->icon('heroicon-o-magnifying-glass')
                        ->schema([
                            Forms\Components\TextInput::make('content.hero.search_placeholder')
                                ->label('Placeholder du champ recherche'),
                            Forms\Components\TextInput::make('content.hero.search_button_text')
                                ->label('Texte bouton recherche'),
                            Forms\Components\TextInput::make('content.hero.or_text')
                                ->label('Texte "ou"'),
                            Forms\Components\TextInput::make('content.hero.questionnaire_text')
                                ->label('Texte bouton questionnaire'),
                            Forms\Components\TextInput::make('content.hero.questionnaire_url')
                                ->label('URL questionnaire'),
                        ]),

                    // === TAB BADGES (pour espace pro) ===
                    Forms\Components\Tabs\Tab::make('Badges')
                        ->icon('heroicon-o-check-badge')
                        ->schema([
                            Forms\Components\Repeater::make('content.hero.badges')
                                ->label('Badges')
                                ->schema([
                                    Forms\Components\TextInput::make('icon')
                                        ->label('Icône')
                                        ->helperText('check, users, shield-check, etc.'),
                                    Forms\Components\TextInput::make('text')
                                        ->label('Texte'),
                                ])
                                ->columns(2)
                                ->collapsible()
                                ->defaultItems(0),
                        ]),

                    // === TAB SECTIONS ===
                    Forms\Components\Tabs\Tab::make('Sections')
                        ->icon('heroicon-o-squares-2x2')
                        ->schema([
                            // Section Professions
                            Forms\Components\Fieldset::make('Section Professions')
                                ->schema([
                                    Forms\Components\Toggle::make('content.professions_section.show')
                                        ->label('Afficher'),
                                    Forms\Components\TextInput::make('content.professions_section.title')
                                        ->label('Titre'),
                                    Forms\Components\ColorPicker::make('content.professions_section.title_color')
                                        ->label('Couleur titre'),
                                ])->columns(3),

                            // Section Spécialités
                            Forms\Components\Fieldset::make('Section Spécialités')
                                ->schema([
                                    Forms\Components\Toggle::make('content.specialties_section.show')
                                        ->label('Afficher'),
                                    Forms\Components\TextInput::make('content.specialties_section.title')
                                        ->label('Titre'),
                                    Forms\Components\ColorPicker::make('content.specialties_section.title_color')
                                        ->label('Couleur titre'),
                                ])->columns(3),

                            // Section Stats
                            Forms\Components\Fieldset::make('Section Statistiques')
                                ->schema([
                                    Forms\Components\Toggle::make('content.stats_section.show')
                                        ->label('Afficher'),
                                    Forms\Components\TextInput::make('content.stats_section.title')
                                        ->label('Titre'),
                                    Forms\Components\Repeater::make('content.stats_section.stats')
                                        ->label('Statistiques')
                                        ->schema([
                                            Forms\Components\TextInput::make('value')
                                                ->label('Valeur')
                                                ->helperText('Nombre ou "dynamic:professionals_count"'),
                                            Forms\Components\TextInput::make('label')
                                                ->label('Label'),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(0),
                                ]),
                        ]),

                    // === TAB FEATURES (pour espace pro) ===
                    Forms\Components\Tabs\Tab::make('Avantages')
                        ->icon('heroicon-o-star')
                        ->schema([
                            Forms\Components\Toggle::make('content.features_section.show')
                                ->label('Afficher cette section'),
                            Forms\Components\TextInput::make('content.features_section.title')
                                ->label('Titre de la section')
                                ->columnSpanFull(),
                            Forms\Components\Repeater::make('content.features_section.features')
                                ->label('Liste des avantages')
                                ->schema([
                                    Forms\Components\TextInput::make('icon')
                                        ->label('Icône Heroicon')
                                        ->helperText('heroicon-o-shield-check'),
                                    Forms\Components\TextInput::make('title')
                                        ->label('Titre'),
                                    Forms\Components\Textarea::make('description')
                                        ->label('Description')
                                        ->rows(2),
                                ])
                                ->columns(1)
                                ->collapsible()
                                ->defaultItems(0),
                        ]),

                    // === TAB ÉTAPES ===
                    Forms\Components\Tabs\Tab::make('Étapes')
                        ->icon('heroicon-o-list-bullet')
                        ->schema([
                            Forms\Components\Toggle::make('content.how_it_works_section.show')
                                ->label('Afficher cette section'),
                            Forms\Components\TextInput::make('content.how_it_works_section.title')
                                ->label('Titre de la section')
                                ->columnSpanFull(),
                            Forms\Components\Repeater::make('content.how_it_works_section.steps')
                                ->label('Étapes')
                                ->schema([
                                    Forms\Components\TextInput::make('number')
                                        ->label('Numéro'),
                                    Forms\Components\TextInput::make('icon')
                                        ->label('Icône'),
                                    Forms\Components\TextInput::make('title')
                                        ->label('Titre'),
                                    Forms\Components\TextInput::make('description')
                                        ->label('Description'),
                                    Forms\Components\TextInput::make('duration')
                                        ->label('Durée'),
                                ])
                                ->columns(5)
                                ->collapsible()
                                ->defaultItems(0),
                        ]),

                    // === TAB CTA ===
                    Forms\Components\Tabs\Tab::make('Call to Action')
                        ->icon('heroicon-o-cursor-arrow-rays')
                        ->schema([
                            Forms\Components\Toggle::make('content.cta_section.show')
                                ->label('Afficher cette section'),
                            Forms\Components\TextInput::make('content.cta_section.title')
                                ->label('Titre')
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('content.cta_section.subtitle')
                                ->label('Sous-titre')
                                ->columnSpanFull(),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.cta_section.button_text')
                                    ->label('Texte du bouton'),
                                Forms\Components\TextInput::make('content.cta_section.button_url')
                                    ->label('URL du bouton'),
                            ]),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\ColorPicker::make('content.cta_section.button_color')
                                    ->label('Couleur du bouton'),
                                Forms\Components\ColorPicker::make('content.cta_section.background_color')
                                    ->label('Couleur de fond'),
                            ]),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.cta_section.contact_text')
                                    ->label('Texte contact'),
                                Forms\Components\TextInput::make('content.cta_section.contact_email')
                                    ->label('Email contact'),
                            ]),
                        ]),

                    // === TAB ABOUT ===
                    Forms\Components\Tabs\Tab::make('À propos')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Forms\Components\Toggle::make('content.about_section.show')
                                ->label('Afficher cette section'),
                            Forms\Components\TextInput::make('content.about_section.title')
                                ->label('Titre')
                                ->columnSpanFull(),
                            Forms\Components\RichEditor::make('content.about_section.content')
                                ->label('Contenu')
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('content.about_section.image')
                                ->label('Image')
                                ->image()
                                ->directory('pages/about'),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.about_section.link_text')
                                    ->label('Texte du lien'),
                                Forms\Components\TextInput::make('content.about_section.link_url')
                                    ->label('URL du lien'),
                            ]),
                        ]),

                    // === TAB FAQ ===
                    Forms\Components\Tabs\Tab::make('FAQ')
                        ->icon('heroicon-o-question-mark-circle')
                        ->schema([
                            Forms\Components\Toggle::make('content.faq_section.show')
                                ->label('Afficher la section FAQ'),
                            Forms\Components\TextInput::make('content.faq_section.title')
                                ->label('Titre de la section'),
                            Forms\Components\Select::make('content.faq_section.category_filter')
                                ->label('Filtrer par catégorie')
                                ->options([
                                    'all' => 'Toutes les FAQ',
                                    'parents' => 'FAQ Parents',
                                    'pros' => 'FAQ Professionnels',
                                    'general' => 'FAQ Générales',
                                ])
                                ->default('all'),
                        ]),

                    // === TAB CONTENU LIBRE ===
                    Forms\Components\Tabs\Tab::make('Contenu')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Forms\Components\TextInput::make('content.content_section.title')
                                ->label('Titre de la section'),
                            Forms\Components\RichEditor::make('content.content_section.content')
                                ->label('Contenu principal')
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('content.content_section.image')
                                ->label('Image')
                                ->image()
                                ->directory('pages/content'),
                        ]),

                    // === TAB FORMULAIRE ===
                    Forms\Components\Tabs\Tab::make('Formulaire')
                        ->icon('heroicon-o-pencil-square')
                        ->schema([
                            Forms\Components\TextInput::make('content.form_section.title')
                                ->label('Titre du formulaire'),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.form_section.name_label')
                                    ->label('Label nom'),
                                Forms\Components\TextInput::make('content.form_section.name_placeholder')
                                    ->label('Placeholder nom'),
                            ]),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.form_section.email_label')
                                    ->label('Label email'),
                                Forms\Components\TextInput::make('content.form_section.email_placeholder')
                                    ->label('Placeholder email'),
                            ]),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.form_section.subject_label')
                                    ->label('Label sujet'),
                                Forms\Components\TextInput::make('content.form_section.subject_placeholder')
                                    ->label('Placeholder sujet'),
                            ]),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.form_section.message_label')
                                    ->label('Label message'),
                                Forms\Components\TextInput::make('content.form_section.message_placeholder')
                                    ->label('Placeholder message'),
                            ]),
                            Forms\Components\TextInput::make('content.form_section.button_text')
                                ->label('Texte du bouton'),
                            Forms\Components\TextInput::make('content.form_section.success_message')
                                ->label('Message de succès')
                                ->columnSpanFull(),
                        ]),

                    // === TAB INFO CONTACT ===
                    Forms\Components\Tabs\Tab::make('Infos Contact')
                        ->icon('heroicon-o-envelope')
                        ->schema([
                            Forms\Components\Toggle::make('content.info_section.show')
                                ->label('Afficher les infos de contact'),
                            Forms\Components\TextInput::make('content.info_section.email')
                                ->label('Email'),
                            Forms\Components\TextInput::make('content.info_section.location')
                                ->label('Localisation'),
                            Forms\Components\TextInput::make('content.info_section.website')
                                ->label('Site web'),
                        ]),
                ])
                ->columnSpanFull()
                ->persistTabInQueryString(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->badge()
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('Slug copié'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('title')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => '/' . $record->slug)
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
