<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            🗓️ Prochains événements
        </x-slot>

        <div class="space-y-3">
            @forelse($this->getEvents() as $event)
                <a href="{{ route('filament.admin.resources.events.edit', $event) }}"
                   class="block p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <p class="font-medium text-gray-900 dark:text-white">{{ $event->title }}</p>
                    <p class="text-sm text-gray-500">{{ $event->start_date->format('d/m/Y à H:i') }}</p>
                    @if($event->location)
                        <p class="text-xs text-gray-400">📍 {{ $event->location }}</p>
                    @endif
                </a>
            @empty
                <p class="text-sm text-gray-500 text-center py-4">Aucun événement à venir</p>
            @endforelse
        </div>

        <div class="mt-4">
            <a href="{{ route('filament.admin.resources.events.create') }}"
               class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                + Créer un événement
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
