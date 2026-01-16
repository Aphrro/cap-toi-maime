<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Contenu';
    protected static ?string $navigationLabel = 'Pages';
    protected static ?string $modelLabel = 'Page';
    protected static ?string $pluralModelLabel = 'Pages';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Page')
                    ->tabs([
                        // ONGLET 1: Informations générales
                        Forms\Components\Tabs\Tab::make('Général')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Titre de la page')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->alphaDash()
                                    ->disabled(fn (?Page $record) => $record?->isSystemPage())
                                    ->helperText(fn (?Page $record) => $record?->isSystemPage()
                                        ? 'Les pages système ne peuvent pas être renommées'
                                        : 'Exemple: ma-page → /ma-page'),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Page active')
                                    ->default(true)
                                    ->helperText('Désactiver pour masquer la page'),
                            ]),

                        // ONGLET 2: SEO
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\TextInput::make('meta.title')
                                    ->label('Meta Title')
                                    ->maxLength(60)
                                    ->helperText('60 caractères max (affiché dans Google)'),

                                Forms\Components\Textarea::make('meta.description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->rows(3)
                                    ->helperText('160 caractères max (affiché dans Google)'),
                            ]),

                        // ONGLET 3: Contenu (dynamique selon le slug)
                        Forms\Components\Tabs\Tab::make('Contenu')
                            ->icon('heroicon-o-pencil-square')
                            ->schema(fn (?Page $record) => static::getContentSchema($record?->slug)),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }

    /**
     * Retourne le formulaire de contenu adapté selon le slug de la page
     */
    protected static function getContentSchema(?string $slug): array
    {
        return match ($slug) {
            'accueil' => static::getHomepageSchema(),
            'a-propos' => static::getAboutPageSchema(),
            'contact' => static::getContactPageSchema(),
            'espace-pro' => static::getEspaceProSchema(),
            'conditions-utilisation',
            'politique-confidentialite',
            'charte-ethique' => static::getLegalPageSchema(),
            default => static::getDefaultPageSchema(),
        };
    }

    /**
     * Schema pour la page d'accueil
     */
    protected static function getHomepageSchema(): array
    {
        return [
            Forms\Components\Section::make('Section Hero (Bannière principale)')
                ->description('En haut de la page d\'accueil')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre principal (H1)')
                        ->required()
                        ->default('Trouvez des thérapeutes disponibles, proches de chez vous et formés au refus scolaire anxieux.'),

                    Forms\Components\Textarea::make('content.hero.subtitle')
                        ->label('Sous-titre')
                        ->rows(2)
                        ->default('Un annuaire de thérapeutes tops et dispos, qui connaissent vraiment la phobie scolaire, et que l\'équipe Cap Toi M\'aime connaît et recommande.'),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.hero.cta_text')
                            ->label('Texte du bouton')
                            ->default('Commencez maintenant'),

                        Forms\Components\TextInput::make('content.hero.cta_link')
                            ->label('Lien du bouton')
                            ->default('/questionnaire'),
                    ]),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Appel à l\'action final')
                ->description('En bas de la page d\'accueil')
                ->schema([
                    Forms\Components\TextInput::make('content.cta_final.title')
                        ->label('Titre')
                        ->default('Prêts à trouver le professionnel qui vous convient à vous et à votre enfant ?'),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.cta_final.button_text')
                            ->label('Texte du bouton')
                            ->default('Commencez maintenant'),

                        Forms\Components\TextInput::make('content.cta_final.button_link')
                            ->label('Lien du bouton')
                            ->default('/questionnaire'),
                    ]),
                ])
                ->collapsible(),
        ];
    }

    /**
     * Schema pour la page À Propos (selon feedbacks Marine)
     */
    protected static function getAboutPageSchema(): array
    {
        return [
            Forms\Components\Section::make('Introduction')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre principal')
                        ->default('Pourquoi cet annuaire est né ?'),

                    Forms\Components\RichEditor::make('content.intro.text')
                        ->label('Texte d\'introduction')
                        ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                        ->default('À force d\'échanger avec des familles, nous avons fait le constat suivant :

Trouver un professionnel de santé disponible rapidement pour accompagner son enfant peut devenir un véritable parcours du combattant.

Les délais d\'attente s\'allongent, les listes d\'attente se multiplient, et les parents se retrouvent souvent démunis face à l\'urgence de certaines situations.

Notre réponse : un annuaire associatif, indépendant et qualifié, pensé pour les parents de jeunes en phobie / refus scolaire anxieux (RSA) en Genève et Suisse romande.'),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Ce que c\'est (et ce que ce n\'est pas)')
                ->schema([
                    Forms\Components\Repeater::make('content.what_it_is.points')
                        ->label('Points clés')
                        ->simple(
                            Forms\Components\Textarea::make('point')
                                ->rows(2)
                        )
                        ->defaultItems(3)
                        ->default([
                            ['point' => 'Un outil réservé aux membres de Cap Toi M\'aime : un avantage concret de l\'adhésion, au service des familles.'],
                            ['point' => 'Une sélection de professionnels connus de l\'association, qui sont sensibilisés et/ou formés à la thématique du refus scolaire anxieux.'],
                            ['point' => 'Des fiches claires : spécialités, modalités de remboursement (LAMal/LCA/ASCA/RME).'],
                        ])
                        ->addActionLabel('Ajouter un point'),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Notre "plus" pour vous faire gagner du temps')
                ->schema([
                    Forms\Components\Repeater::make('content.our_plus.points')
                        ->label('Avantages')
                        ->simple(
                            Forms\Components\Textarea::make('point')
                                ->rows(2)
                        )
                        ->defaultItems(2)
                        ->default([
                            ['point' => 'Un repérage rapide de la disponibilité : code simple déclaré par les professionnels et mis à jour régulièrement (ex. Vert = prend de nouveaux patients / Orange = RDV sous 2–4 semaines / Gris = liste d\'attente).'],
                            ['point' => 'Quand c\'est possible, une présentation vidéo du praticien pour « mettre un visage sur un nom » et comprendre son approche avant de réserver.'],
                        ])
                        ->addActionLabel('Ajouter un avantage'),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Pourquoi nous l\'avons construit ainsi')
                ->schema([
                    Forms\Components\RichEditor::make('content.why_built.text')
                        ->label('Explication')
                        ->toolbarButtons(['bold', 'italic'])
                        ->default('Notre but est de réduire l\'errance thérapeutique, rassurer les parents et faciliter un premier pas utile. Nous avons aussi conçu l\'outil pour qu\'il reste léger à maintenir : informations standardisées, auto-déclarées par les pros, et revues périodiquement par l\'association.'),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Limites et rappel important')
                ->schema([
                    Forms\Components\RichEditor::make('content.disclaimer.text')
                        ->label('Avertissement')
                        ->toolbarButtons(['bold', 'italic'])
                        ->default('Cet annuaire est informatif : il ne remplace pas un avis médical et n\'engage pas une garantie de résultat clinique. Chaque famille reste libre de son choix ; l\'association met à disposition des informations fiables et actualisées pour faciliter l\'orientation.'),
                ])
                ->collapsible(),
        ];
    }

    /**
     * Schema pour la page Contact (selon feedbacks Marine)
     */
    protected static function getContactPageSchema(): array
    {
        return [
            Forms\Components\Section::make('En-tête')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre')
                        ->default('Contactez-nous'),

                    Forms\Components\Textarea::make('content.hero.subtitle')
                        ->label('Sous-titre')
                        ->rows(2)
                        ->default('Une question ? Nous sommes là pour vous aider.'),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Informations')
                ->description('Note : Seul le formulaire est affiché (pas de téléphone/email direct)')
                ->schema([
                    Forms\Components\Textarea::make('content.info.note')
                        ->label('Note explicative')
                        ->rows(2)
                        ->default('Nous centralisons toutes les demandes via le formulaire ci-dessous pour vous répondre au plus vite.'),

                    Forms\Components\TextInput::make('content.info.website_url')
                        ->label('Lien vers le site de l\'association')
                        ->url()
                        ->default('https://www.captoimaime.ch'),

                    Forms\Components\TextInput::make('content.info.website_text')
                        ->label('Texte du lien')
                        ->default('Visitez le site de l\'association Cap Toi M\'aime'),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Message de confirmation')
                ->schema([
                    Forms\Components\Textarea::make('content.form.success_message')
                        ->label('Message après envoi du formulaire')
                        ->rows(2)
                        ->default('Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.'),
                ])
                ->collapsible(),
        ];
    }

    /**
     * Schema pour la page Espace Pro
     */
    protected static function getEspaceProSchema(): array
    {
        return [
            Forms\Components\Section::make('En-tête')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre')
                        ->default('Espace Professionnel'),

                    Forms\Components\Textarea::make('content.hero.subtitle')
                        ->label('Sous-titre')
                        ->rows(2)
                        ->default('Rejoignez l\'annuaire Cap Toi M\'aime'),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Contenu principal')
                ->schema([
                    Forms\Components\RichEditor::make('content.main.text')
                        ->label('Texte explicatif')
                        ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link']),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Étapes d\'inscription')
                ->schema([
                    Forms\Components\Repeater::make('content.steps')
                        ->label('Étapes')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Titre de l\'étape')
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->label('Description')
                                ->rows(2),
                        ])
                        ->defaultItems(3)
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Nouvelle étape'),
                ])
                ->collapsible(),
        ];
    }

    /**
     * Schema pour les pages légales
     */
    protected static function getLegalPageSchema(): array
    {
        return [
            Forms\Components\Section::make('Contenu légal')
                ->schema([
                    Forms\Components\RichEditor::make('content.body')
                        ->label('Contenu de la page')
                        ->toolbarButtons([
                            'heading', 'bold', 'italic',
                            'bulletList', 'orderedList',
                            'link', 'blockquote'
                        ])
                        ->helperText('Vous pouvez utiliser les titres (H2, H3) pour structurer le contenu'),
                ]),
        ];
    }

    /**
     * Schema par défaut pour les nouvelles pages
     */
    protected static function getDefaultPageSchema(): array
    {
        return [
            Forms\Components\Section::make('Contenu')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre de la section'),

                    Forms\Components\RichEditor::make('content.body')
                        ->label('Contenu principal')
                        ->toolbarButtons([
                            'heading', 'bold', 'italic',
                            'bulletList', 'orderedList',
                            'link', 'blockquote'
                        ]),
                ]),
        ];
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
                    ->label('URL')
                    ->formatStateUsing(fn (string $state): string => "/$state")
                    ->color('gray')
                    ->copyable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifiée le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Pas de suppression en masse pour les pages
            ])
            ->defaultSort('title', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
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
