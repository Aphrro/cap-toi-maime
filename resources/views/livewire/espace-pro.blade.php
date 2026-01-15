<div>
    {{-- Hero Section avec compteurs animes --}}
    <section class="bg-gradient-to-br from-ctm-teal to-ctm-teal-dark text-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                        Accompagnez des familles qui ont vraiment besoin de vous
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 mb-8">
                        Rejoignez l'annuaire des professionnels specialises dans le refus scolaire anxieux en Suisse romande.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex items-center gap-2 text-white/90">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>100% Gratuit</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Patients qualifies</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Badge verifie</span>
                        </div>
                    </div>
                    <a href="{{ route('register.professional') }}" class="inline-flex items-center gap-2 bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl text-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Rejoindre gratuitement
                    </a>
                </div>
                <div class="hidden md:block">
                    {{-- Mockup fiche pro animee --}}
                    <div class="relative">
                        <div class="bg-white rounded-2xl shadow-2xl p-6 transform rotate-2 hover:rotate-0 transition-transform duration-500">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-ctm-teal to-ctm-teal-dark rounded-full flex items-center justify-center text-white text-xl font-bold">
                                    MD
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-gray-900 font-bold">Dr. Marie Dupont</h3>
                                    <p class="text-gray-600 text-sm">Psychologue</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="inline-flex items-center gap-1 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                            Disponible
                                        </span>
                                        <span class="text-gray-500 text-xs">Geneve</span>
                                    </div>
                                </div>
                                <div class="bg-ctm-burgundy/10 text-ctm-burgundy text-xs font-semibold px-2 py-1 rounded-lg flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Verifie
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">Phobie scolaire</span>
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">Anxiete</span>
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">TDA/H</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded">LAMal</span>
                                <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded">ASCA</span>
                                <span class="flex items-center gap-1 ml-auto">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    Visio
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Chiffres cles animes --}}
    <section class="py-12 bg-white border-b" x-data="{ shown: false }" x-intersect.once="shown = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                {{-- Compteur Pros --}}
                <div class="text-center" x-data="{ count: 0, target: {{ $stats['pros_count'] ?? 0 }} }">
                    <div class="text-4xl md:text-5xl font-bold text-ctm-burgundy mb-2"
                         x-text="count"
                         x-init="$watch('shown', value => {
                             if(value && target > 0) {
                                 let start = 0;
                                 let duration = 2000;
                                 let increment = target / (duration / 16);
                                 let timer = setInterval(() => {
                                     start += increment;
                                     if(start >= target) {
                                         count = target;
                                         clearInterval(timer);
                                     } else {
                                         count = Math.floor(start);
                                     }
                                 }, 16);
                             }
                         })">0</div>
                    <div class="text-gray-600">Professionnels verifies</div>
                </div>

                {{-- Compteur Familles --}}
                <div class="text-center" x-data="{ count: 0, target: {{ $stats['members_count'] ?? 0 }} }">
                    <div class="text-4xl md:text-5xl font-bold text-ctm-teal mb-2"
                         x-text="count"
                         x-init="$watch('shown', value => {
                             if(value && target > 0) {
                                 let start = 0;
                                 let duration = 2000;
                                 let increment = target / (duration / 16);
                                 let timer = setInterval(() => {
                                     start += increment;
                                     if(start >= target) {
                                         count = target;
                                         clearInterval(timer);
                                     } else {
                                         count = Math.floor(start);
                                     }
                                 }, 16);
                             }
                         })">0</div>
                    <div class="text-gray-600">Familles membres</div>
                </div>

                {{-- Cantons --}}
                <div class="text-center" x-data="{ count: 0, target: 7 }">
                    <div class="text-4xl md:text-5xl font-bold text-ctm-burgundy mb-2"
                         x-text="count"
                         x-init="$watch('shown', value => {
                             if(value) {
                                 let start = 0;
                                 let duration = 1500;
                                 let increment = target / (duration / 16);
                                 let timer = setInterval(() => {
                                     start += increment;
                                     if(start >= target) {
                                         count = target;
                                         clearInterval(timer);
                                     } else {
                                         count = Math.floor(start);
                                     }
                                 }, 16);
                             }
                         })">0</div>
                    <div class="text-gray-600">Cantons romands</div>
                </div>

                {{-- Gratuit --}}
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-green-600 mb-2">0%</div>
                    <div class="text-gray-600">Commission</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Fonctionnalites avec Tabs --}}
    <section class="py-16 bg-gray-50" x-data="{ activeTab: 'profil' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Tout ce dont vous avez besoin</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Decouvrez les fonctionnalites qui vous aideront a developper votre pratique.</p>
            </div>

            {{-- Tabs Navigation --}}
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                <button @click="activeTab = 'profil'"
                        :class="activeTab === 'profil' ? 'bg-ctm-burgundy text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                        class="px-6 py-3 rounded-full font-semibold transition-all">
                    Profil verifie
                </button>
                <button @click="activeTab = 'visibilite'"
                        :class="activeTab === 'visibilite' ? 'bg-ctm-burgundy text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                        class="px-6 py-3 rounded-full font-semibold transition-all">
                    Visibilite
                </button>
                <button @click="activeTab = 'matching'"
                        :class="activeTab === 'matching' ? 'bg-ctm-burgundy text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                        class="px-6 py-3 rounded-full font-semibold transition-all">
                    Matching intelligent
                </button>
                <button @click="activeTab = 'stats'"
                        :class="activeTab === 'stats' ? 'bg-ctm-burgundy text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                        class="px-6 py-3 rounded-full font-semibold transition-all">
                    Statistiques
                </button>
            </div>

            {{-- Tabs Content --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                {{-- Tab: Profil verifie --}}
                <div x-show="activeTab === 'profil'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="grid md:grid-cols-2 gap-8 p-8">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-ctm-burgundy/10 text-ctm-burgundy px-4 py-2 rounded-full text-sm font-semibold mb-4">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Badge de confiance
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Un profil qui inspire confiance</h3>
                        <p class="text-gray-600 mb-6">Chaque professionnel inscrit est verifie par notre equipe. Le badge "Verifie Cap Toi M'aime" rassure les familles et vous distingue.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Verification des diplomes
                            </li>
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Validation manuelle par notre equipe
                            </li>
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Badge visible sur votre profil
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="bg-gray-50 rounded-xl p-8">
                            <div class="flex items-center gap-4 p-4 bg-white rounded-xl shadow-sm">
                                <div class="w-12 h-12 bg-ctm-burgundy/10 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-ctm-burgundy" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">Verifie Cap Toi M'aime</div>
                                    <div class="text-sm text-gray-500">Professionnel de confiance</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab: Visibilite --}}
                <div x-show="activeTab === 'visibilite'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="grid md:grid-cols-2 gap-8 p-8" style="display: none;">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-ctm-teal/10 text-ctm-teal px-4 py-2 rounded-full text-sm font-semibold mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Visibilite optimale
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Soyez visible aupres des bonnes familles</h3>
                        <p class="text-gray-600 mb-6">Notre annuaire est reserve aux membres de l'association - des familles reellement concernees par le refus scolaire anxieux.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Audience qualifiee et ciblee
                            </li>
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Filtres par specialite et localisation
                            </li>
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Profil complet et personnalise
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-ctm-teal rounded-full flex items-center justify-center text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-700">Recherche par specialite</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-white px-3 py-1 rounded-full text-sm text-gray-700 shadow-sm">Phobie scolaire</span>
                                <span class="bg-white px-3 py-1 rounded-full text-sm text-gray-700 shadow-sm">Anxiete</span>
                                <span class="bg-white px-3 py-1 rounded-full text-sm text-gray-700 shadow-sm">TDA/H</span>
                                <span class="bg-white px-3 py-1 rounded-full text-sm text-gray-700 shadow-sm">HPI</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab: Matching --}}
                <div x-show="activeTab === 'matching'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="grid md:grid-cols-2 gap-8 p-8" style="display: none;">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Matching intelligent
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Les bonnes familles vous trouvent</h3>
                        <p class="text-gray-600 mb-6">Notre questionnaire guide intelligent oriente les familles vers les professionnels les plus adaptes a leur situation specifique.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Algorithme de correspondance
                            </li>
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Score de compatibilite
                            </li>
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Recommandations personnalisees
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="bg-gray-50 rounded-xl p-6 w-full max-w-sm">
                            <div class="text-center mb-4">
                                <div class="text-5xl font-bold text-ctm-burgundy">92%</div>
                                <div class="text-gray-600">Score de correspondance</div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Specialite</span>
                                    <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="w-full h-full bg-green-500 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Localisation</span>
                                    <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="w-5/6 h-full bg-green-500 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Disponibilite</span>
                                    <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="w-full h-full bg-green-500 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab: Stats --}}
                <div x-show="activeTab === 'stats'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="grid md:grid-cols-2 gap-8 p-8" style="display: none;">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Tableau de bord
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Suivez votre visibilite</h3>
                        <p class="text-gray-600 mb-6">Accedez a des statistiques detaillees sur les consultations de votre profil et mesurez votre impact.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Nombre de vues du profil
                            </li>
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Demandes de contact
                            </li>
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Evolution dans le temps
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="bg-gray-50 rounded-xl p-6 w-full max-w-sm">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                                    <div class="text-3xl font-bold text-ctm-teal">156</div>
                                    <div class="text-sm text-gray-600">Vues ce mois</div>
                                </div>
                                <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                                    <div class="text-3xl font-bold text-ctm-burgundy">12</div>
                                    <div class="text-sm text-gray-600">Contacts</div>
                                </div>
                                <div class="bg-white rounded-lg p-4 text-center shadow-sm col-span-2">
                                    <div class="text-2xl font-bold text-green-600">+24%</div>
                                    <div class="text-sm text-gray-600">vs mois precedent</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How it works Timeline --}}
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Comment ca marche ?</h2>
                <p class="text-gray-600">Un processus simple en 4 etapes</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                {{-- Ligne de connexion (desktop) --}}
                <div class="hidden md:block absolute top-8 left-[12.5%] right-[12.5%] h-0.5 bg-gray-200"></div>

                {{-- Step 1 --}}
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-ctm-burgundy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10">1</div>
                    <h3 class="font-bold text-gray-900 mb-2">Inscription</h3>
                    <p class="text-gray-600 text-sm">Remplissez le formulaire en ~10 minutes</p>
                    <div class="text-xs text-ctm-teal font-semibold mt-2">~10 min</div>
                </div>

                {{-- Step 2 --}}
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-ctm-burgundy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10">2</div>
                    <h3 class="font-bold text-gray-900 mb-2">Verification</h3>
                    <p class="text-gray-600 text-sm">Nous verifions vos diplomes</p>
                    <div class="text-xs text-ctm-teal font-semibold mt-2">~48h</div>
                </div>

                {{-- Step 3 --}}
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-ctm-burgundy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10">3</div>
                    <h3 class="font-bold text-gray-900 mb-2">Validation</h3>
                    <p class="text-gray-600 text-sm">Votre profil est approuve</p>
                    <div class="text-xs text-ctm-teal font-semibold mt-2">~48h</div>
                </div>

                {{-- Step 4 --}}
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">En ligne</h3>
                    <p class="text-gray-600 text-sm">Les familles vous contactent</p>
                    <div class="text-xs text-green-600 font-semibold mt-2">Pour toujours</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Apercu Fiche Pro avec Hotspots --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Apercu de votre fiche professionnelle</h2>
                <p class="text-gray-600">Survolez les elements pour decouvrir les fonctionnalites</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 relative max-w-3xl mx-auto">
                {{-- Header du profil --}}
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    {{-- Photo --}}
                    <div class="relative group">
                        <div class="w-32 h-32 bg-gradient-to-br from-ctm-teal to-ctm-teal-dark rounded-2xl flex items-center justify-center text-white text-3xl font-bold">
                            MD
                        </div>
                        <div class="absolute -top-2 -right-2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-48">
                            Photo professionnelle pour humaniser votre profil
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Dr. Marie Dupont</h3>
                                <p class="text-ctm-teal font-medium">Psychologue specialisee</p>
                            </div>
                            {{-- Badge verifie --}}
                            <div class="relative group">
                                <div class="bg-ctm-burgundy/10 text-ctm-burgundy px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Verifie
                                </div>
                                <div class="absolute -bottom-2 right-0 translate-y-full opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-56">
                                    Badge de confiance attribue apres verification de vos diplomes
                                </div>
                            </div>
                        </div>

                        {{-- Disponibilite & Localisation --}}
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <div class="relative group">
                                <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    Disponible
                                </span>
                                <div class="absolute -bottom-2 left-0 translate-y-full opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-48">
                                    Indiquez votre disponibilite en temps reel
                                </div>
                            </div>
                            <span class="text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Geneve
                            </span>
                            <span class="text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                Visio disponible
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Specialites --}}
                <div class="mb-6 relative group">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Specialites</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-ctm-teal/10 text-ctm-teal px-3 py-1 rounded-full text-sm">Phobie scolaire</span>
                        <span class="bg-ctm-teal/10 text-ctm-teal px-3 py-1 rounded-full text-sm">Refus scolaire anxieux</span>
                        <span class="bg-ctm-teal/10 text-ctm-teal px-3 py-1 rounded-full text-sm">Anxiete</span>
                        <span class="bg-ctm-teal/10 text-ctm-teal px-3 py-1 rounded-full text-sm">TDA/H</span>
                    </div>
                    <div class="absolute -top-2 right-0 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-56">
                        Vos domaines d'expertise mis en avant
                    </div>
                </div>

                {{-- Remboursements --}}
                <div class="mb-6 relative group">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Remboursements</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm">LAMal</span>
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm">ASCA</span>
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm">RME</span>
                    </div>
                    <div class="absolute -top-2 right-0 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-56">
                        Information importante pour les familles
                    </div>
                </div>

                {{-- Bouton contact --}}
                <div class="relative group">
                    <button class="w-full bg-ctm-burgundy text-white py-4 rounded-xl font-bold text-lg hover:bg-ctm-burgundy-dark transition-colors">
                        Contacter ce professionnel
                    </button>
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 -translate-y-full opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-64 text-center">
                        Les familles peuvent vous contacter directement
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Speed Dating --}}
    <section class="py-16 bg-ctm-teal-dark text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-white/20 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Evenements exclusifs
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Speed Dating Therapeutes-Familles</h2>
                    <p class="text-white/80 text-lg mb-6">
                        Participez a nos evenements de mise en relation directe avec les familles. Un format unique pour vous presenter et creer des liens de confiance.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Rencontres en visio de 15 minutes</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Plusieurs familles rencontrees en une soiree</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Gratuit pour les professionnels inscrits</span>
                        </li>
                    </ul>
                    <a href="{{ route('register.professional') }}" class="inline-flex items-center gap-2 bg-white text-ctm-teal-dark font-bold px-6 py-3 rounded-full hover:bg-gray-100 transition-colors">
                        Participer aux prochains evenements
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8">
                        <div class="text-center mb-6">
                            <div class="text-sm text-white/60 uppercase tracking-wide mb-2">Prochain evenement</div>
                            <div class="text-2xl font-bold">Speed Dating #12</div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 bg-white/10 rounded-xl p-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Jeudi 30 janvier 2026</div>
                                    <div class="text-white/60 text-sm">18h30 - 20h30</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 bg-white/10 rounded-xl p-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">15 familles inscrites</div>
                                    <div class="text-white/60 text-sm">Places limitees</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section A propos Cap Toi M'aime --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-ctm-burgundy/10 text-ctm-burgundy px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        L'association
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Cap Toi M'aime</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Cap Toi M'aime accompagne les familles confrontees au refus scolaire anxieux en Suisse romande. Notre mission : briser l'isolement et faciliter l'acces aux soins.
                    </p>
                    <p class="text-gray-600 mb-8">
                        L'annuaire est ne d'un constat simple : les familles peinent a trouver des professionnels formes et disponibles. En rejoignant notre reseau, vous participez a cette mission d'interet general.
                    </p>
                    <a href="https://www.captoimaime.ch" target="_blank" class="inline-flex items-center gap-2 text-ctm-teal hover:text-ctm-teal-dark font-semibold">
                        Decouvrir l'association
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
                <div class="flex justify-center">
                    <div class="bg-gray-50 rounded-2xl p-8 max-w-sm">
                        <div class="text-6xl mb-4">
                            <svg class="w-24 h-24 mx-auto text-ctm-burgundy" viewBox="0 0 100 100" fill="currentColor">
                                <path d="M50 90c-22.1 0-40-17.9-40-40S27.9 10 50 10s40 17.9 40 40-17.9 40-40 40zm0-70c-16.5 0-30 13.5-30 30s13.5 30 30 30 30-13.5 30-30-13.5-30-30-30z"/>
                                <path d="M50 35c-8.3 0-15 6.7-15 15s6.7 15 15 15 15-6.7 15-15-6.7-15-15-15zm0 20c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5z"/>
                            </svg>
                        </div>
                        <blockquote class="text-center">
                            <p class="text-gray-600 italic mb-4">"Ensemble, redonnons le sourire a nos enfants"</p>
                            <footer class="text-sm text-gray-500">— Marine Chambat, Fondatrice</footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Accordeon --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Questions frequentes</h2>
                <p class="text-gray-600">Tout ce que vous devez savoir avant de vous inscrire</p>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">L'inscription est-elle payante ?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse>
                        <div class="px-6 pb-6 text-gray-600">
                            Non, l'inscription et la presence dans l'annuaire sont <strong>entierement gratuites</strong>. Notre mission est de faciliter l'acces aux soins, pas de generer des revenus. Aucune commission n'est prelevee sur les consultations.
                        </div>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Combien de temps prend la validation ?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse>
                        <div class="px-6 pb-6 text-gray-600">
                            Nous validons les profils sous <strong>24 a 48 heures ouvrees</strong>. Vous recevrez un email de confirmation des que votre profil sera approuve et visible dans l'annuaire.
                        </div>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Puis-je modifier mon profil apres inscription ?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse>
                        <div class="px-6 pb-6 text-gray-600">
                            Oui, vous avez acces a votre espace personnel pour <strong>mettre a jour vos informations a tout moment</strong> : disponibilite, tarifs, specialites, coordonnees, etc.
                        </div>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button @click="openFaq = openFaq === 4 ? null : 4" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Comment les familles me contactent-elles ?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" x-collapse>
                        <div class="px-6 pb-6 text-gray-600">
                            Vos coordonnees (telephone, email, site web) sont affichees sur votre profil. <strong>Les familles vous contactent directement</strong>, sans intermediaire. Vous gerez vos rendez-vous comme d'habitude.
                        </div>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button @click="openFaq = openFaq === 5 ? null : 5" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Qui peut voir mon profil ?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 5" x-collapse>
                        <div class="px-6 pb-6 text-gray-600">
                            L'annuaire est reserve aux <strong>familles membres de l'association Cap Toi M'aime</strong>. Cela garantit une audience qualifiee et reellement concernee par le refus scolaire anxieux.
                        </div>
                    </div>
                </div>

                {{-- FAQ 6 --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button @click="openFaq = openFaq === 6 ? null : 6" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Quels documents dois-je fournir ?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 6 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 6" x-collapse>
                        <div class="px-6 pb-6 text-gray-600">
                            Pour la validation, nous demandons une <strong>copie de vos diplomes</strong> et eventuellement vos certifications complementaires. Ces documents sont uniquement utilises pour la verification et ne sont pas publies.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Final avec gradient --}}
    <section class="py-20 bg-gradient-to-br from-ctm-burgundy to-ctm-teal">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Pret a rejoindre notre reseau ?</h2>
            <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">
                L'inscription est gratuite et ne prend que quelques minutes. Rejoignez les professionnels qui font la difference pour les familles en Suisse romande.
            </p>
            <a href="{{ route('register.professional') }}" class="inline-flex items-center gap-3 bg-white text-ctm-burgundy hover:bg-gray-100 font-bold uppercase px-10 py-5 rounded-full transition-all hover:shadow-2xl text-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Creer mon profil gratuitement
            </a>
            <p class="text-white/60 text-sm mt-6">Aucune carte de credit requise</p>
        </div>
    </section>
</div>
