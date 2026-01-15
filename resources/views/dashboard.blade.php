<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mon espace
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Message de bienvenue --}}
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Dashboard Professionnel --}}
            @if (auth()->user()->isProfessional())
                @php
                    $professional = auth()->user()->professional;
                @endphp

                {{-- Statut du profil --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statut de votre profil</h3>

                        @if ($professional)
                            @switch($professional->validation_status)
                                @case('pending')
                                    <div class="flex items-start bg-amber-50 rounded-xl p-4">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-amber-800 font-medium">En attente de validation</h4>
                                            <p class="text-amber-700 text-sm mt-1">
                                                Votre profil est en cours de verification par notre equipe. Vous recevrez un email une fois la validation effectuee.
                                            </p>
                                        </div>
                                    </div>
                                    @break

                                @case('approved')
                                    <div class="flex items-start bg-green-50 rounded-xl p-4">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-green-800 font-medium">Profil approuve</h4>
                                            <p class="text-green-700 text-sm mt-1">
                                                Votre profil est visible dans l'annuaire.
                                            </p>
                                            <a href="{{ route('professional.show', $professional) }}" class="inline-flex items-center mt-3 text-sm text-green-700 hover:text-green-900 font-medium">
                                                Voir mon profil public
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    @break

                                @case('rejected')
                                    <div class="flex items-start bg-red-50 rounded-xl p-4">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-red-800 font-medium">Profil refuse</h4>
                                            <p class="text-red-700 text-sm mt-1">
                                                {{ $professional->rejection_reason ?: 'Votre profil n\'a pas ete valide. Contactez-nous pour plus d\'informations.' }}
                                            </p>
                                        </div>
                                    </div>
                                    @break
                            @endswitch

                            {{-- Informations du profil --}}
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Nom complet</p>
                                    <p class="font-medium text-gray-900">{{ $professional->title }} {{ $professional->first_name }} {{ $professional->last_name }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Categorie</p>
                                    <p class="font-medium text-gray-900">{{ $professional->category?->name ?? 'Non definie' }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Specialites</p>
                                    <p class="font-medium text-gray-900">
                                        @if($professional->specialties && $professional->specialties->count() > 0)
                                            {{ $professional->specialties->pluck('name')->take(3)->implode(', ') }}
                                            @if($professional->specialties->count() > 3)
                                                <span class="text-gray-500">+{{ $professional->specialties->count() - 3 }}</span>
                                            @endif
                                        @else
                                            Aucune
                                        @endif
                                    </p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Consultation</p>
                                    <p class="font-medium text-gray-900">
                                        {{ \App\Models\Professional::CONSULTATION_TYPES[$professional->consultation_type] ?? $professional->consultation_type }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-600">Aucun profil professionnel associe.</p>
                        @endif
                    </div>
                </div>

            {{-- Dashboard Parent --}}
            @elseif (auth()->user()->isParent())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Bienvenue sur Cap Toi M'aime</h3>
                        <p class="text-gray-600 mb-4">
                            Trouvez le professionnel ideal pour accompagner votre enfant.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('questionnaire') }}" class="inline-flex items-center px-4 py-2 bg-cap-500 text-white rounded-lg hover:bg-cap-600 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Questionnaire guide
                            </a>
                            <a href="{{ route('professionals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Parcourir l'annuaire
                            </a>
                        </div>
                    </div>
                </div>

            {{-- Dashboard Admin --}}
            @elseif (auth()->user()->isAdmin())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Administration</h3>
                        <a href="/admin" class="inline-flex items-center px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Panel d'administration
                        </a>
                    </div>
                </div>

            {{-- Dashboard par defaut --}}
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="p-6 text-gray-900">
                        Bienvenue sur Cap Toi M'aime !
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
