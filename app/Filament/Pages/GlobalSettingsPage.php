<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

class GlobalSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Paramètres Globaux';
    protected static ?string $title = 'Paramètres Globaux du Site';
    protected static ?string $navigationGroup = 'Paramètres';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.global-settings-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->loadSettings());
    }

    protected function loadSettings(): array
    {
        // Charger les paramètres existants
        $settings = Setting::whereIn('key', [
            'site_name', 'site_logo', 'site_favicon',
            'color_primary', 'color_secondary', 'color_accent', 'color_background',
            'navbar_config', 'footer_config'
        ])->pluck('value', 'key')->toArray();

        // Décoder les JSON
        $navbarConfig = isset($settings['navbar_config']) ? json_decode($settings['navbar_config'], true) : [];
        $footerConfig = isset($settings['footer_config']) ? json_decode($settings['footer_config'], true) : [];

        return [
            // Site
            'site_name' => $settings['site_name'] ?? 'Cap Toi M\'aime',
            'site_logo' => $settings['site_logo'] ?? null,
            'site_favicon' => $settings['site_favicon'] ?? null,

            // Couleurs
            'color_primary' => $settings['color_primary'] ?? '#7A1F2E',
            'color_secondary' => $settings['color_secondary'] ?? '#1E8A9B',
            'color_accent' => $settings['color_accent'] ?? '#F5A623',
            'color_background' => $settings['color_background'] ?? '#FFFFFF',

            // Navbar
            'navbar_links' => $navbarConfig['links'] ?? [
                ['label' => 'Accueil', 'url' => '/', 'is_active' => true],
                ['label' => 'Comment ça marche', 'url' => '/comment-ca-marche', 'is_active' => true],
                ['label' => 'Annuaire', 'url' => '/annuaire', 'is_active' => true],
                ['label' => 'Ressources', 'url' => '/ressources', 'is_active' => true],
                ['label' => 'L\'Association', 'url' => '/association', 'is_active' => true],
            ],
            'navbar_cta_text' => $navbarConfig['cta_text'] ?? 'TROUVER UN PRO',
            'navbar_cta_url' => $navbarConfig['cta_url'] ?? '/questionnaire',
            'navbar_cta_visible' => $navbarConfig['cta_visible'] ?? true,

            // Footer
            'footer_description' => $footerConfig['description'] ?? 'Plateforme de mise en relation entre familles et professionnels spécialisés dans l\'accompagnement du refus scolaire anxieux en Suisse.',
            'footer_columns' => $footerConfig['columns'] ?? [
                [
                    'title' => 'Navigation',
                    'links' => [
                        ['label' => 'Accueil', 'url' => '/'],
                        ['label' => 'Annuaire', 'url' => '/annuaire'],
                        ['label' => 'Comment ça marche', 'url' => '/comment-ca-marche'],
                    ]
                ],
                [
                    'title' => 'Professionnels',
                    'links' => [
                        ['label' => 'Devenir membre', 'url' => '/devenir-membre'],
                        ['label' => 'Espace pro', 'url' => '/espace-professionnels'],
                    ]
                ],
                [
                    'title' => 'Légal',
                    'links' => [
                        ['label' => 'Mentions légales', 'url' => '/mentions-legales'],
                        ['label' => 'Confidentialité', 'url' => '/politique-confidentialite'],
                        ['label' => 'CGU', 'url' => '/conditions-utilisation'],
                    ]
                ],
            ],
            'footer_social_facebook' => $footerConfig['social']['facebook'] ?? '',
            'footer_social_instagram' => $footerConfig['social']['instagram'] ?? '',
            'footer_social_linkedin' => $footerConfig['social']['linkedin'] ?? '',
            'footer_social_twitter' => $footerConfig['social']['twitter'] ?? '',
            'footer_copyright' => $footerConfig['copyright'] ?? '© ' . date('Y') . ' Cap Toi M\'aime. Tous droits réservés.',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Paramètres')
                    ->tabs([
                        // === ONGLET SITE ===
                        Forms\Components\Tabs\Tab::make('Site')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Forms\Components\Section::make('Identité du site')
                                    ->description('Nom et logos du site')
                                    ->schema([
                                        Forms\Components\TextInput::make('site_name')
                                            ->label('Nom du site')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\FileUpload::make('site_logo')
                                                    ->label('Logo principal')
                                                    ->image()
                                                    ->directory('site')
                                                    ->visibility('public')
                                                    ->imageResizeMode('contain')
                                                    ->imageCropAspectRatio('16:9'),
                                                Forms\Components\FileUpload::make('site_favicon')
                                                    ->label('Favicon')
                                                    ->image()
                                                    ->directory('site')
                                                    ->visibility('public')
                                                    ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml']),
                                            ]),
                                    ]),
                            ]),

                        // === ONGLET COULEURS ===
                        Forms\Components\Tabs\Tab::make('Couleurs')
                            ->icon('heroicon-o-swatch')
                            ->schema([
                                Forms\Components\Section::make('Palette de couleurs')
                                    ->description('Couleurs principales utilisées sur tout le site')
                                    ->schema([
                                        Forms\Components\Grid::make(4)
                                            ->schema([
                                                Forms\Components\ColorPicker::make('color_primary')
                                                    ->label('Couleur primaire')
                                                    ->helperText('Bourgogne - Boutons, accents')
                                                    ->required(),
                                                Forms\Components\ColorPicker::make('color_secondary')
                                                    ->label('Couleur secondaire')
                                                    ->helperText('Teal - Liens, badges')
                                                    ->required(),
                                                Forms\Components\ColorPicker::make('color_accent')
                                                    ->label('Couleur accent')
                                                    ->helperText('Pour les highlights'),
                                                Forms\Components\ColorPicker::make('color_background')
                                                    ->label('Arrière-plan')
                                                    ->helperText('Fond principal'),
                                            ]),
                                    ]),
                                Forms\Components\Section::make('Aperçu')
                                    ->schema([
                                        Forms\Components\Placeholder::make('preview')
                                            ->label('')
                                            ->content('Sauvegardez pour voir les changements de couleurs appliqués sur le site.'),
                                    ]),
                            ]),

                        // === ONGLET NAVBAR ===
                        Forms\Components\Tabs\Tab::make('Navbar')
                            ->icon('heroicon-o-bars-3')
                            ->schema([
                                Forms\Components\Section::make('Liens de navigation')
                                    ->description('Gérer les liens du menu principal')
                                    ->schema([
                                        Forms\Components\Repeater::make('navbar_links')
                                            ->label('Liens du menu')
                                            ->schema([
                                                Forms\Components\Grid::make(3)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('label')
                                                            ->label('Texte')
                                                            ->required(),
                                                        Forms\Components\TextInput::make('url')
                                                            ->label('URL')
                                                            ->required()
                                                            ->prefix('/'),
                                                        Forms\Components\Toggle::make('is_active')
                                                            ->label('Actif')
                                                            ->default(true),
                                                    ]),
                                            ])
                                            ->reorderable()
                                            ->collapsible()
                                            ->defaultItems(5)
                                            ->addActionLabel('Ajouter un lien'),
                                    ]),
                                Forms\Components\Section::make('Bouton CTA')
                                    ->description('Bouton d\'appel à l\'action dans la navbar')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('navbar_cta_text')
                                                    ->label('Texte du bouton')
                                                    ->required(),
                                                Forms\Components\TextInput::make('navbar_cta_url')
                                                    ->label('URL du bouton')
                                                    ->required(),
                                                Forms\Components\Toggle::make('navbar_cta_visible')
                                                    ->label('Afficher le CTA')
                                                    ->default(true),
                                            ]),
                                    ]),
                            ]),

                        // === ONGLET FOOTER ===
                        Forms\Components\Tabs\Tab::make('Footer')
                            ->icon('heroicon-o-rectangle-stack')
                            ->schema([
                                Forms\Components\Section::make('Description')
                                    ->schema([
                                        Forms\Components\Textarea::make('footer_description')
                                            ->label('Texte de description')
                                            ->rows(3)
                                            ->helperText('Texte affiché dans la première colonne du footer'),
                                    ]),
                                Forms\Components\Section::make('Colonnes de liens')
                                    ->description('Gérer les colonnes de liens du footer')
                                    ->schema([
                                        Forms\Components\Repeater::make('footer_columns')
                                            ->label('Colonnes')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Titre de la colonne')
                                                    ->required(),
                                                Forms\Components\Repeater::make('links')
                                                    ->label('Liens')
                                                    ->schema([
                                                        Forms\Components\Grid::make(2)
                                                            ->schema([
                                                                Forms\Components\TextInput::make('label')
                                                                    ->label('Texte')
                                                                    ->required(),
                                                                Forms\Components\TextInput::make('url')
                                                                    ->label('URL')
                                                                    ->required(),
                                                            ]),
                                                    ])
                                                    ->collapsible()
                                                    ->defaultItems(3)
                                                    ->addActionLabel('Ajouter un lien'),
                                            ])
                                            ->reorderable()
                                            ->collapsible()
                                            ->defaultItems(3)
                                            ->maxItems(4)
                                            ->addActionLabel('Ajouter une colonne'),
                                    ]),
                                Forms\Components\Section::make('Réseaux sociaux')
                                    ->description('Liens vers vos réseaux sociaux')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('footer_social_facebook')
                                                    ->label('Facebook')
                                                    ->url()
                                                    ->placeholder('https://facebook.com/...'),
                                                Forms\Components\TextInput::make('footer_social_instagram')
                                                    ->label('Instagram')
                                                    ->url()
                                                    ->placeholder('https://instagram.com/...'),
                                                Forms\Components\TextInput::make('footer_social_linkedin')
                                                    ->label('LinkedIn')
                                                    ->url()
                                                    ->placeholder('https://linkedin.com/...'),
                                                Forms\Components\TextInput::make('footer_social_twitter')
                                                    ->label('Twitter/X')
                                                    ->url()
                                                    ->placeholder('https://twitter.com/...'),
                                            ]),
                                    ]),
                                Forms\Components\Section::make('Copyright')
                                    ->schema([
                                        Forms\Components\TextInput::make('footer_copyright')
                                            ->label('Texte de copyright')
                                            ->helperText('Affiché tout en bas du site'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Sauvegarder les paramètres simples
        Setting::set('site_name', $data['site_name']);
        Setting::set('site_logo', $data['site_logo']);
        Setting::set('site_favicon', $data['site_favicon']);
        Setting::set('color_primary', $data['color_primary']);
        Setting::set('color_secondary', $data['color_secondary']);
        Setting::set('color_accent', $data['color_accent']);
        Setting::set('color_background', $data['color_background']);

        // Sauvegarder la config navbar en JSON
        $navbarConfig = [
            'links' => $data['navbar_links'],
            'cta_text' => $data['navbar_cta_text'],
            'cta_url' => $data['navbar_cta_url'],
            'cta_visible' => $data['navbar_cta_visible'],
        ];
        Setting::set('navbar_config', json_encode($navbarConfig, JSON_UNESCAPED_UNICODE));

        // Sauvegarder la config footer en JSON
        $footerConfig = [
            'description' => $data['footer_description'],
            'columns' => $data['footer_columns'],
            'social' => [
                'facebook' => $data['footer_social_facebook'],
                'instagram' => $data['footer_social_instagram'],
                'linkedin' => $data['footer_social_linkedin'],
                'twitter' => $data['footer_social_twitter'],
            ],
            'copyright' => $data['footer_copyright'],
        ];
        Setting::set('footer_config', json_encode($footerConfig, JSON_UNESCAPED_UNICODE));

        // Vider le cache
        Cache::flush();

        Notification::make()
            ->title('Paramètres sauvegardés')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('save')
                ->label('Sauvegarder')
                ->submit('save'),
        ];
    }
}
