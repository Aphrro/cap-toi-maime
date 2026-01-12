<?php

namespace App\Services;

use App\Models\UserSession;
use Illuminate\Support\Collection;

class NavigationHelper
{
    protected array $navigationPaths = [
        'discovery' => ['/', 'about', 'faq'],
        'questionnaire' => ['questionnaire/step/1', 'questionnaire/step/2', 'questionnaire/step/3', 'questionnaire/results'],
        'search' => ['annuaire', 'annuaire/search'],
        'professional' => ['professionnel/*'],
        'contact' => ['contact', 'espace-pro'],
    ];

    protected array $pageRelations = [
        '/' => ['annuaire', 'questionnaire', 'about'],
        'about' => ['faq', 'annuaire', 'contact'],
        'faq' => ['about', 'contact', 'annuaire'],
        'annuaire' => ['questionnaire', 'faq'],
        'questionnaire' => ['annuaire'],
        'contact' => ['espace-pro', 'annuaire'],
    ];

    public function __construct(
        protected TrackingService $tracking
    ) {}

    public function suggestNextStep(UserSession $session): array
    {
        $recentPages = $session->events()
            ->where('event_type', 'page_view')
            ->latest('created_at')
            ->limit(5)
            ->pluck('page_url')
            ->toArray();

        $currentPage = $recentPages[0] ?? '/';
        $hasQuestionnaire = $session->questionnaire_completed;
        $pagesViewed = $session->pages_viewed;

        // First-time visitor on homepage
        if ($currentPage === '/' && $pagesViewed <= 1) {
            return [
                'primary' => [
                    'label' => 'Commencer le questionnaire',
                    'url' => '/questionnaire',
                    'description' => 'Trouvez le professionnel ideal en quelques questions',
                ],
                'secondary' => [
                    'label' => 'Parcourir l\'annuaire',
                    'url' => '/annuaire',
                    'description' => 'Voir tous les professionnels',
                ],
            ];
        }

        // After questionnaire completion
        if ($hasQuestionnaire && $this->isOnPage($currentPage, 'questionnaire')) {
            return [
                'primary' => [
                    'label' => 'Voir les resultats',
                    'url' => '/questionnaire/results',
                    'description' => 'Decouvrez les professionnels recommandes',
                ],
            ];
        }

        // On professional page
        if ($this->isOnPage($currentPage, 'professionnel')) {
            return [
                'primary' => [
                    'label' => 'Contacter ce professionnel',
                    'url' => '#contact-section',
                    'description' => 'Prendre rendez-vous',
                ],
                'secondary' => [
                    'label' => 'Voir d\'autres professionnels',
                    'url' => '/annuaire',
                    'description' => 'Comparer avec d\'autres',
                ],
            ];
        }

        // On search with no results
        if ($this->isOnPage($currentPage, 'annuaire') && !$hasQuestionnaire) {
            return [
                'primary' => [
                    'label' => 'Essayer le questionnaire',
                    'url' => '/questionnaire',
                    'description' => 'Pour des recommandations personnalisees',
                ],
            ];
        }

        // Default
        return [
            'primary' => [
                'label' => 'Explorer l\'annuaire',
                'url' => '/annuaire',
                'description' => 'Trouver un professionnel',
            ],
        ];
    }

    public function getSmartBreadcrumbs(string $currentPage): array
    {
        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => '/'],
        ];

        $pageMap = [
            'about' => ['label' => 'A propos', 'url' => '/about'],
            'faq' => ['label' => 'FAQ', 'url' => '/faq'],
            'contact' => ['label' => 'Contact', 'url' => '/contact'],
            'temoignages' => ['label' => 'Temoignages', 'url' => '/temoignages'],
            'annuaire' => ['label' => 'Annuaire', 'url' => '/annuaire'],
            'questionnaire' => ['label' => 'Questionnaire', 'url' => '/questionnaire'],
            'espace-pro' => ['label' => 'Espace Pro', 'url' => '/espace-pro'],
        ];

        foreach ($pageMap as $key => $data) {
            if (str_contains($currentPage, $key)) {
                $breadcrumbs[] = $data;
                break;
            }
        }

        // Add step for questionnaire
        if (preg_match('/questionnaire\/step\/(\d+)/', $currentPage, $matches)) {
            $breadcrumbs[] = ['label' => 'Etape ' . $matches[1], 'url' => null];
        }

        // Add professional name placeholder
        if (str_contains($currentPage, 'professionnel')) {
            $breadcrumbs[] = ['label' => 'Annuaire', 'url' => '/annuaire'];
            $breadcrumbs[] = ['label' => 'Professionnel', 'url' => null];
        }

        return $breadcrumbs;
    }

    public function getRelatedPages(string $currentPage): Collection
    {
        $related = collect();
        $pageKey = $this->normalizePageKey($currentPage);

        if (isset($this->pageRelations[$pageKey])) {
            foreach ($this->pageRelations[$pageKey] as $relatedPage) {
                $related->push([
                    'url' => '/' . $relatedPage,
                    'label' => $this->getPageLabel($relatedPage),
                    'description' => $this->getPageDescription($relatedPage),
                ]);
            }
        }

        return $related;
    }

    public function getQuickActions(UserSession $session): array
    {
        $actions = [];

        if (!$session->questionnaire_completed) {
            $actions[] = [
                'label' => 'Questionnaire',
                'url' => '/questionnaire',
                'icon' => 'clipboard-list',
                'color' => 'burgundy',
            ];
        }

        $actions[] = [
            'label' => 'Annuaire',
            'url' => '/annuaire',
            'icon' => 'search',
            'color' => 'teal',
        ];

        $actions[] = [
            'label' => 'FAQ',
            'url' => '/faq',
            'icon' => 'question-mark-circle',
            'color' => 'gray',
        ];

        $actions[] = [
            'label' => 'Contact',
            'url' => '/contact',
            'icon' => 'mail',
            'color' => 'gray',
        ];

        return $actions;
    }

    protected function isOnPage(string $currentPage, string $pattern): bool
    {
        if ($pattern === $currentPage) {
            return true;
        }

        return str_contains($currentPage, $pattern);
    }

    protected function normalizePageKey(string $page): string
    {
        $page = trim($page, '/');

        if ($page === '') {
            return '/';
        }

        // Extract first segment
        $segments = explode('/', $page);
        return $segments[0];
    }

    protected function getPageLabel(string $page): string
    {
        $labels = [
            'annuaire' => 'Annuaire',
            'questionnaire' => 'Questionnaire',
            'about' => 'A propos',
            'faq' => 'FAQ',
            'contact' => 'Contact',
            'temoignages' => 'Temoignages',
            'espace-pro' => 'Espace Pro',
        ];

        return $labels[$page] ?? ucfirst($page);
    }

    protected function getPageDescription(string $page): string
    {
        $descriptions = [
            'annuaire' => 'Parcourir tous les professionnels',
            'questionnaire' => 'Trouver le professionnel ideal',
            'about' => 'En savoir plus sur Cap Toi M\'aime',
            'faq' => 'Questions frequentes',
            'contact' => 'Nous contacter',
            'temoignages' => 'Lire les temoignages',
            'espace-pro' => 'Pour les professionnels',
        ];

        return $descriptions[$page] ?? '';
    }
}
