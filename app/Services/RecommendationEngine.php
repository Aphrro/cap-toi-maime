<?php

namespace App\Services;

use App\Models\UserSession;
use App\Models\RecommendationRule;
use Illuminate\Support\Collection;

class RecommendationEngine
{
    public function __construct(
        protected TrackingService $tracking
    ) {}

    public function analyzeContext(UserSession $session, string $currentPage): array
    {
        $recentEvents = $session->events()
            ->latest('created_at')
            ->limit(20)
            ->get();

        $lastPageView = $recentEvents->firstWhere('event_type', 'page_view');

        return [
            // Session data
            'session_id' => $session->id,
            'pages_viewed' => $session->pages_viewed,
            'professionals_viewed' => $session->professionals_viewed,
            'questionnaire_completed' => $session->questionnaire_completed,
            'contact_initiated' => $session->contact_initiated,
            'session_duration' => $session->getDurationInMinutes(),
            'device_type' => $session->device_type,

            // Current page data
            'current_page' => $currentPage,
            'page_category' => $this->categorizePageUrl($currentPage),

            // User behavior
            'is_returning' => $this->tracking->isReturningVisitor(),
            'previous_sessions' => $this->tracking->getPreviousSessionCount(),

            // Recent activity
            'recent_events_count' => $recentEvents->count(),
            'scroll_depth' => $lastPageView?->scroll_depth ?? 0,
            'time_on_page' => $lastPageView?->time_on_page ?? 0,

            // Search/filter context
            'has_searched' => $recentEvents->where('event_type', 'search')->isNotEmpty(),
            'filters_used' => $this->extractFiltersFromEvents($recentEvents),
            'search_queries' => $this->extractSearchQueries($recentEvents),

            // Questionnaire context
            'questionnaire_data' => $session->questionnaire_data ?? [],
            'current_step' => $session->questionnaire_data['current_step'] ?? null,
        ];
    }

    public function getSuggestions(array $context, int $limit = 3): Collection
    {
        $triggerContext = $this->determineContextTrigger($context);

        $rules = RecommendationRule::active()
            ->forContext($triggerContext)
            ->byPriority()
            ->get();

        $suggestions = collect();

        foreach ($rules as $rule) {
            if ($rule->evaluateConditions($context)) {
                $suggestions->push($this->buildSuggestion($rule, $context));
                $rule->incrementShown();

                if ($suggestions->count() >= $limit) {
                    break;
                }
            }
        }

        // Add default suggestions if needed
        if ($suggestions->isEmpty()) {
            $suggestions = $this->getDefaultSuggestions($context);
        }

        return $suggestions;
    }

    public function getNextBestAction(array $context): ?array
    {
        // Priority-based next action logic
        if (!$context['questionnaire_completed'] && $context['pages_viewed'] > 2) {
            return [
                'type' => 'suggestion',
                'action' => 'start_questionnaire',
                'message' => 'Trouvez le professionnel ideal grace a notre questionnaire guide.',
                'priority' => 'high',
            ];
        }

        if ($context['questionnaire_completed'] && $context['professionals_viewed'] === 0) {
            return [
                'type' => 'redirect',
                'action' => 'view_results',
                'message' => 'Decouvrez les professionnels recommandes pour vous.',
                'priority' => 'high',
            ];
        }

        if ($context['professionals_viewed'] > 3 && !$context['contact_initiated']) {
            return [
                'type' => 'suggestion',
                'action' => 'encourage_contact',
                'message' => 'Un professionnel vous interesse ? N\'hesitez pas a le contacter.',
                'priority' => 'medium',
            ];
        }

        return null;
    }

    public function getContextualHints(string $page, array $context): array
    {
        $hints = [];
        $triggerContext = $page . '_hints';

        $rules = RecommendationRule::active()
            ->forContext($triggerContext)
            ->byPriority()
            ->limit(2)
            ->get();

        foreach ($rules as $rule) {
            if ($rule->evaluateConditions($context)) {
                $hints[] = $this->buildHint($rule, $context);
                $rule->incrementShown();
            }
        }

        return $hints;
    }

    protected function determineContextTrigger(array $context): string
    {
        $page = $context['current_page'];

        // Homepage contexts
        if ($page === '/' || $page === 'home') {
            if ($context['is_returning']) {
                return 'homepage_returning';
            }
            return 'homepage_new';
        }

        // Questionnaire contexts
        if (str_contains($page, 'questionnaire')) {
            $step = $context['current_step'] ?? 1;
            return "questionnaire_step_{$step}";
        }

        // Search/Annuaire contexts
        if (str_contains($page, 'annuaire') || str_contains($page, 'search')) {
            if (isset($context['results_count']) && $context['results_count'] === 0) {
                return 'search_no_results';
            }
            if (isset($context['results_count']) && $context['results_count'] < 3) {
                return 'search_few_results';
            }
            return 'search_page';
        }

        // Professional detail
        if (str_contains($page, 'professionnel') || preg_match('/\/pro\/\d+/', $page)) {
            return 'professional_detail';
        }

        // Results page
        if (str_contains($page, 'resultats')) {
            return 'results_page';
        }

        return 'general';
    }

    protected function buildSuggestion(RecommendationRule $rule, array $context): array
    {
        $data = $rule->recommendation_data;

        // Replace dynamic placeholders
        $message = $data['message'] ?? '';
        foreach ($context as $key => $value) {
            if (is_string($value) || is_numeric($value)) {
                $message = str_replace("{{$key}}", (string) $value, $message);
            }
        }

        return [
            'id' => $rule->id,
            'type' => $rule->recommendation_type,
            'message' => $message,
            'icon' => $data['icon'] ?? 'info',
            'actions' => $data['actions'] ?? [],
            'priority' => $rule->priority,
        ];
    }

    protected function buildHint(RecommendationRule $rule, array $context): array
    {
        $data = $rule->recommendation_data;

        $message = $data['message'] ?? '';
        foreach ($context as $key => $value) {
            if (is_string($value) || is_numeric($value)) {
                $message = str_replace("{{$key}}", (string) $value, $message);
            }
        }

        return [
            'id' => $rule->id,
            'message' => $message,
            'icon' => $data['icon'] ?? 'lightbulb',
            'actions' => $data['actions'] ?? [],
        ];
    }

    protected function getDefaultSuggestions(array $context): Collection
    {
        $defaults = collect();

        if (!$context['questionnaire_completed']) {
            $defaults->push([
                'id' => 'default_questionnaire',
                'type' => 'suggestion',
                'message' => 'Utilisez notre questionnaire pour trouver le professionnel adapte a votre situation.',
                'icon' => 'clipboard-list',
                'actions' => [
                    ['label' => 'Commencer', 'action' => 'start_questionnaire'],
                ],
                'priority' => 60,
            ]);
        }

        if ($context['pages_viewed'] < 3) {
            $defaults->push([
                'id' => 'default_explore',
                'type' => 'suggestion',
                'message' => 'Explorez notre annuaire de professionnels specialises.',
                'icon' => 'search',
                'actions' => [
                    ['label' => 'Voir l\'annuaire', 'action' => 'browse_directory'],
                ],
                'priority' => 50,
            ]);
        }

        return $defaults->take(2);
    }

    protected function categorizePageUrl(string $url): string
    {
        if ($url === '/' || $url === 'home') {
            return 'home';
        }

        $patterns = [
            'questionnaire' => ['questionnaire', 'quiz'],
            'annuaire' => ['annuaire', 'search', 'recherche'],
            'professional' => ['professionnel', 'pro/', 'professional'],
            'results' => ['resultats', 'results'],
            'info' => ['about', 'faq', 'contact', 'temoignages'],
            'auth' => ['login', 'register', 'password'],
        ];

        foreach ($patterns as $category => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($url, $keyword)) {
                    return $category;
                }
            }
        }

        return 'other';
    }

    protected function extractFiltersFromEvents(Collection $events): array
    {
        return $events
            ->where('event_type', 'filter')
            ->pluck('event_data.filter_name')
            ->filter()
            ->unique()
            ->values()
            ->toArray();
    }

    protected function extractSearchQueries(Collection $events): array
    {
        return $events
            ->where('event_type', 'search')
            ->pluck('event_data.query')
            ->filter()
            ->unique()
            ->values()
            ->toArray();
    }
}
