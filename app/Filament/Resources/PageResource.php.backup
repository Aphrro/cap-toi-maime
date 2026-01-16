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
            // === INFORMATIONS GENERALES ===
            Forms\Components\Section::make('Informations generales')
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
                        ->helperText('Titre affiche dans Google (max 70 caracteres)'),
                    Forms\Components\Textarea::make('meta.description')
                        ->label('Meta Description')
                        ->rows(2)
                        ->maxLength(160)
                        ->helperText('Description affichee dans Google (max 160 caracteres)'),
                    Forms\Components\TextInput::make('meta.keywords')
                        ->label('Keywords')
                        ->helperText('Mots-cles separes par des virgules'),
                ])->columns(1)->collapsed(),

            // === CONTENU DYNAMIQUE PAR PAGE ===
            Forms\Components\Tabs::make('Contenu de la page')
                ->tabs(fn ($record) => self::getTabsForPage($record))
                ->columnSpanFull()
                ->persistTabInQueryString(),
        ]);
    }

    /**
     * Retourne les tabs specifiques selon le slug de la page
     */
    protected static function getTabsForPage(?Page $record): array
    {
        $slug = $record?->slug ?? '';

        return match ($slug) {
            'accueil' => self::getAccueilTabs(),
            'espace-pro', 'pro' => self::getEspaceProTabs(),
            'a-propos' => self::getAProposTabs(),
            'contact' => self::getContactTabs(),
            'faq' => self::getFaqTabs(),
            'temoignages' => self::getTemoignagesTabs(),
            default => self::getDefaultTabs(),
        };
    }

    // =========================================================================
    // PAGE ACCUEIL - 5 sections
    // =========================================================================
    protected static function getAccueilTabs(): array
    {
        return [
            // TAB 1 : HERO
            Forms\Components\Tabs\Tab::make('Hero')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\Section::make('Contenu principal')
                        ->description('Section hero avec fond burgundy')
                        ->schema([
                            Forms\Components\TextInput::make('content.hero.title')
                                ->label('Titre')
                                ->placeholder('Pourquoi cet annuaire ?')
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('content.hero.paragraph')
                                ->label('Paragraphe')
                                ->rows(3)
                                ->placeholder('A force d\'echanger avec des familles...')
                                ->columnSpanFull(),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.hero.button_text')
                                    ->label('Texte du bouton')
                                    ->placeholder('CONSULTER L\'ANNUAIRE'),
                                Forms\Components\TextInput::make('content.hero.button_url')
                                    ->label('URL du bouton')
                                    ->placeholder('/annuaire'),
                            ]),
                        ]),
                    Forms\Components\Section::make('Apparence')
                        ->collapsed()
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\ColorPicker::make('content.hero.background_color')
                                    ->label('Couleur de fond')
                                    ->default('#7A1F2E'),
                                Forms\Components\ColorPicker::make('content.hero.text_color')
                                    ->label('Couleur du texte')
                                    ->default('#FFFFFF'),
                            ]),
                            Forms\Components\FileUpload::make('content.hero.background_image')
                                ->label('Image de fond (optionnelle)')
                                ->image()
                                ->directory('pages/hero'),
                        ]),
                    Forms\Components\Section::make('Points cles (colonne droite)')
                        ->description('Les 3 highlights affiches a droite du hero')
                        ->schema([
                            Forms\Components\Repeater::make('content.hero.highlights')
                                ->label('')
                                ->schema([
                                    Forms\Components\TextInput::make('icon')
                                        ->label('Icone')
                                        ->placeholder('heroicon-o-users'),
                                    Forms\Components\TextInput::make('title')
                                        ->label('Titre')
                                        ->required(),
                                    Forms\Components\TextInput::make('description')
                                        ->label('Description'),
                                ])
                                ->columns(3)
                                ->defaultItems(3)
                                ->reorderable()
                                ->collapsible(),
                        ]),
                ]),

            // TAB 2 : NOTRE REPONSE
            Forms\Components\Tabs\Tab::make('Notre reponse')
                ->icon('heroicon-o-light-bulb')
                ->schema([
                    Forms\Components\Toggle::make('content.reponse.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\Section::make('Contenu')
                        ->schema([
                            Forms\Components\TextInput::make('content.reponse.title')
                                ->label('Titre de la section')
                                ->placeholder('Notre reponse')
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('content.reponse.paragraph')
                                ->label('Paragraphe')
                                ->rows(3)
                                ->placeholder('Un annuaire associatif, independant...')
                                ->columnSpanFull(),
                            Forms\Components\ColorPicker::make('content.reponse.background_color')
                                ->label('Couleur de fond')
                                ->default('#FFFFFF'),
                        ]),
                    Forms\Components\Section::make('Cards')
                        ->description('Les 3 cartes avec icones')
                        ->schema([
                            Forms\Components\Repeater::make('content.reponse.cards')
                                ->label('')
                                ->schema([
                                    Forms\Components\TextInput::make('icon')
                                        ->label('Icone')
                                        ->placeholder('heroicon-o-check'),
                                    Forms\Components\TextInput::make('title')
                                        ->label('Titre')
                                        ->required(),
                                    Forms\Components\Textarea::make('description')
                                        ->label('Description')
                                        ->rows(2),
                                ])
                                ->columns(3)
                                ->defaultItems(3)
                                ->reorderable()
                                ->collapsible(),
                        ]),
                ]),

            // TAB 3 : NOTRE PLUS
            Forms\Components\Tabs\Tab::make('Notre plus')
                ->icon('heroicon-o-clock')
                ->schema([
                    Forms\Components\Toggle::make('content.plus.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\Section::make('Contenu')
                        ->schema([
                            Forms\Components\TextInput::make('content.plus.title')
                                ->label('Titre de la section')
                                ->placeholder('Notre "plus" pour vous faire gagner du temps')
                                ->columnSpanFull(),
                            Forms\Components\ColorPicker::make('content.plus.background_color')
                                ->label('Couleur de fond')
                                ->default('#F9FAFB'),
                        ]),
                    Forms\Components\Section::make('Features')
                        ->description('Les 2 fonctionnalites mises en avant')
                        ->schema([
                            Forms\Components\Repeater::make('content.plus.features')
                                ->label('')
                                ->schema([
                                    Forms\Components\TextInput::make('icon')
                                        ->label('Icone')
                                        ->placeholder('heroicon-o-clock'),
                                    Forms\Components\TextInput::make('title')
                                        ->label('Titre')
                                        ->required(),
                                    Forms\Components\Textarea::make('description')
                                        ->label('Description')
                                        ->rows(3),
                                    Forms\Components\Toggle::make('show_availability_badges')
                                        ->label('Afficher les badges de disponibilite'),
                                ])
                                ->columns(2)
                                ->defaultItems(2)
                                ->reorderable()
                                ->collapsible(),
                        ]),
                ]),

            // TAB 4 : POURQUOI
            Forms\Components\Tabs\Tab::make('Pourquoi')
                ->icon('heroicon-o-question-mark-circle')
                ->schema([
                    Forms\Components\Toggle::make('content.pourquoi.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\Section::make('Contenu')
                        ->schema([
                            Forms\Components\TextInput::make('content.pourquoi.title')
                                ->label('Titre de la section')
                                ->placeholder('Pourquoi nous l\'avons construit ainsi ?')
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('content.pourquoi.paragraph')
                                ->label('Paragraphe')
                                ->rows(3)
                                ->placeholder('Notre but est de reduire l\'errance...')
                                ->columnSpanFull(),
                            Forms\Components\ColorPicker::make('content.pourquoi.background_color')
                                ->label('Couleur de fond')
                                ->default('#FFFFFF'),
                        ]),
                    Forms\Components\Section::make('Encadre alerte')
                        ->description('L\'encadre jaune avec l\'avertissement')
                        ->schema([
                            Forms\Components\Toggle::make('content.pourquoi.alert.show')
                                ->label('Afficher l\'encadre')
                                ->default(true),
                            Forms\Components\TextInput::make('content.pourquoi.alert.icon')
                                ->label('Icone')
                                ->placeholder('heroicon-o-exclamation-triangle'),
                            Forms\Components\TextInput::make('content.pourquoi.alert.title')
                                ->label('Titre de l\'alerte')
                                ->placeholder('Limites et rappel important'),
                            Forms\Components\Textarea::make('content.pourquoi.alert.text')
                                ->label('Texte de l\'alerte')
                                ->rows(4)
                                ->columnSpanFull(),
                            Forms\Components\ColorPicker::make('content.pourquoi.alert.background_color')
                                ->label('Couleur de fond')
                                ->default('#FEF3C7'),
                        ]),
                ]),

            // TAB 5 : CTA FINAL
            Forms\Components\Tabs\Tab::make('CTA Final')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->schema([
                    Forms\Components\Toggle::make('content.cta.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\Section::make('Contenu')
                        ->schema([
                            Forms\Components\TextInput::make('content.cta.title')
                                ->label('Titre')
                                ->placeholder('Pret a trouver le bon professionnel ?')
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('content.cta.subtitle')
                                ->label('Sous-titre')
                                ->placeholder('Consultez notre annuaire de professionnels...')
                                ->columnSpanFull(),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.cta.button_text')
                                    ->label('Texte du bouton')
                                    ->placeholder('CONSULTER L\'ANNUAIRE'),
                                Forms\Components\TextInput::make('content.cta.button_url')
                                    ->label('URL du bouton')
                                    ->placeholder('/annuaire'),
                            ]),
                        ]),
                    Forms\Components\Section::make('Apparence')
                        ->collapsed()
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\ColorPicker::make('content.cta.background_color')
                                    ->label('Couleur de fond')
                                    ->default('#7A1F2E'),
                                Forms\Components\ColorPicker::make('content.cta.text_color')
                                    ->label('Couleur du texte')
                                    ->default('#FFFFFF'),
                            ]),
                        ]),
                ]),
        ];
    }

    // =========================================================================
    // PAGE ESPACE PRO
    // =========================================================================
    protected static function getEspaceProTabs(): array
    {
        return [
            // TAB 1 : HERO
            Forms\Components\Tabs\Tab::make('Hero')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\Section::make('Contenu principal')
                        ->schema([
                            Forms\Components\TextInput::make('content.hero.title')
                                ->label('Titre')
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
                        ]),
                    Forms\Components\Section::make('Apparence')
                        ->collapsed()
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\ColorPicker::make('content.hero.background_color')
                                    ->label('Couleur de fond'),
                                Forms\Components\ColorPicker::make('content.hero.text_color')
                                    ->label('Couleur du texte'),
                            ]),
                        ]),
                ]),

            // TAB 2 : STATS
            Forms\Components\Tabs\Tab::make('Statistiques')
                ->icon('heroicon-o-chart-bar')
                ->schema([
                    Forms\Components\Toggle::make('content.stats.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\Repeater::make('content.stats.items')
                        ->label('Statistiques')
                        ->schema([
                            Forms\Components\TextInput::make('value')
                                ->label('Valeur')
                                ->placeholder('50+'),
                            Forms\Components\TextInput::make('label')
                                ->label('Label')
                                ->placeholder('Familles accompagnees'),
                        ])
                        ->columns(2)
                        ->defaultItems(4)
                        ->collapsible(),
                ]),

            // TAB 3 : AVANTAGES
            Forms\Components\Tabs\Tab::make('Avantages')
                ->icon('heroicon-o-star')
                ->schema([
                    Forms\Components\Toggle::make('content.avantages.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.avantages.title')
                        ->label('Titre de la section')
                        ->columnSpanFull(),
                    Forms\Components\Repeater::make('content.avantages.items')
                        ->label('Liste des avantages')
                        ->schema([
                            Forms\Components\TextInput::make('icon')
                                ->label('Icone'),
                            Forms\Components\TextInput::make('title')
                                ->label('Titre'),
                            Forms\Components\Textarea::make('description')
                                ->label('Description')
                                ->rows(2),
                        ])
                        ->columns(3)
                        ->collapsible(),
                ]),

            // TAB 4 : ETAPES
            Forms\Components\Tabs\Tab::make('Etapes')
                ->icon('heroicon-o-list-bullet')
                ->schema([
                    Forms\Components\Toggle::make('content.etapes.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.etapes.title')
                        ->label('Titre de la section')
                        ->placeholder('Comment ca marche ?')
                        ->columnSpanFull(),
                    Forms\Components\Repeater::make('content.etapes.items')
                        ->label('Liste des etapes')
                        ->schema([
                            Forms\Components\TextInput::make('number')
                                ->label('Numero'),
                            Forms\Components\TextInput::make('title')
                                ->label('Titre'),
                            Forms\Components\Textarea::make('description')
                                ->label('Description')
                                ->rows(2),
                        ])
                        ->columns(3)
                        ->collapsible(),
                ]),

            // TAB 5 : A PROPOS ASSOCIATION
            Forms\Components\Tabs\Tab::make('A propos')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    Forms\Components\Toggle::make('content.about.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.about.title')
                        ->label('Titre')
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('content.about.content')
                        ->label('Contenu')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('content.about.image')
                        ->label('Image')
                        ->image()
                        ->directory('pages/about'),
                ]),

            // TAB 6 : FAQ
            Forms\Components\Tabs\Tab::make('FAQ')
                ->icon('heroicon-o-question-mark-circle')
                ->schema([
                    Forms\Components\Toggle::make('content.faq.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.faq.title')
                        ->label('Titre de la section')
                        ->columnSpanFull(),
                    Forms\Components\Placeholder::make('faq_link')
                        ->label('')
                        ->content(fn () => new \Illuminate\Support\HtmlString(
                            '<a href="/admin/faqs" class="text-primary-600 hover:underline font-medium">→ Contenu > FAQ pour gerer les questions/reponses</a>'
                        )),
                ]),

            // TAB 7 : CTA FINAL
            Forms\Components\Tabs\Tab::make('CTA Final')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->schema([
                    Forms\Components\Toggle::make('content.cta.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.cta.title')
                        ->label('Titre')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('content.cta.subtitle')
                        ->label('Sous-titre')
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.cta.button_text')
                            ->label('Texte du bouton'),
                        Forms\Components\TextInput::make('content.cta.button_url')
                            ->label('URL du bouton'),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\ColorPicker::make('content.cta.background_color')
                            ->label('Couleur de fond'),
                        Forms\Components\ColorPicker::make('content.cta.text_color')
                            ->label('Couleur du texte'),
                    ]),
                ]),
        ];
    }

    // =========================================================================
    // PAGE A PROPOS
    // =========================================================================
    protected static function getAProposTabs(): array
    {
        return [
            // TAB 1 : HERO
            Forms\Components\Tabs\Tab::make('Hero')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('content.hero.subtitle')
                        ->label('Sous-titre')
                        ->rows(3)
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\ColorPicker::make('content.hero.background_color')
                            ->label('Couleur de fond'),
                        Forms\Components\ColorPicker::make('content.hero.text_color')
                            ->label('Couleur du texte'),
                    ]),
                ]),

            // TAB 2 : MISSION
            Forms\Components\Tabs\Tab::make('Notre mission')
                ->icon('heroicon-o-heart')
                ->schema([
                    Forms\Components\Toggle::make('content.mission.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.mission.title')
                        ->label('Titre')
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('content.mission.content')
                        ->label('Contenu')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('content.mission.image')
                        ->label('Image')
                        ->image()
                        ->directory('pages/about'),
                ]),

            // TAB 3 : VALEURS
            Forms\Components\Tabs\Tab::make('Nos valeurs')
                ->icon('heroicon-o-star')
                ->schema([
                    Forms\Components\Toggle::make('content.valeurs.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.valeurs.title')
                        ->label('Titre de la section')
                        ->columnSpanFull(),
                    Forms\Components\Repeater::make('content.valeurs.items')
                        ->label('Liste des valeurs')
                        ->schema([
                            Forms\Components\TextInput::make('icon')
                                ->label('Icone'),
                            Forms\Components\TextInput::make('title')
                                ->label('Titre'),
                            Forms\Components\Textarea::make('description')
                                ->label('Description')
                                ->rows(2),
                        ])
                        ->columns(3)
                        ->collapsible(),
                ]),

            // TAB 4 : EQUIPE
            Forms\Components\Tabs\Tab::make('L\'equipe')
                ->icon('heroicon-o-users')
                ->schema([
                    Forms\Components\Toggle::make('content.equipe.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.equipe.title')
                        ->label('Titre de la section')
                        ->columnSpanFull(),
                    Forms\Components\Repeater::make('content.equipe.members')
                        ->label('Membres de l\'equipe')
                        ->schema([
                            Forms\Components\FileUpload::make('photo')
                                ->label('Photo')
                                ->image()
                                ->directory('pages/team'),
                            Forms\Components\TextInput::make('name')
                                ->label('Nom'),
                            Forms\Components\TextInput::make('role')
                                ->label('Role'),
                            Forms\Components\Textarea::make('bio')
                                ->label('Bio')
                                ->rows(2),
                        ])
                        ->columns(2)
                        ->collapsible(),
                ]),

            // TAB 5 : CTA
            Forms\Components\Tabs\Tab::make('CTA Final')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->schema([
                    Forms\Components\Toggle::make('content.cta.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.cta.title')
                        ->label('Titre')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('content.cta.subtitle')
                        ->label('Sous-titre')
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.cta.button_text')
                            ->label('Texte du bouton'),
                        Forms\Components\TextInput::make('content.cta.button_url')
                            ->label('URL du bouton'),
                    ]),
                ]),
        ];
    }

    // =========================================================================
    // PAGE CONTACT
    // =========================================================================
    protected static function getContactTabs(): array
    {
        return [
            // TAB 1 : HERO
            Forms\Components\Tabs\Tab::make('Hero')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre')
                        ->placeholder('Contactez-nous')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('content.hero.subtitle')
                        ->label('Sous-titre')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),

            // TAB 2 : FORMULAIRE
            Forms\Components\Tabs\Tab::make('Formulaire')
                ->icon('heroicon-o-pencil-square')
                ->schema([
                    Forms\Components\Section::make('Titre et bouton')
                        ->schema([
                            Forms\Components\TextInput::make('content.form.title')
                                ->label('Titre du formulaire')
                                ->placeholder('Envoyez-nous un message'),
                            Forms\Components\TextInput::make('content.form.button_text')
                                ->label('Texte du bouton')
                                ->placeholder('Envoyer'),
                            Forms\Components\TextInput::make('content.form.success_message')
                                ->label('Message de succes')
                                ->placeholder('Merci ! Votre message a bien ete envoye.')
                                ->columnSpanFull(),
                        ]),
                    Forms\Components\Section::make('Labels des champs')
                        ->collapsed()
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.form.name_label')
                                    ->label('Label nom')
                                    ->placeholder('Votre nom'),
                                Forms\Components\TextInput::make('content.form.email_label')
                                    ->label('Label email')
                                    ->placeholder('Votre email'),
                            ]),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('content.form.subject_label')
                                    ->label('Label sujet')
                                    ->placeholder('Sujet'),
                                Forms\Components\TextInput::make('content.form.message_label')
                                    ->label('Label message')
                                    ->placeholder('Votre message'),
                            ]),
                        ]),
                    Forms\Components\Section::make('Options de sujet')
                        ->collapsed()
                        ->schema([
                            Forms\Components\Repeater::make('content.form.subjects')
                                ->label('')
                                ->schema([
                                    Forms\Components\TextInput::make('value')
                                        ->label('Valeur'),
                                    Forms\Components\TextInput::make('label')
                                        ->label('Label affiche'),
                                ])
                                ->columns(2)
                                ->collapsible(),
                        ]),
                ]),

            // TAB 3 : INFOS CONTACT
            Forms\Components\Tabs\Tab::make('Informations')
                ->icon('heroicon-o-envelope')
                ->schema([
                    Forms\Components\TextInput::make('content.info.title')
                        ->label('Titre')
                        ->placeholder('Autres moyens de nous contacter'),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.info.email')
                            ->label('Email')
                            ->email()
                            ->placeholder('hello@captoimaime.ch'),
                        Forms\Components\TextInput::make('content.info.phone')
                            ->label('Telephone'),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.info.address')
                            ->label('Adresse'),
                        Forms\Components\TextInput::make('content.info.hours')
                            ->label('Horaires / Delai de reponse')
                            ->placeholder('Reponse sous 48h'),
                    ]),
                ]),
        ];
    }

    // =========================================================================
    // PAGE FAQ
    // =========================================================================
    protected static function getFaqTabs(): array
    {
        return [
            // TAB 1 : HERO
            Forms\Components\Tabs\Tab::make('Hero')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre')
                        ->placeholder('Questions frequentes')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('content.hero.subtitle')
                        ->label('Sous-titre')
                        ->rows(2)
                        ->placeholder('Trouvez les reponses a vos questions')
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\ColorPicker::make('content.hero.background_color')
                            ->label('Couleur de fond'),
                        Forms\Components\ColorPicker::make('content.hero.text_color')
                            ->label('Couleur du texte'),
                    ]),
                ]),

            // TAB 2 : CONFIGURATION FAQ
            Forms\Components\Tabs\Tab::make('Configuration')
                ->icon('heroicon-o-cog-6-tooth')
                ->schema([
                    Forms\Components\Placeholder::make('faq_info')
                        ->label('')
                        ->content('Les questions/reponses sont gerees dans Contenu > FAQ'),
                    Forms\Components\Select::make('content.faq.category_filter')
                        ->label('Filtrer par categorie')
                        ->options([
                            'all' => 'Toutes les FAQ',
                            'parents' => 'FAQ Parents',
                            'pros' => 'FAQ Professionnels',
                            'general' => 'FAQ Generales',
                        ])
                        ->default('all'),
                    Forms\Components\Placeholder::make('faq_link')
                        ->label('')
                        ->content(fn () => new \Illuminate\Support\HtmlString(
                            '<a href="/admin/faqs" class="text-primary-600 hover:underline font-medium">→ Contenu > FAQ</a>'
                        )),
                ]),

            // TAB 3 : CTA
            Forms\Components\Tabs\Tab::make('CTA Final')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->schema([
                    Forms\Components\Toggle::make('content.cta.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.cta.title')
                        ->label('Titre')
                        ->placeholder('Vous n\'avez pas trouve la reponse ?')
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.cta.button_text')
                            ->label('Texte du bouton')
                            ->placeholder('Contactez-nous'),
                        Forms\Components\TextInput::make('content.cta.button_url')
                            ->label('URL du bouton')
                            ->placeholder('/contact'),
                    ]),
                ]),
        ];
    }

    // =========================================================================
    // PAGE TEMOIGNAGES
    // =========================================================================
    protected static function getTemoignagesTabs(): array
    {
        return [
            // TAB 1 : HERO
            Forms\Components\Tabs\Tab::make('Hero')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre')
                        ->placeholder('Temoignages')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('content.hero.subtitle')
                        ->label('Sous-titre')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),

            // TAB 2 : CONFIGURATION
            Forms\Components\Tabs\Tab::make('Configuration')
                ->icon('heroicon-o-cog-6-tooth')
                ->schema([
                    Forms\Components\Placeholder::make('temoignages_info')
                        ->label('')
                        ->content('Les temoignages sont geres dans Contenu > Temoignages'),
                    Forms\Components\Placeholder::make('temoignages_link')
                        ->label('')
                        ->content(fn () => new \Illuminate\Support\HtmlString(
                            '<a href="/admin/testimonials" class="text-primary-600 hover:underline font-medium">→ Contenu > Temoignages</a>'
                        )),
                ]),

            // TAB 3 : CTA
            Forms\Components\Tabs\Tab::make('CTA Final')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->schema([
                    Forms\Components\Toggle::make('content.cta.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.cta.title')
                        ->label('Titre')
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.cta.button_text')
                            ->label('Texte du bouton'),
                        Forms\Components\TextInput::make('content.cta.button_url')
                            ->label('URL du bouton'),
                    ]),
                ]),
        ];
    }

    // =========================================================================
    // TABS PAR DEFAUT (pour nouvelles pages)
    // =========================================================================
    protected static function getDefaultTabs(): array
    {
        return [
            Forms\Components\Tabs\Tab::make('Hero')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\TextInput::make('content.hero.title')
                        ->label('Titre')
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
                ]),

            Forms\Components\Tabs\Tab::make('Contenu')
                ->icon('heroicon-o-document-text')
                ->schema([
                    Forms\Components\TextInput::make('content.main.title')
                        ->label('Titre de la section'),
                    Forms\Components\RichEditor::make('content.main.content')
                        ->label('Contenu')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('content.main.image')
                        ->label('Image')
                        ->image()
                        ->directory('pages/content'),
                ]),

            Forms\Components\Tabs\Tab::make('CTA Final')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->schema([
                    Forms\Components\Toggle::make('content.cta.show')
                        ->label('Afficher cette section')
                        ->default(true),
                    Forms\Components\TextInput::make('content.cta.title')
                        ->label('Titre')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('content.cta.subtitle')
                        ->label('Sous-titre')
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('content.cta.button_text')
                            ->label('Texte du bouton'),
                        Forms\Components\TextInput::make('content.cta.button_url')
                            ->label('URL du bouton'),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\ColorPicker::make('content.cta.background_color')
                            ->label('Couleur de fond'),
                        Forms\Components\ColorPicker::make('content.cta.text_color')
                            ->label('Couleur du texte'),
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
                    ->label('Slug')
                    ->badge()
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('Slug copie'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifie le')
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
                    ->url(fn ($record) => '/' . ($record->slug === 'accueil' ? '' : $record->slug))
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
