<div>
    <!-- Hero Header -->
    <section class="bg-ctm-burgundy py-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-12"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <a href="{{ route('annuaire') }}" class="inline-flex items-center text-ctm-cream hover:text-white transition-colors mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Retour a l'annuaire
            </a>

            <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
                <div class="flex-shrink-0 mb-4 md:mb-0">
                    <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                        <span class="text-3xl font-bold text-white">{{ substr($professional->first_name, 0, 1) }}{{ substr($professional->last_name, 0, 1) }}</span>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex items-center flex-wrap gap-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $professional->full_name }}</h1>
                        @if($professional->is_verified)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500 text-white">
                                Verifie
                            </span>
                        @endif
                        @if($professional->is_featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-400 text-yellow-900">
                                Premium
                            </span>
                        @endif
                    </div>
                    <p class="text-lg text-ctm-cream mt-1">{{ $professional->category->name }}</p>
                    @if($professional->city)
                        <div class="flex items-center mt-2 text-white/80">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $professional->city->name }}, {{ $professional->city->canton->name }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="bg-ctm-cream py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 lg:p-8">
                    <!-- Bio -->
                    @if($professional->bio)
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                A propos
                            </h2>
                            <p class="text-gray-600 whitespace-pre-line leading-relaxed">{{ $professional->bio }}</p>
                        </div>
                    @endif

                    <!-- Specialties -->
                    @if($professional->specialties && count($professional->specialties) > 0)
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                Domaines d'exercice
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($professional->specialties as $specialty)
                                    <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium border border-ctm-teal/30">
                                        {{ $specialty }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Languages -->
                    @if($professional->languages && count($professional->languages) > 0)
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                                Langues
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($professional->languages as $language)
                                    <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium">
                                        {{ $language }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Consultation type -->
                    @if($professional->consultation_type)
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Type de consultation
                            </h2>
                            <p class="text-gray-600">{{ $professional->consultation_type }}</p>
                        </div>
                    @endif

                    <!-- Contact -->
                    <div class="border-t border-gray-200 pt-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contact
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($professional->email)
                                <a href="mailto:{{ $professional->email }}" class="flex items-center p-4 bg-ctm-cream rounded-xl hover:bg-ctm-teal/10 transition-colors group">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 group-hover:bg-ctm-teal/30 transition-colors">
                                        <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Email</div>
                                        <div class="text-ctm-teal font-medium">{{ $professional->email }}</div>
                                    </div>
                                </a>
                            @endif
                            @if($professional->phone)
                                <a href="tel:{{ $professional->phone }}" class="flex items-center p-4 bg-ctm-cream rounded-xl hover:bg-ctm-teal/10 transition-colors group">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 group-hover:bg-ctm-teal/30 transition-colors">
                                        <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Telephone</div>
                                        <div class="text-ctm-teal font-medium">{{ $professional->phone }}</div>
                                    </div>
                                </a>
                            @endif
                            @if($professional->website)
                                <a href="{{ $professional->website }}" target="_blank" rel="noopener noreferrer" class="flex items-center p-4 bg-ctm-cream rounded-xl hover:bg-ctm-teal/10 transition-colors group">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 group-hover:bg-ctm-teal/30 transition-colors">
                                        <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Site web</div>
                                        <div class="text-ctm-teal font-medium truncate">{{ $professional->website }}</div>
                                    </div>
                                </a>
                            @endif
                            @if($professional->address)
                                <div class="flex items-start p-4 bg-ctm-cream rounded-xl">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Adresse</div>
                                        <div class="text-gray-900">
                                            {{ $professional->address }}
                                            @if($professional->city)
                                                <br>{{ $professional->city->postal_code }} {{ $professional->city->name }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="mt-8 pt-8 border-t border-gray-200 text-center">
                        <a href="{{ route('annuaire') }}" class="inline-flex items-center bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-semibold py-3.5 px-8 rounded-xl transition-all duration-200 shadow-md hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Voir d'autres professionnels
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
