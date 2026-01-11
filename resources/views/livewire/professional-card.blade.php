<div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 h-full flex flex-col transform hover:-translate-y-1">
    <!-- Header avec gradient burgundy -->
    <div class="bg-ctm-burgundy p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-6"></div>

        <div class="relative">
            <div class="flex justify-between items-start mb-3">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-white mb-1">
                        {{ $professional->full_name }}
                    </h3>
                    <p class="text-ctm-cream font-medium">{{ $professional->category->name }}</p>
                </div>

                @if($professional->is_verified)
                    <div class="px-3 py-1.5 rounded-full text-xs font-semibold shadow-lg bg-green-500 text-white backdrop-blur-sm">
                        Verifie
                    </div>
                @endif
            </div>

            @if($professional->is_featured)
                <div class="flex items-center bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2 w-fit">
                    <svg class="w-5 h-5 text-yellow-300 fill-current mr-2" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    <span class="text-white font-bold">Premium</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Corps de la carte -->
    <div class="p-6 flex-1 flex flex-col">
        <!-- Specialites -->
        @if($professional->specialties && count($professional->specialties) > 0)
            <div class="mb-4">
                <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Domaines d'exercice
                </h4>
                <div class="flex flex-wrap gap-2">
                    @foreach(array_slice($professional->specialties, 0, 3) as $specialty)
                        <span class="px-3 py-1.5 bg-ctm-teal/10 text-ctm-teal rounded-lg text-sm font-medium border border-ctm-teal/30">
                            {{ $specialty }}
                        </span>
                    @endforeach
                    @if(count($professional->specialties) > 3)
                        <span class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium">
                            +{{ count($professional->specialties) - 3 }}
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <!-- Localisation -->
        @if($professional->city)
            <div class="mb-4 flex items-center text-gray-600">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ $professional->city->name }} ({{ $professional->city->canton->code }})</span>
            </div>
        @endif

        <!-- Informations de contact -->
        <div class="space-y-2 mb-4 flex-1">
            @if($professional->phone)
                <div class="flex items-center text-gray-600 hover:text-ctm-teal transition-colors">
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span class="text-sm">{{ $professional->phone }}</span>
                </div>
            @endif
            @if($professional->email)
                <div class="flex items-center text-gray-600 hover:text-ctm-teal transition-colors">
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm truncate">{{ $professional->email }}</span>
                </div>
            @endif
        </div>

        <!-- Bouton CTA -->
        <a href="{{ route('professional.show', $professional) }}" class="mt-auto w-full">
            <button class="w-full bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-semibold py-3.5 px-6 rounded-xl transition-all duration-200 shadow-md hover:shadow-xl flex items-center justify-center gap-2 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Voir le profil</span>
            </button>
        </a>
    </div>
</div>
