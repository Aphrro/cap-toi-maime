<?php

namespace App\Livewire;

use App\Services\TrackingService;
use App\Services\RecommendationEngine;
use App\Services\NavigationHelper;
use Livewire\Component;
use Livewire\Attributes\On;

class AssistantWidget extends Component
{
    public bool $isOpen = false;
    public array $suggestions = [];
    public ?array $currentHint = null;
    public ?array $nextAction = null;
    public array $quickActions = [];
    public string $currentPage = '';
    public bool $hintDismissed = false;

    public function mount()
    {
        $this->currentPage = request()->path();
        $this->loadSuggestions();
    }

    public function loadSuggestions()
    {
        $tracking = app(TrackingService::class);
        $engine = app(RecommendationEngine::class);
        $navigation = app(NavigationHelper::class);

        $session = $tracking->getOrCreateSession();
        $context = $engine->analyzeContext($session, $this->currentPage);

        $this->suggestions = $engine->getSuggestions($context)->toArray();
        $this->nextAction = $engine->getNextBestAction($context);
        $this->quickActions = $navigation->getQuickActions($session);

        // Get contextual hint if not dismissed
        if (!$this->hintDismissed) {
            $hints = $engine->getContextualHints($this->currentPage, $context);
            $this->currentHint = $hints[0] ?? null;
        }
    }

    #[On('page-changed')]
    public function updateContext(string $page)
    {
        $this->currentPage = $page;
        $this->hintDismissed = false;
        $this->loadSuggestions();
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;

        if ($this->isOpen) {
            $this->loadSuggestions();
        }
    }

    public function dismissHint()
    {
        $this->hintDismissed = true;
        $this->currentHint = null;

        $tracking = app(TrackingService::class);
        $tracking->logEvent('hint_dismissed', 'assistant', 'dismissed', [
            'page' => $this->currentPage
        ]);
    }

    public function dismissSuggestion(int $index)
    {
        if (isset($this->suggestions[$index])) {
            $suggestion = $this->suggestions[$index];

            $tracking = app(TrackingService::class);
            $tracking->logEvent('suggestion_dismissed', 'assistant', 'dismissed', [
                'suggestion_id' => $suggestion['id'] ?? 'unknown'
            ]);

            unset($this->suggestions[$index]);
            $this->suggestions = array_values($this->suggestions);
        }
    }

    public function executeAction(string $action, array $params = [])
    {
        $tracking = app(TrackingService::class);
        $tracking->logEvent('action_executed', 'assistant', $action, $params);

        // Handle different actions
        match ($action) {
            'start_questionnaire' => $this->redirect(route('questionnaire')),
            'browse_directory' => $this->redirect(route('annuaire')),
            'show_faq' => $this->redirect(route('faq')),
            'contact' => $this->redirect(route('contact')),
            'view_results' => $this->redirect(route('results')),
            'scroll_to_contact' => $this->dispatch('scroll-to', selector: '#contact-section'),
            'enable_visio' => $this->dispatch('enable-filter', filter: 'visio'),
            'clear_filters' => $this->dispatch('clear-filters'),
            'show_similar' => $this->dispatch('show-similar'),
            'dismiss' => $this->isOpen = false,
            default => null,
        };
    }

    public function trackSuggestionClick(int $ruleId, string $action)
    {
        $tracking = app(TrackingService::class);
        $tracking->logEvent('suggestion_clicked', 'assistant', $action, [
            'rule_id' => $ruleId
        ]);

        // Increment rule click count
        $rule = \App\Models\RecommendationRule::find($ruleId);
        if ($rule) {
            $rule->incrementClicked();
        }

        $this->executeAction($action);
    }

    public function render()
    {
        return view('livewire.assistant-widget');
    }
}
