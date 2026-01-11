<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Annuaire des professionnels</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Trouvez un professionnel specialise dans la phobie scolaire en Suisse romande</p>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rechercher</label>
                            <input wire:model.live.debounce.300ms="search" type="text" id="search"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
                                   placeholder="Nom, prenom, titre...">
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categorie</label>
                            <select wire:model.live="categoryId" id="category"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                                <option value="">Toutes les categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="canton" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Canton</label>
                            <select wire:model.live="cantonId" id="canton"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                                <option value="">Tous les cantons</option>
                                @foreach($cantons as $canton)
                                    <option value="{{ $canton->id }}">{{ $canton->name }} ({{ $canton->code }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results -->
            @if($professionals->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <p class="text-gray-500 dark:text-gray-400">Aucun professionnel trouve.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($professionals as $professional)
                        <livewire:professional-card :professional="$professional" :key="$professional->id" />
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $professionals->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
