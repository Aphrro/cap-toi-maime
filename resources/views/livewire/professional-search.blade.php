<div>
    <!-- Hero Section -->
    <section class="bg-cap-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl md:text-4xl text-white uppercase tracking-wide">
                Annuaire des professionnels
            </h1>
            <p class="mt-4 text-lg text-cap-100">
                Trouvez un professionnel specialise dans l'accompagnement des jeunes en phobie scolaire en Suisse romande
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
                           placeholder="Nom, specialite...">
                </div>
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categorie</label>
                <select wire:model.live="categoryId" id="category"
                        class="block w-full py-2 px-3 rounded-lg border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900 text-sm">
                    <option value="">Toutes les categories</option>
                    @foreach($categories as $category)
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

        <!-- Filtre par specialite (max 12 + Voir plus) -->
        @if($specialtiesFilter && $specialtiesFilter->count() > 0)
            <div class="mt-4" x-data="{ showAll: false }">
                <label class="block text-sm font-medium text-gray-700 mb-2">Specialites</label>
                <div class="flex flex-wrap gap-2">
                    {{-- 12 premiers tags toujours visibles --}}
                    @foreach($specialtiesFilter->take(12) as $spec)
                        <button
                            wire:click="toggleSpecialty({{ $spec->id }})"
                            class="px-3 py-1 rounded-full text-sm border transition-colors
                                {{ in_array($spec->id, $selectedSpecialties)
                                    ? 'bg-cap-900 text-white border-cap-900'
                                    : 'bg-white text-gray-700 border-gray-300 hover:border-cap-500' }}"
                        >
                            {{ $spec->name }}
                        </button>
                    @endforeach

                    {{-- Tags supplementaires (caches par defaut) --}}
                    @if($specialtiesFilter->count() > 12)
                        <template x-if="showAll">
                            <div class="contents">
                                @foreach($specialtiesFilter->skip(12) as $spec)
                                    <button
                                        wire:click="toggleSpecialty({{ $spec->id }})"
                                        class="px-3 py-1 rounded-full text-sm border transition-colors
                                            {{ in_array($spec->id, $selectedSpecialties)
                                                ? 'bg-cap-900 text-white border-cap-900'
                                                : 'bg-white text-gray-700 border-gray-300 hover:border-cap-500' }}"
                                    >
                                        {{ $spec->name }}
                                    </button>
                                @endforeach
                            </div>
                        </template>

                        {{-- Bouton Voir plus / Voir moins --}}
                        <button
                            @click="showAll = !showAll"
                            class="px-3 py-1 rounded-full text-sm text-cap-900 border border-cap-300 hover:bg-cap-50 transition"
                        >
                            <span x-show="!showAll">Voir plus (+{{ $specialtiesFilter->count() - 12 }})</span>
                            <span x-show="showAll">Voir moins</span>
                        </button>
                    @endif
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
                    <p class="mt-2 text-gray-500">Essayez de modifier vos criteres de recherche</p>
                </div>
            @else
                {{-- Barre de resultats avec tri --}}
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">
                        <span class="font-semibold text-cap-900">{{ $professionals->total() }}</span> professionnel(s) trouve(s)
                    </p>

                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-600">Trier par :</label>
                        <select
                            wire:model.live="sortBy"
                            class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:ring-2 focus:ring-cap-500"
                        >
                            <option value="name">Nom</option>
                            <option value="canton">Canton</option>
                            <option value="verified">Verifie en premier</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($professionals as $professional)
                        <a href="{{ route('professional.show', $professional) }}" class="block">
                            <div class="bg-white rounded-xl p-5 border border-gray-200 hover:shadow-lg transition">
                                <div class="flex items-start gap-4">
                                    {{-- Avatar --}}
                                    <div class="flex-shrink-0">
                                        @if($professional->profile_photo)
                                            <img
                                                src="{{ Storage::url($professional->profile_photo) }}"
                                                class="w-14 h-14 rounded-full object-cover"
                                                alt="{{ $professional->full_name }}"
                                            >
                                        @elseif($professional->getFirstMediaUrl('avatar'))
                                            <img
                                                src="{{ $professional->getFirstMediaUrl('avatar') }}"
                                                class="w-14 h-14 rounded-full object-cover"
                                                alt="{{ $professional->full_name }}"
                                            >
                                        @else
                                            <div class="w-14 h-14 bg-cap-100 rounded-full flex items-center justify-center">
                                                <span class="text-cap-900 font-bold text-lg">
                                                    {{ substr($professional->first_name, 0, 1) }}{{ substr($professional->last_name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Infos --}}
                                    <div class="flex-1 min-w-0">
                                        {{-- Nom + Badge verifie --}}
                                        <div class="flex items-center gap-2">
                                            <h3 class="font-semibold text-gray-900 truncate">{{ $professional->full_name }}</h3>

                                            @if($professional->is_verified)
                                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor" title="Verifie">
                                                    <path d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.491 4.491 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" />
                                                </svg>
                                            @endif
                                        </div>

                                        {{-- Profession --}}
                                        <p class="text-cap-900 font-medium text-sm">{{ $professional->category->name }}</p>

                                        {{-- Localisation --}}
                                        <p class="text-gray-500 text-sm">📍 {{ $professional->city?->name }}, {{ $professional->city?->canton?->code }}</p>

                                        {{-- Specialites principales (max 3) --}}
                                        @if($professional->specialties && $professional->specialties->count() > 0)
                                            <div class="flex flex-wrap gap-1 mt-2">
                                                @foreach($professional->specialties->take(3) as $specialty)
                                                    <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs">
                                                        {{ $specialty->name }}
                                                    </span>
                                                @endforeach
                                                @if($professional->specialties->count() > 3)
                                                    <span class="text-gray-400 text-xs">+{{ $professional->specialties->count() - 3 }}</span>
                                                @endif
                                            </div>
                                        @endif

                                        {{-- Remboursements + Modes de consultation --}}
                                        <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                            {{-- Modes de consultation --}}
                                            @php
                                                $modes = [];
                                                if($professional->mode_cabinet) $modes[] = 'Cabinet';
                                                if($professional->mode_visio) $modes[] = 'Visio';
                                                if($professional->mode_domicile) $modes[] = 'Domicile';
                                            @endphp
                                            @if(count($modes) > 0)
                                                <span>{{ implode(' · ', $modes) }}</span>
                                            @endif

                                            {{-- Remboursements --}}
                                            @if($professional->reimbursements && count($professional->reimbursements) > 0)
                                                <span class="text-blue-600">
                                                    {{ implode(' · ', $professional->reimbursements_list) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
