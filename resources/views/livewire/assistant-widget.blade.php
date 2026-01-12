<div class="fixed bottom-6 right-6 z-50" x-data="{ open: @entangle('isOpen') }">
    {{-- Contextual Hint Bubble --}}
    @if($currentHint && !$isOpen)
        <div
            class="absolute bottom-16 right-0 w-72 bg-white rounded-xl shadow-lg p-4 mb-2 border border-gray-100"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
        >
            <button
                wire:click="dismissHint"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="flex items-start">
                <div class="w-8 h-8 bg-ctm-teal/10 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                    <svg class="w-4 h-4 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <p class="text-sm text-gray-700 pr-4">{{ $currentHint['message'] }}</p>
            </div>

            @if(!empty($currentHint['actions']))
                <div class="mt-3 flex gap-2 ml-11">
                    @foreach($currentHint['actions'] as $action)
                        <button
                            wire:click="trackSuggestionClick({{ $currentHint['id'] ?? 0 }}, '{{ $action['action'] }}')"
                            class="text-xs bg-ctm-teal hover:bg-ctm-teal-dark text-white px-3 py-1.5 rounded-full transition-colors"
                        >
                            {{ $action['label'] }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    {{-- Main Panel --}}
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
            <h3 class="font-bold text-lg">Assistant Cap Toi M'aime</h3>
            <p class="text-sm text-white/80">Comment puis-je vous aider ?</p>
        </div>

        {{-- Content --}}
        <div class="p-4 max-h-96 overflow-y-auto">
            {{-- Next Best Action --}}
            @if($nextAction && $nextAction['priority'] === 'high')
                <div class="mb-4 p-3 bg-ctm-burgundy/5 border border-ctm-burgundy/20 rounded-xl">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-ctm-burgundy mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span class="text-sm font-semibold text-ctm-burgundy">Suggestion</span>
                    </div>
                    <p class="text-sm text-gray-700 mb-3">{{ $nextAction['message'] }}</p>
                    <button
                        wire:click="executeAction('{{ $nextAction['action'] }}')"
                        class="w-full text-sm bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white py-2 px-4 rounded-lg transition-colors"
                    >
                        Continuer
                    </button>
                </div>
            @endif

            {{-- Suggestions --}}
            @forelse($suggestions as $index => $suggestion)
                <div class="mb-3 p-3 bg-gray-50 rounded-xl relative group">
                    <button
                        wire:click="dismissSuggestion({{ $index }})"
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 opacity-0 group-hover:opacity-100 transition-opacity"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <p class="text-sm text-gray-700 pr-6">{{ $suggestion['message'] }}</p>

                    @if(!empty($suggestion['actions']))
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($suggestion['actions'] as $action)
                                <button
                                    wire:click="trackSuggestionClick({{ $suggestion['id'] ?? 0 }}, '{{ $action['action'] }}')"
                                    class="text-xs bg-ctm-teal/10 text-ctm-teal px-3 py-1.5 rounded-full hover:bg-ctm-teal hover:text-white transition-colors"
                                >
                                    {{ $action['label'] }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-6">
                    <div class="w-12 h-12 bg-ctm-teal/10 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm">
                        Explorez le site, je vous guiderai si besoin !
                    </p>
                </div>
            @endforelse

            {{-- Quick Actions --}}
            <div class="border-t border-gray-100 pt-3 mt-3">
                <p class="text-xs text-gray-500 mb-2 font-medium uppercase tracking-wide">Actions rapides</p>
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
        class="w-14 h-14 bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white rounded-full shadow-lg flex items-center justify-center transition-all hover:scale-105 hover:shadow-xl"
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
    </button>
</div>
