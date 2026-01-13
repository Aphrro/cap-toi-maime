<?php

namespace App\Livewire;

use App\Services\TrackingService;
use App\Services\BehaviorAnalyzer;
use App\Services\NavigationHelper;
use Livewire\Component;
use Livewire\Attributes\On;

class AssistantWidget extends Component
{
    public bool $isOpen = false;
    public bool $isMinimized = false;
    public array $currentMessage = [];
    public array $suggestions = [];
    public array $quickActions = [];
    public string $currentPage = '';
    public string $userIntent = 'browsing';
    public string $engagementLevel = 'low';
    public bool $showProactiveHelp = false;
    public int $proactiveHelpDelay = 0;

    // Behavior tracking
    public int $frustrationLevel = 0;
    public bool $exitIntentDetected = false;
    public bool $userIdle = false;

    protected $listeners = [
        'behaviorUpdate' => 'handleBehaviorUpdate',
        'userFrustrated' => 'handleFrustration',
        'userExitIntent' => 'handleExitIntent',
        'userIdle' => 'handleIdle',
        'searchNoResults' => 'handleNoResults',
    ];

    public function mount()
    {
        $this->currentPage = request()->path();
        $this->analyzeAndSuggest();
    }

    public function analyzeAndSuggest()
    {
        $tracking = app(TrackingService::class);
        $analyzer = app(BehaviorAnalyzer::class);
        $navigation = app(NavigationHelper::class);

        $session = $tracking->getOrCreateSession();
        $analysis = $analyzer->analyzeSession($session);

        $this->userIntent = $analysis['intent'];
        $this->engagementLevel = $analysis['engagement']['level'];
        $this->frustrationLevel = $analysis['frustration_level']['score'] ?? 0;

        // Get smart recommendations
        $this->suggestions = $analysis['recommendations'];

        // Check if proactive help is needed
        $assistance = $analysis['assistance_needed'];
        if ($assistance['needs_help'] && !$this->isMinimized) {
            $this->showProactiveHelp = true;
            $this->currentMessage = $this->buildProactiveMessage($assistance, $analysis);
        }

        // Get quick actions based on journey stage
        $this->quickActions = $navigation->getQuickActions($session);
    }

    #[On('behavior-update')]
    public function handleBehaviorUpdate(array $data = [])
    {
        // Skip if no data
        if (empty($data)) {
            return;
        }

        // Real-time behavior analysis from JavaScript
        $tracking = app(TrackingService::class);
        $analyzer = app(BehaviorAnalyzer::class);

        $session = $tracking->getOrCreateSession();
        $realTimeAnalysis = $analyzer->analyzeRealTimeBehavior($data, $session);

        // Check if intervention is needed
        if ($realTimeAnalysis['suggested_intervention'] && !$this->isMinimized) {
            $this->showProactiveHelp = true;
            $this->currentMessage = $realTimeAnalysis['suggested_intervention'];
        }

        // Update intent if dominant signal is strong
        if ($realTimeAnalysis['dominant_signal']) {
            $signalType = $realTimeAnalysis['dominant_signal']['type'];
            $confidence = $realTimeAnalysis['dominant_signal']['confidence'];

            if ($confidence >= 0.7) {
                $this->handleSignal($signalType);
            }
        }
    }

    protected function handleSignal(string $signalType)
    {
        switch ($signalType) {
            case 'frustrated':
                $this->handleFrustration();
                break;
            case 'confused':
                $this->showHelpMessage(
                    'Je vois que vous cherchez quelque chose. Puis-je vous aider ?',
                    [
                        ['label' => 'Questionnaire guide', 'action' => 'start_questionnaire'],
                        ['label' => 'Voir l\'annuaire', 'action' => 'browse_directory'],
                    ]
                );
                break;
            case 'considering_action':
                $this->showHelpMessage(
                    'Pret a passer a l\'action ?',
                    [
                        ['label' => 'Contacter', 'action' => 'scroll_to_contact'],
                    ]
                );
                break;
            case 'highly_engaged':
                // Don't interrupt highly engaged users
                $this->showProactiveHelp = false;
                break;
        }
    }

    #[On('user-frustrated')]
    public function handleFrustration()
    {
        $this->frustrationLevel++;

        if ($this->frustrationLevel >= 2 && !$this->isMinimized) {
            $this->showHelpMessage(
                'Vous semblez rencontrer des difficultes. Comment puis-je vous aider ?',
                [
                    ['label' => 'Recommencer', 'action' => 'clear_filters'],
                    ['label' => 'Questionnaire', 'action' => 'start_questionnaire'],
                    ['label' => 'Contacter', 'action' => 'contact'],
                ]
            );
        }
    }

    #[On('user-exit-intent')]
    public function handleExitIntent()
    {
        $this->exitIntentDetected = true;

        if (!$this->isMinimized) {
            $tracking = app(TrackingService::class);
            $session = $tracking->getOrCreateSession();

            // Different messages based on user progress
            if (!$session->questionnaire_completed && $session->professionals_viewed === 0) {
                $this->showHelpMessage(
                    'Avant de partir, essayez notre questionnaire gratuit pour trouver le professionnel ideal !',
                    [
                        ['label' => 'Essayer (2 min)', 'action' => 'start_questionnaire'],
                    ],
                    'retention'
                );
            } elseif ($session->professionals_viewed > 0 && !$session->contact_initiated) {
                $this->showHelpMessage(
                    'Vous avez consulte des profils interessants. Souhaitez-vous sauvegarder vos recherches ?',
                    [
                        ['label' => 'Revoir les profils', 'action' => 'browse_directory'],
                    ],
                    'retention'
                );
            }
        }
    }

    #[On('user-idle')]
    public function handleIdle()
    {
        $this->userIdle = true;

        if (!$this->isMinimized && !$this->isOpen) {
            $this->showHelpMessage(
                'Besoin d\'aide pour trouver un professionnel ?',
                [
                    ['label' => 'Oui', 'action' => 'start_questionnaire'],
                    ['label' => 'Je regarde', 'action' => 'dismiss'],
                ]
            );
        }
    }

    #[On('search-no-results')]
    public function handleNoResults(array $data = [])
    {
        $this->showHelpMessage(
            'Aucun resultat pour cette recherche. Essayez d\'elargir vos criteres ou utilisez notre questionnaire.',
            [
                ['label' => 'Questionnaire', 'action' => 'start_questionnaire'],
                ['label' => 'Reinitialiser', 'action' => 'clear_filters'],
                ['label' => 'Activer visio', 'action' => 'enable_visio'],
            ],
            'help'
        );
    }

    protected function showHelpMessage(string $message, array $actions = [], string $type = 'suggestion')
    {
        $this->showProactiveHelp = true;
        $this->currentMessage = [
            'type' => $type,
            'message' => $message,
            'actions' => $actions,
        ];
    }

    protected function buildProactiveMessage(array $assistance, array $analysis): array
    {
        $reasons = $assistance['reasons'] ?? [];
        $urgency = $assistance['urgency'];

        // Choose message based on reason
        $message = 'Comment puis-je vous aider ?';
        $actions = [];

        if (in_array('User appears frustrated', $reasons)) {
            $message = 'Je vois que vous cherchez quelque chose de precis. Puis-je vous guider ?';
            $actions = [
                ['label' => 'Oui', 'action' => 'start_guided_search'],
                ['label' => 'Non merci', 'action' => 'dismiss'],
            ];
        } elseif (in_array('Search returned no results', $reasons)) {
            $message = 'Pas de resultats ? Essayons une autre approche.';
            $actions = [
                ['label' => 'Questionnaire', 'action' => 'start_questionnaire'],
                ['label' => 'Elargir recherche', 'action' => 'clear_filters'],
            ];
        } elseif (in_array('User seems stuck on current page', $reasons)) {
            $message = 'Besoin d\'informations supplementaires ?';
            $actions = [
                ['label' => 'FAQ', 'action' => 'show_faq'],
                ['label' => 'Contact', 'action' => 'contact'],
            ];
        } elseif (in_array('New user may need orientation', $reasons)) {
            $message = 'Premiere visite ? Laissez-moi vous guider.';
            $actions = [
                ['label' => 'Commencer', 'action' => 'start_questionnaire'],
                ['label' => 'Explorer', 'action' => 'browse_directory'],
            ];
        }

        return [
            'type' => $urgency === 'high' ? 'urgent' : 'suggestion',
            'message' => $message,
            'actions' => $actions,
        ];
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
        $this->showProactiveHelp = false;

        if ($this->isOpen) {
            $this->analyzeAndSuggest();
        }
    }

    public function minimize()
    {
        $this->isMinimized = true;
        $this->isOpen = false;
        $this->showProactiveHelp = false;
    }

    public function restore()
    {
        $this->isMinimized = false;
    }

    public function dismissProactiveHelp()
    {
        $this->showProactiveHelp = false;
        $this->currentMessage = [];

        app(TrackingService::class)->logEvent(
            'assistant_dismissed',
            'assistant',
            'proactive_help_dismissed'
        );
    }

    public function executeAction(string $action)
    {
        app(TrackingService::class)->logEvent(
            'assistant_action',
            'assistant',
            $action
        );

        $this->showProactiveHelp = false;

        match ($action) {
            'start_questionnaire', 'start_guided_search' => $this->redirect(route('questionnaire')),
            'browse_directory' => $this->redirect(route('annuaire')),
            'show_faq' => $this->redirect(route('faq')),
            'contact' => $this->redirect(route('contact')),
            'scroll_to_contact' => $this->dispatch('scroll-to', selector: '#contact-section'),
            'enable_visio' => $this->dispatch('enable-filter', filter: 'visio'),
            'clear_filters' => $this->dispatch('clear-filters'),
            'show_similar' => $this->dispatch('show-similar'),
            'dismiss' => $this->dismissProactiveHelp(),
            default => null,
        };
    }

    public function render()
    {
        return view('livewire.assistant-widget');
    }
}
