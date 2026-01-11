<div>
    <!-- Hero Section -->
    <section class="bg-ctm-burgundy py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl md:text-4xl text-white uppercase">
                Annuaire des professionnels
            </h1>
            <p class="mt-4 text-lg text-ctm-cream">
                Trouvez un professionnel specialise dans la phobie scolaire en Suisse romande
            </p>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input wire:model.live.debounce.300ms="search" type="text" id="search"
                               class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-ctm-teal focus:ring-ctm-teal text-sm"
                               placeholder="Nom, specialite...">
                    </div>
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categorie</label>
                    <select wire:model.live="categoryId" id="category"
                            class="block w-full py-3 px-4 rounded-xl border-gray-300 shadow-sm focus:border-ctm-teal focus:ring-ctm-teal text-sm">
                        <option value="">Toutes les categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="canton" class="block text-sm font-medium text-gray-700 mb-1">Canton</label>
                    <select wire:model.live="cantonId" id="canton"
                            class="block w-full py-3 px-4 rounded-xl border-gray-300 shadow-sm focus:border-ctm-teal focus:ring-ctm-teal text-sm">
                        <option value="">Tous les cantons</option>
                        @foreach($cantons as $canton)
                            <option value="{{ $canton->id }}">{{ $canton->name }} ({{ $canton->code }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="bg-ctm-cream py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($professionals->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <svg class="mx-auto w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Aucun professionnel trouve</h3>
                    <p class="mt-2 text-gray-500">Essayez de modifier vos criteres de recherche</p>
                </div>
            @else
                <div class="mb-6">
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold text-ctm-burgundy">{{ $professionals->total() }}</span> professionnel(s) trouve(s)
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($professionals as $professional)
                        <livewire:professional-card :professional="$professional" :key="$professional->id" />
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $professionals->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
