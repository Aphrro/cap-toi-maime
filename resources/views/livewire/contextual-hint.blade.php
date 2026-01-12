@if($hint && !$dismissed)
<div
    class="bg-ctm-teal/5 border border-ctm-teal/20 rounded-xl p-4 mb-4"
    x-data="{ show: true }"
    x-show="show"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div class="flex items-start">
        <div class="w-8 h-8 bg-ctm-teal/10 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
            @if(($hint['icon'] ?? 'info') === 'lightbulb')
                <svg class="w-4 h-4 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            @else
                <svg class="w-4 h-4 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            @endif
        </div>

        <div class="flex-1">
            <p class="text-sm text-gray-700">{{ $hint['message'] }}</p>

            @if(!empty($hint['actions']))
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($hint['actions'] as $action)
                        <button
                            wire:click="executeAction('{{ $action['action'] }}', {{ $hint['id'] ?? 0 }})"
                            class="text-xs bg-ctm-teal text-white px-3 py-1.5 rounded-full hover:bg-ctm-teal-dark transition-colors"
                        >
                            {{ $action['label'] }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <button
            wire:click="dismiss"
            @click="show = false"
            class="text-gray-400 hover:text-gray-600 transition-colors ml-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endif
