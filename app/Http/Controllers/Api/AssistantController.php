<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TrackingService;
use App\Services\RecommendationEngine;
use App\Services\NavigationHelper;
use App\Models\RecommendationRule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AssistantController extends Controller
{
    public function __construct(
        protected TrackingService $tracking,
        protected RecommendationEngine $engine,
        protected NavigationHelper $navigation
    ) {}

    public function getSuggestions(Request $request): JsonResponse
    {
        $session = $this->tracking->getOrCreateSession();
        $currentPage = $request->get('page', '/');

        $context = $this->engine->analyzeContext($session, $currentPage);
        $suggestions = $this->engine->getSuggestions($context);
        $nextAction = $this->engine->getNextBestAction($context);

        return response()->json([
            'suggestions' => $suggestions,
            'next_action' => $nextAction,
            'quick_actions' => $this->navigation->getQuickActions($session),
        ]);
    }

    public function getHints(Request $request): JsonResponse
    {
        $session = $this->tracking->getOrCreateSession();
        $currentPage = $request->get('page', '/');

        $context = $this->engine->analyzeContext($session, $currentPage);
        $hints = $this->engine->getContextualHints($currentPage, $context);

        return response()->json([
            'hints' => $hints,
        ]);
    }

    public function getNavigation(Request $request): JsonResponse
    {
        $session = $this->tracking->getOrCreateSession();
        $currentPage = $request->get('page', '/');

        return response()->json([
            'next_step' => $this->navigation->suggestNextStep($session),
            'breadcrumbs' => $this->navigation->getSmartBreadcrumbs($currentPage),
            'related_pages' => $this->navigation->getRelatedPages($currentPage),
        ]);
    }

    public function trackSuggestionClick(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'rule_id' => 'required|integer',
            'action' => 'required|string|max:50',
        ]);

        $rule = RecommendationRule::find($validated['rule_id']);
        if ($rule) {
            $rule->incrementClicked();
        }

        $this->tracking->logEvent(
            'suggestion_click',
            'assistant',
            $validated['action'],
            ['rule_id' => $validated['rule_id']]
        );

        return response()->json(['status' => 'ok']);
    }

    public function dismissSuggestion(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'suggestion_id' => 'required|string',
        ]);

        $this->tracking->logEvent(
            'suggestion_dismissed',
            'assistant',
            'dismissed',
            ['suggestion_id' => $validated['suggestion_id']]
        );

        // If user is logged in, save to preferences
        if ($user = auth()->user()) {
            $preferences = $user->preferences ?? $user->preferences()->create([]);
            $preferences->dismissSuggestion($validated['suggestion_id']);
        }

        return response()->json(['status' => 'ok']);
    }
}
