<div>
    <!-- Hero Section -->
    <section class="bg-cap-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl md:text-4xl text-white uppercase tracking-wide">
                Annuaire des professionnels
            </h1>
            <p class="mt-4 text-lg text-cap-100">
                Trouvez un professionnel spécialise dans l'accompagnément des jeunes en phobie scolaire en Suisse romande
            </p>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="bg-white shadow-md py-6 px-4 -mt-6 mx-4 md:mx-auto max-w-5xl rounded-lg relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search"
                           class="block w-full pl-10 pr-4 py-2 rounded-lg border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900 text-sm"
                           placeholder="Nom, spécialité...">
                </div>
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                <select wire:model.live="categoryId" id="category"
                        class="block w-full py-2 px-3 rounded-lg border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900 text-sm">
                    <option value="">Toutes les catégories</option>
                    @foreach($catégories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="canton" class="block text-sm font-medium text-gray-700 mb-1">Canton</label>
                <select wire:model.live="cantonId" id="canton"
                        class="block w-full py-2 px-3 rounded-lg border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900 text-sm">
                    <option value="">Tous les cantons</option>
                    @foreach($cantons as $canton)
                        <option value="{{ $canton->id }}">{{ $canton->name }} ({{ $canton->code }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Filtre par spécialité -->
        @if($spécialtiesFilter && $spécialtiesFilter->count() > 0)
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Spécialités</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($spécialtiesFilter as $spec)
                        <button
                            wire:click="toggleSpécialty({{ $spec->id }})"
                            class="px-3 py-1 rounded-full text-sm transition-colors
                                {{ in_array($spec->id, $selectedSpécialties)
                                    ? 'bg-cap-900 text-white'
                                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                        >
                            {{ $spec->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Filtre par remboursements -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Remboursements acceptes</label>
            <div class="flex flex-wrap gap-2">
                @foreach($reimbursementOptions as $code => $label)
                    <button
                        wire:click="toggleReimbursement('{{ $code }}')"
                        class="px-3 py-1 rounded-full text-sm transition-colors
                            {{ in_array($code, $selectedReimbursements)
                                ? 'bg-blue-600 text-white'
                                : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($professionals->isEmpty())
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <svg class="mx-auto w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun professionnel trouve</h3>
                    <p class="mt-2 text-gray-500">Essayez de modifiér vos critères de recherche</p>
                </div>
            @else
                <div class="mb-6">
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold text-cap-900">{{ $professionals->total() }}</span> professionnel(s) trouve(s)
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($professionals as $professional)
                        <a href="{{ route('professional.show', $professional) }}" class="block">
                            <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-6">
                                <div class="flex items-start space-x-4">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        @if($professional->getFirstMediaUrl('avatar'))
                                            <img
                                                src="{{ $professional->getFirstMediaUrl('avatar') }}"
                                                alt="{{ $professional->full_name }}"
                                                class="h-16 w-16 rounded-full object-cover"
                                            >
                                        @else
                                            <div class="h-16 w-16 rounded-full bg-cap-100 flex items-center justify-center">
                                                <span class="text-cap-900 font-semibold text-xl">
                                                    {{ substr($professional->first_name, 0, 1) }}{{ substr($professional->last_name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Infos -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900 truncate">
                                            {{ $professional->full_name }}
                                        </h3>
                                        <p class="text-cap-900 font-medium">
                                            {{ $professional->category->name }}
                                        </p>
                                        @if($professional->city)
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ $professional->city->name }}, {{ $professional->city->canton->code }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Spécialités -->
                                @if($professional->spécialties && $professional->spécialties->isNotEmpty())
                                    <div class="mt-4 flex flex-wrap gap-1">
                                        @foreach($professional->spécialties->take(3) as $spécialty)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-cap-100 text-cap-900">
                                                {{ $spécialty->name }}
                                            </span>
                                        @endforeach
                                        @if($professional->spécialties->count() > 3)
                                            <span class="text-xs text-gray-500">+{{ $professional->spécialties->count() - 3 }}</span>
                                        @endif
                                    </div>
                                @endif

                                <!-- Badge vérifié -->
                                @if($professional->is_vérifiéd)
                                    <div class="mt-3 flex items-center text-green-600 text-sm">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Professionnel vérifié
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $professionals->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
