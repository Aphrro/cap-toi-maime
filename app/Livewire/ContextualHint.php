<?php

namespace App\Livewire;

use App\Services\TrackingService;
use App\Services\RecommendationEngine;
use Livewire\Component;

class ContextualHint extends Component
{
    public string $context;
    public array $params = [];
    public ?array $hint = null;
    public bool $dismissed = false;

    public function mount(string $context, array $params = [])
    {
        $this->context = $context;
        $this->params = $params;
        $this->loadHint();
    }

    public function loadHint()
    {
        if ($this->dismissed) {
            return;
        }

        $tracking = app(TrackingService::class);
        $engine = app(RecommendationEngine::class);

        $session = $tracking->getOrCreateSession();
        $baseContext = $engine->analyzeContext($session, request()->path());

        $fullContext = array_merge($baseContext, $this->params);
        $hints = $engine->getContextualHints($this->context, $fullContext);

        $this->hint = $hints[0] ?? null;
    }

    public function dismiss()
    {
        $this->dismissed = true;
        $this->hint = null;

        $tracking = app(TrackingService::class);
        $tracking->logEvent('inline_hint_dismissed', 'assistant', 'dismissed', [
            'context' => $this->context
        ]);
    }

    public function executeAction(string $action, int $ruleId = 0)
    {
        $tracking = app(TrackingService::class);
        $tracking->logEvent('inline_hint_action', 'assistant', $action, [
            'context' => $this->context,
            'rule_id' => $ruleId
        ]);

        if ($ruleId) {
            $rule = \App\Models\RecommendationRule::find($ruleId);
            if ($rule) {
                $rule->incrementClicked();
            }
        }

        // Dispatch action to parent components
        $this->dispatch($action);
    }

    public function render()
    {
        return view('livewire.contextual-hint');
    }
}
