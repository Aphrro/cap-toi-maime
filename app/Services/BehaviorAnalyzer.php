<?php

namespace App\Services;

use App\Models\UserSession;
use App\Models\UserEvent;
use Illuminate\Support\Collection;

class BehaviorAnalyzer
{
    // User intent types
    public const INTENT_BROWSING = 'browsing';
    public const INTENT_SEARCHING = 'searching';
    public const INTENT_COMPARING = 'comparing';
    public const INTENT_DECIDING = 'deciding';
    public const INTENT_CONFUSED = 'confused';
    public const INTENT_READY_TO_CONTACT = 'ready_to_contact';
    public const INTENT_LEAVING = 'leaving';

    // Engagement levels
    public const ENGAGEMENT_LOW = 'low';
    public const ENGAGEMENT_MEDIUM = 'medium';
    public const ENGAGEMENT_HIGH = 'high';

    // Frustration indicators
    protected array $frustrationPatterns = [
        'rapid_back_navigation' => 3,      // Going back multiple times quickly
        'repeated_searches' => 2,           // Same/similar searches
        'filter_cycling' => 2,              // Adding/removing same filters
        'rage_clicks' => 4,                 // Multiple rapid clicks
        'scroll_bouncing' => 2,             // Scrolling up and down rapidly
        'form_abandonment' => 3,            // Starting but not completing forms
        'long_inactivity' => 1,             // User seems stuck
    ];

    public function analyzeSession(UserSession $session): array
    {
        $recentEvents = $this->getRecentEvents($session, 50);
        $lastMinuteEvents = $this->getRecentEvents($session, 20, 1);

        return [
            'intent' => $this->detectIntent($session, $recentEvents),
            'engagement' => $this->calculateEngagement($session, $recentEvents),
            'frustration_level' => $this->detectFrustration($lastMinuteEvents),
            'journey_stage' => $this->determineJourneyStage($session),
            'interests' => $this->extractInterests($recentEvents),
            'pain_points' => $this->identifyPainPoints($recentEvents),
            'next_likely_action' => $this->predictNextAction($session, $recentEvents),
            'assistance_needed' => $this->assessAssistanceNeed($session, $recentEvents, $lastMinuteEvents),
            'recommendations' => $this->generateSmartRecommendations($session, $recentEvents),
        ];
    }

    public function analyzeRealTimeBehavior(array $behaviorData, UserSession $session): array
    {
        $signals = [];

        // Analyze scroll behavior
        if (isset($behaviorData['scroll'])) {
            $scroll = $behaviorData['scroll'];
            if ($scroll['speed'] === 'fast' && $scroll['direction_changes'] > 3) {
                $signals[] = ['type' => 'scanning', 'confidence' => 0.8];
            }
            if ($scroll['depth'] > 80 && $scroll['time_at_bottom'] > 5) {
                $signals[] = ['type' => 'interested', 'confidence' => 0.9];
            }
            if ($scroll['bounces'] > 2) {
                $signals[] = ['type' => 'confused', 'confidence' => 0.6];
            }
        }

        // Analyze mouse behavior
        if (isset($behaviorData['mouse'])) {
            $mouse = $behaviorData['mouse'];
            if ($mouse['hesitation_count'] > 2) {
                $signals[] = ['type' => 'uncertain', 'confidence' => 0.7];
            }
            if ($mouse['hover_on_cta'] > 3) {
                $signals[] = ['type' => 'considering_action', 'confidence' => 0.85];
            }
        }

        // Analyze time patterns
        if (isset($behaviorData['time'])) {
            $time = $behaviorData['time'];
            if ($time['on_page'] > 120 && $time['idle'] < 30) {
                $signals[] = ['type' => 'highly_engaged', 'confidence' => 0.9];
            }
            if ($time['idle'] > 60) {
                $signals[] = ['type' => 'distracted_or_stuck', 'confidence' => 0.7];
            }
        }

        // Analyze click patterns
        if (isset($behaviorData['clicks'])) {
            $clicks = $behaviorData['clicks'];
            if ($clicks['rapid_same_element'] > 2) {
                $signals[] = ['type' => 'frustrated', 'confidence' => 0.8];
            }
        }

        return [
            'signals' => $signals,
            'dominant_signal' => $this->getDominantSignal($signals),
            'suggested_intervention' => $this->suggestIntervention($signals, $session),
        ];
    }

    protected function detectIntent(UserSession $session, Collection $events): string
    {
        $pageViews = $events->where('event_type', 'page_view');
        $searches = $events->where('event_type', 'search');
        $professionalViews = $events->where('event_category', 'professional');
        $contactEvents = $events->where('event_category', 'contact');

        // Ready to contact - viewed contact info or hovered on contact buttons
        if ($contactEvents->isNotEmpty() || $session->contact_initiated) {
            return self::INTENT_READY_TO_CONTACT;
        }

        // Comparing - viewed multiple professionals
        if ($professionalViews->count() >= 3) {
            return self::INTENT_COMPARING;
        }

        // Deciding - spent long time on one professional
        $longViewEvents = $events->filter(fn($e) =>
            $e->event_category === 'professional' &&
            ($e->time_on_page ?? 0) > 60
        );
        if ($longViewEvents->isNotEmpty()) {
            return self::INTENT_DECIDING;
        }

        // Searching - active search behavior
        if ($searches->count() >= 2 || $events->where('event_type', 'filter')->count() >= 2) {
            return self::INTENT_SEARCHING;
        }

        // Confused - lots of back navigation or repeated page views
        $backNavigations = $events->where('event_action', 'back');
        $uniquePages = $pageViews->pluck('page_url')->unique()->count();
        $totalPageViews = $pageViews->count();

        if ($backNavigations->count() >= 3 || ($totalPageViews > 5 && $uniquePages < 3)) {
            return self::INTENT_CONFUSED;
        }

        // Leaving - exit intent detected
        if ($events->where('event_type', 'exit_intent')->isNotEmpty()) {
            return self::INTENT_LEAVING;
        }

        return self::INTENT_BROWSING;
    }

    protected function calculateEngagement(UserSession $session, Collection $events): array
    {
        $score = 0;
        $factors = [];

        // Time on site (max 30 points)
        $duration = $session->getDurationInMinutes();
        $timeScore = min(30, $duration * 3);
        $score += $timeScore;
        $factors['time'] = $timeScore;

        // Pages viewed (max 20 points)
        $pagesScore = min(20, $session->pages_viewed * 4);
        $score += $pagesScore;
        $factors['pages'] = $pagesScore;

        // Scroll depth average (max 20 points)
        $scrollDepths = $events->whereNotNull('scroll_depth')->pluck('scroll_depth');
        $avgScroll = $scrollDepths->isNotEmpty() ? $scrollDepths->avg() : 0;
        $scrollScore = min(20, $avgScroll / 5);
        $score += $scrollScore;
        $factors['scroll'] = $scrollScore;

        // Interactions (max 20 points)
        $interactions = $events->whereIn('event_type', ['click', 'search', 'filter'])->count();
        $interactionScore = min(20, $interactions * 2);
        $score += $interactionScore;
        $factors['interactions'] = $interactionScore;

        // Professional views (max 10 points)
        $proScore = min(10, $session->professionals_viewed * 2);
        $score += $proScore;
        $factors['professionals'] = $proScore;

        $level = match(true) {
            $score >= 70 => self::ENGAGEMENT_HIGH,
            $score >= 35 => self::ENGAGEMENT_MEDIUM,
            default => self::ENGAGEMENT_LOW,
        };

        return [
            'score' => $score,
            'level' => $level,
            'factors' => $factors,
        ];
    }

    protected function detectFrustration(Collection $recentEvents): array
    {
        $score = 0;
        $indicators = [];

        // Rapid back navigation
        $backEvents = $recentEvents->where('event_action', 'back');
        if ($backEvents->count() >= 3) {
            $score += $this->frustrationPatterns['rapid_back_navigation'];
            $indicators[] = 'rapid_back_navigation';
        }

        // Repeated searches (same or similar queries)
        $searches = $recentEvents->where('event_type', 'search')->pluck('event_data.query')->filter();
        if ($searches->count() >= 2) {
            $uniqueSearches = $searches->unique()->count();
            if ($uniqueSearches < $searches->count()) {
                $score += $this->frustrationPatterns['repeated_searches'];
                $indicators[] = 'repeated_searches';
            }
        }

        // Rage clicks (multiple rapid clicks)
        $clicks = $recentEvents->where('event_type', 'click');
        $rapidClicks = $this->detectRapidEvents($clicks, 2); // 2 seconds window
        if ($rapidClicks >= 4) {
            $score += $this->frustrationPatterns['rage_clicks'];
            $indicators[] = 'rage_clicks';
        }

        // Scroll bouncing
        $scrollEvents = $recentEvents->where('event_type', 'scroll');
        $directionChanges = $scrollEvents->where('event_data.direction_change', true)->count();
        if ($directionChanges >= 4) {
            $score += $this->frustrationPatterns['scroll_bouncing'];
            $indicators[] = 'scroll_bouncing';
        }

        $level = match(true) {
            $score >= 8 => 'high',
            $score >= 4 => 'medium',
            $score > 0 => 'low',
            default => 'none',
        };

        return [
            'score' => $score,
            'level' => $level,
            'indicators' => $indicators,
        ];
    }

    protected function determineJourneyStage(UserSession $session): string
    {
        if ($session->contact_initiated) {
            return 'conversion';
        }

        if ($session->questionnaire_completed) {
            return 'qualified';
        }

        if ($session->professionals_viewed >= 3) {
            return 'evaluation';
        }

        if ($session->professionals_viewed >= 1) {
            return 'consideration';
        }

        if ($session->pages_viewed >= 3) {
            return 'exploration';
        }

        return 'awareness';
    }

    protected function extractInterests(Collection $events): array
    {
        $interests = [];

        // Extract from search queries
        $searches = $events->where('event_type', 'search')
            ->pluck('event_data.query')
            ->filter();

        foreach ($searches as $query) {
            $interests['search_terms'][] = $query;
        }

        // Extract from filters used
        $filters = $events->where('event_type', 'filter')
            ->pluck('event_data')
            ->filter();

        foreach ($filters as $filterData) {
            if (isset($filterData['canton'])) {
                $interests['cantons'][] = $filterData['canton'];
            }
            if (isset($filterData['specialty'])) {
                $interests['specialties'][] = $filterData['specialty'];
            }
            if (isset($filterData['category'])) {
                $interests['categories'][] = $filterData['category'];
            }
        }

        // Extract from questionnaire data
        $questionnaireEvents = $events->where('event_category', 'questionnaire');
        foreach ($questionnaireEvents as $event) {
            if (isset($event->event_data['selections'])) {
                $interests['questionnaire_selections'][] = $event->event_data['selections'];
            }
        }

        // Deduplicate
        foreach ($interests as $key => $values) {
            $interests[$key] = array_unique(array_filter($values));
        }

        return $interests;
    }

    protected function identifyPainPoints(Collection $events): array
    {
        $painPoints = [];

        // No results after search
        $noResultSearches = $events->filter(fn($e) =>
            $e->event_type === 'search' &&
            ($e->event_data['results_count'] ?? -1) === 0
        );
        if ($noResultSearches->isNotEmpty()) {
            $painPoints[] = [
                'type' => 'no_search_results',
                'severity' => 'high',
                'context' => $noResultSearches->pluck('event_data.query')->toArray(),
            ];
        }

        // Form abandonment
        $formStarts = $events->where('event_action', 'form_start')->count();
        $formCompletes = $events->where('event_action', 'form_complete')->count();
        if ($formStarts > $formCompletes) {
            $painPoints[] = [
                'type' => 'form_abandonment',
                'severity' => 'medium',
                'count' => $formStarts - $formCompletes,
            ];
        }

        // Repeated page visits without progression
        $pageVisits = $events->where('event_type', 'page_view')
            ->groupBy('page_url')
            ->filter(fn($group) => $group->count() >= 3);

        if ($pageVisits->isNotEmpty()) {
            $painPoints[] = [
                'type' => 'stuck_on_page',
                'severity' => 'medium',
                'pages' => $pageVisits->keys()->toArray(),
            ];
        }

        return $painPoints;
    }

    protected function predictNextAction(UserSession $session, Collection $events): array
    {
        $lastEvent = $events->first();
        $currentPage = $lastEvent?->page_url ?? '/';

        $predictions = [];

        // Based on current page
        if (str_contains($currentPage, 'annuaire')) {
            if (!$session->questionnaire_completed) {
                $predictions[] = ['action' => 'start_questionnaire', 'probability' => 0.4];
            }
            $predictions[] = ['action' => 'view_professional', 'probability' => 0.5];
            $predictions[] = ['action' => 'apply_filter', 'probability' => 0.3];
        }

        if (str_contains($currentPage, 'professionnel')) {
            $predictions[] = ['action' => 'contact_professional', 'probability' => 0.4];
            $predictions[] = ['action' => 'view_another_professional', 'probability' => 0.35];
            $predictions[] = ['action' => 'go_back_to_search', 'probability' => 0.25];
        }

        if ($currentPage === '/' || $currentPage === 'home') {
            $predictions[] = ['action' => 'explore_directory', 'probability' => 0.4];
            $predictions[] = ['action' => 'start_questionnaire', 'probability' => 0.35];
            $predictions[] = ['action' => 'read_about', 'probability' => 0.15];
        }

        // Sort by probability
        usort($predictions, fn($a, $b) => $b['probability'] <=> $a['probability']);

        return $predictions[0] ?? ['action' => 'unknown', 'probability' => 0];
    }

    protected function assessAssistanceNeed(UserSession $session, Collection $events, Collection $lastMinuteEvents): array
    {
        $needsHelp = false;
        $urgency = 'low';
        $reasons = [];

        // Check frustration
        $frustration = $this->detectFrustration($lastMinuteEvents);
        if ($frustration['level'] === 'high') {
            $needsHelp = true;
            $urgency = 'high';
            $reasons[] = 'User appears frustrated';
        }

        // Check if stuck (same page, no interactions)
        $lastPageView = $events->where('event_type', 'page_view')->first();
        $interactionsSincePageView = $events->takeUntil(fn($e) => $e->id === $lastPageView?->id)
            ->whereIn('event_type', ['click', 'search', 'filter'])
            ->count();

        if ($interactionsSincePageView === 0 && $session->getDurationInMinutes() > 2) {
            $needsHelp = true;
            $urgency = max($urgency, 'medium');
            $reasons[] = 'User seems stuck on current page';
        }

        // Check if new user needs guidance
        if ($session->pages_viewed <= 2 && !$session->questionnaire_completed) {
            $needsHelp = true;
            $reasons[] = 'New user may need orientation';
        }

        // Check for no results pain point
        $painPoints = $this->identifyPainPoints($events);
        $noResults = collect($painPoints)->firstWhere('type', 'no_search_results');
        if ($noResults) {
            $needsHelp = true;
            $urgency = 'high';
            $reasons[] = 'Search returned no results';
        }

        return [
            'needs_help' => $needsHelp,
            'urgency' => $urgency,
            'reasons' => $reasons,
        ];
    }

    protected function generateSmartRecommendations(UserSession $session, Collection $events): array
    {
        $recommendations = [];
        $intent = $this->detectIntent($session, $events);
        $stage = $this->determineJourneyStage($session);
        $painPoints = $this->identifyPainPoints($events);

        // Based on pain points (highest priority)
        foreach ($painPoints as $painPoint) {
            if ($painPoint['type'] === 'no_search_results') {
                $recommendations[] = [
                    'type' => 'action',
                    'priority' => 100,
                    'message' => 'Aucun resultat ? Essayez notre questionnaire pour des recommandations personnalisees.',
                    'action' => 'start_questionnaire',
                    'trigger' => 'pain_point',
                ];
            }
        }

        // Based on intent
        switch ($intent) {
            case self::INTENT_CONFUSED:
                $recommendations[] = [
                    'type' => 'help',
                    'priority' => 90,
                    'message' => 'Besoin d\'aide pour trouver le bon professionnel ? Je peux vous guider.',
                    'action' => 'show_help',
                    'trigger' => 'confusion_detected',
                ];
                break;

            case self::INTENT_COMPARING:
                $recommendations[] = [
                    'type' => 'suggestion',
                    'priority' => 70,
                    'message' => 'Vous comparez plusieurs professionnels ? Consultez leurs specialites pour faire le bon choix.',
                    'action' => 'highlight_specialties',
                    'trigger' => 'comparing_behavior',
                ];
                break;

            case self::INTENT_DECIDING:
                $recommendations[] = [
                    'type' => 'action',
                    'priority' => 80,
                    'message' => 'Ce professionnel vous interesse ? N\'hesitez pas a le contacter.',
                    'action' => 'show_contact',
                    'trigger' => 'high_interest',
                ];
                break;

            case self::INTENT_LEAVING:
                $recommendations[] = [
                    'type' => 'retention',
                    'priority' => 95,
                    'message' => 'Avant de partir, avez-vous essaye notre questionnaire personnalise ?',
                    'action' => 'start_questionnaire',
                    'trigger' => 'exit_intent',
                ];
                break;
        }

        // Based on journey stage
        if ($stage === 'awareness' && $session->pages_viewed >= 2) {
            $recommendations[] = [
                'type' => 'guidance',
                'priority' => 60,
                'message' => 'Decouvrez comment nous pouvons vous aider a trouver le bon accompagnement.',
                'action' => 'show_how_it_works',
                'trigger' => 'new_visitor',
            ];
        }

        // Sort by priority and return top 3
        usort($recommendations, fn($a, $b) => $b['priority'] <=> $a['priority']);

        return array_slice($recommendations, 0, 3);
    }

    protected function suggestIntervention(array $signals, UserSession $session): ?array
    {
        if (empty($signals)) {
            return null;
        }

        $dominant = $this->getDominantSignal($signals);

        return match($dominant['type'] ?? null) {
            'frustrated' => [
                'type' => 'proactive_help',
                'message' => 'Je vois que vous cherchez quelque chose de precis. Puis-je vous aider ?',
                'actions' => [
                    ['label' => 'Oui, aidez-moi', 'action' => 'start_guided_search'],
                    ['label' => 'Non merci', 'action' => 'dismiss'],
                ],
            ],
            'confused' => [
                'type' => 'guidance',
                'message' => 'Notre questionnaire peut vous aider a trouver le professionnel ideal.',
                'actions' => [
                    ['label' => 'Essayer', 'action' => 'start_questionnaire'],
                ],
            ],
            'considering_action' => [
                'type' => 'encouragement',
                'message' => 'Pret a faire le premier pas ? Contactez ce professionnel.',
                'actions' => [
                    ['label' => 'Voir les coordonnees', 'action' => 'scroll_to_contact'],
                ],
            ],
            'highly_engaged' => [
                'type' => 'value_add',
                'message' => 'Ce professionnel semble correspondre a vos besoins !',
                'actions' => [
                    ['label' => 'Contacter', 'action' => 'show_contact'],
                    ['label' => 'Voir similaires', 'action' => 'show_similar'],
                ],
            ],
            default => null,
        };
    }

    protected function getDominantSignal(array $signals): ?array
    {
        if (empty($signals)) {
            return null;
        }

        usort($signals, fn($a, $b) => ($b['confidence'] ?? 0) <=> ($a['confidence'] ?? 0));

        return $signals[0];
    }

    protected function detectRapidEvents(Collection $events, int $windowSeconds): int
    {
        if ($events->count() < 2) {
            return 0;
        }

        $rapidCount = 0;
        $events = $events->sortBy('created_at')->values();

        for ($i = 1; $i < $events->count(); $i++) {
            $timeDiff = $events[$i]->created_at->diffInSeconds($events[$i - 1]->created_at);
            if ($timeDiff <= $windowSeconds) {
                $rapidCount++;
            }
        }

        return $rapidCount;
    }

    protected function getRecentEvents(UserSession $session, int $limit, int $minutes = 30): Collection
    {
        return $session->events()
            ->where('created_at', '>=', now()->subMinutes($minutes))
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }
}
