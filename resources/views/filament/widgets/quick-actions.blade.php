<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            ⚡ Actions rapides
        </x-slot>

        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('filament.admin.resources.professionals.create') }}"
               class="flex flex-col items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition">
                <x-heroicon-o-user-plus class="w-6 h-6 text-blue-500 mb-2"/>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Ajouter pro</span>
            </a>

            <a href="{{ route('filament.admin.resources.events.create') }}"
               class="flex flex-col items-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/40 transition">
                <x-heroicon-o-calendar-days class="w-6 h-6 text-green-500 mb-2"/>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Créer événement</span>
            </a>

            <a href="{{ route('filament.admin.resources.pages.index') }}"
               class="flex flex-col items-center p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg hover:bg-amber-100 dark:hover:bg-amber-900/40 transition">
                <x-heroicon-o-document-text class="w-6 h-6 text-amber-500 mb-2"/>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Gérer pages</span>
            </a>

            <a href="{{ route('filament.admin.resources.faqs.create') }}"
               class="flex flex-col items-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/40 transition">
                <x-heroicon-o-question-mark-circle class="w-6 h-6 text-purple-500 mb-2"/>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Ajouter FAQ</span>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
