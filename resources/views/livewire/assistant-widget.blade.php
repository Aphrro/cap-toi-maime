<div
    class="fixed bottom-6 right-6 z-50"
    x-data="{
        open: @entangle('isOpen'),
        minimized: @entangle('isMinimized'),
        showProactive: @entangle('showProactiveHelp')
    }"
    x-init="
        // Listen to behavior events from JavaScript
        window.addEventListener('user-frustrated', () => $wire.handleFrustration());
        window.addEventListener('user-exit-intent', () => $wire.handleExitIntent());
        window.addEventListener('user-idle', () => $wire.handleIdle());
        window.addEventListener('search-no-results', (e) => $wire.handleNoResults(e.detail));
        window.addEventListener('behavior-update', (e) => $wire.handleBehaviorUpdate(e.detail));
    "
>
    {{-- Minimized state --}}
    @if($isMinimized)
        <button
            wire:click="restore"
            class="w-10 h-10 bg-gray-200 hover:bg-gray-300 text-gray-600 rounded-full shadow flex items-center justify-center transition-all"
            title="Restaurer l'assistant"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </button>
    @else
        {{-- Proactive Help Bubble --}}
        @if($showProactiveHelp && !empty($currentMessage) && !$isOpen)
            <div
                class="absolute bottom-16 right-0 w-80 bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            >
                {{-- Header with type indicator --}}
                <div class="px-4 py-3 {{ $currentMessage['type'] === 'urgent' ? 'bg-ctm-burgundy' : ($currentMessage['type'] === 'retention' ? 'bg-amber-500' : 'bg-ctm-teal') }} text-white flex items-center justify-between">
                    <div class="flex items-center">
                        @if($currentMessage['type'] === 'urgent')
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        @elseif($currentMessage['type'] === 'retention')
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        @endif
                        <span class="font-medium text-sm">Assistant</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <button wire:click="minimize" class="p-1 hover:bg-white/20 rounded transition-colors" title="Minimiser">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </button>
                        <button wire:click="dismissProactiveHelp" class="p-1 hover:bg-white/20 rounded transition-colors" title="Fermer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Message --}}
                <div class="p-4">
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $currentMessage['message'] ?? '' }}</p>

                    @if(!empty($currentMessage['actions']))
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($currentMessage['actions'] as $action)
                                <button
                                    wire:click="executeAction('{{ $action['action'] }}')"
                                    class="px-4 py-2 text-sm font-medium rounded-full transition-all
                                        {{ $loop->first ? 'bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}"
                                >
                                    {{ $action['label'] }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Main Panel (when opened) --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="absolute bottom-16 right-0 w-80 bg-white rounded-2xl shadow-2xl overflow-hidden"
            x-cloak
        >
            {{-- Header --}}
            <div class="bg-gradient-to-r from-ctm-burgundy to-ctm-burgundy-dark text-white p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg">Assistant</h3>
                        <p class="text-sm text-white/80">
                            @if($userIntent === 'confused')
                                Je suis la pour vous aider
                            @elseif($userIntent === 'searching')
                                Recherche en cours...
                            @elseif($userIntent === 'comparing')
                                Bonne comparaison !
                            @elseif($userIntent === 'deciding')
                                Pret a vous decider ?
                            @else
                                Comment puis-je vous aider ?
                            @endif
                        </p>
                    </div>
                    <button wire:click="minimize" class="p-1 hover:bg-white/20 rounded transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                    </button>
                </div>

                {{-- Engagement indicator --}}
                <div class="mt-3 flex items-center space-x-2">
                    <span class="text-xs text-white/60">Engagement:</span>
                    <div class="flex-1 h-1.5 bg-white/20 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500 {{ $engagementLevel === 'high' ? 'bg-green-400 w-full' : ($engagementLevel === 'medium' ? 'bg-yellow-400 w-2/3' : 'bg-red-400 w-1/3') }}"></div>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-4 max-h-80 overflow-y-auto">
                {{-- Smart Suggestions --}}
                @if(!empty($suggestions))
                    <div class="space-y-3">
                        @foreach($suggestions as $suggestion)
                            <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-ctm-teal/30 transition-colors">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0
                                        {{ $suggestion['type'] === 'action' ? 'bg-ctm-burgundy/10' : 'bg-ctm-teal/10' }}">
                                        @if($suggestion['trigger'] === 'pain_point')
                                            <svg class="w-4 h-4 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                        @elseif($suggestion['trigger'] === 'confusion_detected')
                                            <svg class="w-4 h-4 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-700">{{ $suggestion['message'] }}</p>
                                        @if($suggestion['action'])
                                            <button
                                                wire:click="executeAction('{{ $suggestion['action'] }}')"
                                                class="mt-2 text-xs text-ctm-teal hover:text-ctm-teal-dark font-medium"
                                            >
                                                En savoir plus →
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <div class="w-12 h-12 bg-ctm-teal/10 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm">
                            Tout va bien ! Continuez votre exploration.
                        </p>
                    </div>
                @endif

                {{-- Quick Actions --}}
                <div class="border-t border-gray-100 pt-4 mt-4">
                    <p class="text-xs text-gray-500 mb-3 font-medium uppercase tracking-wide">Actions rapides</p>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($quickActions as $action)
                            <a
                                href="{{ $action['url'] }}"
                                class="text-xs p-2.5 rounded-lg transition-colors flex items-center justify-center
                                    {{ $action['color'] === 'burgundy' ? 'bg-ctm-burgundy/10 text-ctm-burgundy hover:bg-ctm-burgundy hover:text-white' : '' }}
                                    {{ $action['color'] === 'teal' ? 'bg-ctm-teal/10 text-ctm-teal hover:bg-ctm-teal hover:text-white' : '' }}
                                    {{ $action['color'] === 'gray' ? 'bg-gray-100 text-gray-700 hover:bg-gray-200' : '' }}"
                                wire:navigate
                            >
                                @if($action['icon'] === 'clipboard-list')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                @elseif($action['icon'] === 'search')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                @elseif($action['icon'] === 'question-mark-circle')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @elseif($action['icon'] === 'mail')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                @endif
                                {{ $action['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Floating Button --}}
        <button
            wire:click="toggle"
            class="w-14 h-14 rounded-full shadow-lg flex items-center justify-center transition-all hover:scale-105 hover:shadow-xl
                {{ $showProactiveHelp ? 'bg-ctm-burgundy animate-pulse' : 'bg-ctm-burgundy hover:bg-ctm-burgundy-dark' }} text-white"
            aria-label="Ouvrir l'assistant"
        >
            <svg
                x-show="!open"
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <svg
                x-show="open"
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                x-cloak
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>

            {{-- Notification dot when proactive help is available --}}
            @if($showProactiveHelp && !$isOpen)
                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-white"></span>
            @endif
        </button>
    @endif
</div>
