<div>
    @php
        $hero = $content['hero'] ?? [];
        $badges = $content['badges_section'] ?? [];
        $statsSection = $content['stats_section'] ?? [];
        $features = $content['features_section'] ?? [];
        $steps = $content['steps_section'] ?? [];
        $speedDating = $content['speed_dating_section'] ?? [];
        $about = $content['about_section'] ?? [];
        $faqSection = $content['faq_section'] ?? [];
        $cta = $content['cta_section'] ?? [];
    @endphp

    {{-- Hero Section avec compteurs animes --}}
    <section class="bg-gradient-to-br from-ctm-teal to-ctm-teal-dark text-white py-16 md:py-24" style="background: linear-gradient(to bottom right, {{ $hero['background_color'] ?? '#1E8A9B' }}, {{ $hero['background_color_end'] ?? '#156d7a' }});">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $hero['text_color'] ?? '#FFFFFF' }}">
                        {{ $hero['title'] ?? 'Accompagnez des familles qui ont vraiment besoin de vous' }}
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 mb-8">
                        {{ $hero['subtitle'] ?? 'Rejoignez l\'annuaire des professionnels specialises dans le refus scolaire anxieux en Suisse romande.' }}
                    </p>
                    @if(!empty($badges['show']) && !empty($badges['items']))
                    <div class="flex flex-wrap gap-4 mb-8">
                        @foreach($badges['items'] as $badge)
                        <div class="flex items-center gap-2 text-white/90">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $badge['text'] ?? '' }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <a href="{{ $hero['button_url'] ?? route('register') }}" class="inline-flex items-center gap-2 bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl text-lg" style="background-color: {{ $hero['button_color'] ?? '#7A1F2E' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        {{ $hero['button_text'] ?? 'Rejoindre gratuitement' }}
                    </a>
                </div>
                <div class="hidden md:block">
                    {{-- Mockup fiche pro animee --}}
                    <div class="relative">
                        <div class="bg-white rounded-2xl shadow-2xl p-6 transform rotate-2 hover:rotate-0 transition-transform duration-500">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-ctm-teal to-ctm-teal-dark rounded-full flex items-center justify-center text-white text-xl font-bold">
                                    {{ $hero['mockup_initials'] ?? 'MD' }}
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-gray-900 font-bold">{{ $hero['mockup_name'] ?? 'Dr. Marie Dupont' }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $hero['mockup_profession'] ?? 'Psychologue' }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="inline-flex items-center gap-1 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                            {{ $hero['mockup_availability'] ?? 'Disponible' }}
                                        </span>
                                        <span class="text-gray-500 text-xs">{{ $hero['mockup_location'] ?? 'Geneve' }}</span>
                                    </div>
                                </div>
                                <div class="bg-ctm-burgundy/10 text-ctm-burgundy text-xs font-semibold px-2 py-1 rounded-lg flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $hero['mockup_badge_text'] ?? 'Verifie' }}
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach($hero['mockup_tags'] ?? ['Phobie scolaire', 'Anxiete', 'TDA/H'] as $tag)
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                @foreach($hero['mockup_insurances'] ?? ['LAMal', 'ASCA'] as $insurance)
                                <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded">{{ $insurance }}</span>
                                @endforeach
                                <span class="flex items-center gap-1 ml-auto">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $hero['mockup_visio_text'] ?? 'Visio' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Chiffres cles animes --}}
    @if(!empty($statsSection['show']))
    <section class="py-12 bg-white border-b" x-data="{ shown: false }" x-intersect.once="shown = true" style="background-color: {{ $statsSection['background_color'] ?? '#FFFFFF' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(!empty($statsSection['title']))
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">{{ $statsSection['title'] }}</h2>
            @endif
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($statsSection['items'] ?? [] as $index => $stat)
                @php
                    $targetValue = $stat['is_dynamic'] ?? false
                        ? ($stat['value'] === 'dynamic:pros_count' ? ($stats['pros_count'] ?? 0) : ($stat['value'] === 'dynamic:members_count' ? ($stats['members_count'] ?? 0) : 0))
                        : (is_numeric(str_replace('%', '', $stat['value'] ?? '0')) ? (int) str_replace('%', '', $stat['value']) : 0);
                    $suffix = str_contains($stat['value'] ?? '', '%') ? '%' : '';
                    $colors = ['#7A1F2E', '#1E8A9B', '#7A1F2E', '#22c55e'];
                @endphp
                <div class="text-center" x-data="{ count: 0, target: {{ $targetValue }} }">
                    <div class="text-4xl md:text-5xl font-bold mb-2" style="color: {{ $stat['color'] ?? $colors[$index % 4] }}"
                         @if($targetValue > 0)
                         x-text="count + '{{ $suffix }}'"
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
                         })"
                         @else
                         x-text="'{{ $stat['value'] ?? '0' }}'"
                         @endif
                    >{{ $stat['value'] ?? '0' }}</div>
                    <div class="text-gray-600">{{ $stat['label'] ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Section Fonctionnalites avec Tabs --}}
    @if(!empty($features['show']))
    <section class="py-16 bg-gray-50" x-data="{ activeTab: '{{ ($features['tabs'][0]['id'] ?? 'profil') }}' }" style="background-color: {{ $features['background_color'] ?? '#F9FAFB' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $features['title'] ?? 'Tout ce dont vous avez besoin' }}</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">{{ $features['subtitle'] ?? 'Decouvrez les fonctionnalites qui vous aideront a developper votre pratique.' }}</p>
            </div>

            {{-- Tabs Navigation --}}
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                @foreach($features['tabs'] ?? [
                    ['id' => 'profil', 'label' => 'Profil verifie'],
                    ['id' => 'visibilite', 'label' => 'Visibilite'],
                    ['id' => 'matching', 'label' => 'Matching intelligent'],
                    ['id' => 'stats', 'label' => 'Statistiques']
                ] as $tab)
                <button @click="activeTab = '{{ $tab['id'] }}'"
                        :class="activeTab === '{{ $tab['id'] }}' ? 'bg-ctm-burgundy text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                        class="px-6 py-3 rounded-full font-semibold transition-all">
                    {{ $tab['label'] }}
                </button>
                @endforeach
            </div>

            {{-- Tabs Content --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                @foreach($features['tabs'] ?? [
                    ['id' => 'profil', 'label' => 'Profil verifie', 'badge_text' => 'Badge de confiance', 'badge_color' => '#7A1F2E', 'title' => 'Un profil qui inspire confiance', 'description' => 'Chaque professionnel inscrit est verifie par notre equipe. Le badge "Verifie Cap Toi M\'aime" rassure les familles et vous distingue.', 'features' => ['Verification des diplomes', 'Validation manuelle par notre equipe', 'Badge visible sur votre profil']],
                    ['id' => 'visibilite', 'label' => 'Visibilite', 'badge_text' => 'Visibilite optimale', 'badge_color' => '#1E8A9B', 'title' => 'Soyez visible aupres des bonnes familles', 'description' => 'Notre annuaire est reserve aux membres de l\'association - des familles reellement concernees par le refus scolaire anxieux.', 'features' => ['Audience qualifiee et ciblee', 'Filtres par specialite et localisation', 'Profil complet et personnalise']],
                    ['id' => 'matching', 'label' => 'Matching intelligent', 'badge_text' => 'Matching intelligent', 'badge_color' => '#7c3aed', 'title' => 'Les bonnes familles vous trouvent', 'description' => 'Notre questionnaire guide intelligent oriente les familles vers les professionnels les plus adaptes a leur situation specifique.', 'features' => ['Algorithme de correspondance', 'Score de compatibilite', 'Recommandations personnalisees']],
                    ['id' => 'stats', 'label' => 'Statistiques', 'badge_text' => 'Tableau de bord', 'badge_color' => '#ea580c', 'title' => 'Suivez votre visibilite', 'description' => 'Accedez a des statistiques detaillees sur les consultations de votre profil et mesurez votre impact.', 'features' => ['Nombre de vues du profil', 'Demandes de contact', 'Evolution dans le temps']]
                ] as $tab)
                <div x-show="activeTab === '{{ $tab['id'] }}'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="grid md:grid-cols-2 gap-8 p-8" @if($loop->index > 0) style="display: none;" @endif>
                    <div>
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold mb-4" style="background-color: {{ $tab['badge_color'] ?? '#7A1F2E' }}20; color: {{ $tab['badge_color'] ?? '#7A1F2E' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ $tab['badge_text'] ?? '' }}
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $tab['title'] ?? '' }}</h3>
                        <p class="text-gray-600 mb-6">{{ $tab['description'] ?? '' }}</p>
                        <ul class="space-y-3">
                            @foreach($tab['features'] ?? [] as $feature)
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="bg-gray-50 rounded-xl p-8">
                            @if($tab['id'] === 'profil')
                            <div class="flex items-center gap-4 p-4 bg-white rounded-xl shadow-sm">
                                <div class="w-12 h-12 bg-ctm-burgundy/10 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-ctm-burgundy" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ $tab['visual_title'] ?? 'Verifie Cap Toi M\'aime' }}</div>
                                    <div class="text-sm text-gray-500">{{ $tab['visual_subtitle'] ?? 'Professionnel de confiance' }}</div>
                                </div>
                            </div>
                            @elseif($tab['id'] === 'visibilite')
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-ctm-teal rounded-full flex items-center justify-center text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-700">{{ $tab['visual_title'] ?? 'Recherche par specialite' }}</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($tab['visual_tags'] ?? ['Phobie scolaire', 'Anxiete', 'TDA/H', 'HPI'] as $vtag)
                                <span class="bg-white px-3 py-1 rounded-full text-sm text-gray-700 shadow-sm">{{ $vtag }}</span>
                                @endforeach
                            </div>
                            @elseif($tab['id'] === 'matching')
                            <div class="text-center mb-4">
                                <div class="text-5xl font-bold text-ctm-burgundy">{{ $tab['visual_score'] ?? '92%' }}</div>
                                <div class="text-gray-600">{{ $tab['visual_score_label'] ?? 'Score de correspondance' }}</div>
                            </div>
                            <div class="space-y-2">
                                @foreach($tab['visual_bars'] ?? [
                                    ['label' => 'Specialite', 'width' => '100%'],
                                    ['label' => 'Localisation', 'width' => '83%'],
                                    ['label' => 'Disponibilite', 'width' => '100%']
                                ] as $bar)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">{{ $bar['label'] }}</span>
                                    <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-green-500 rounded-full" style="width: {{ $bar['width'] }}"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @elseif($tab['id'] === 'stats')
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                                    <div class="text-3xl font-bold text-ctm-teal">{{ $tab['visual_views'] ?? '156' }}</div>
                                    <div class="text-sm text-gray-600">{{ $tab['visual_views_label'] ?? 'Vues ce mois' }}</div>
                                </div>
                                <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                                    <div class="text-3xl font-bold text-ctm-burgundy">{{ $tab['visual_contacts'] ?? '12' }}</div>
                                    <div class="text-sm text-gray-600">{{ $tab['visual_contacts_label'] ?? 'Contacts' }}</div>
                                </div>
                                <div class="bg-white rounded-lg p-4 text-center shadow-sm col-span-2">
                                    <div class="text-2xl font-bold text-green-600">{{ $tab['visual_growth'] ?? '+24%' }}</div>
                                    <div class="text-sm text-gray-600">{{ $tab['visual_growth_label'] ?? 'vs mois precedent' }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- How it works Timeline --}}
    @if(!empty($steps['show']))
    <section class="py-16 bg-white" style="background-color: {{ $steps['background_color'] ?? '#FFFFFF' }}">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $steps['title'] ?? 'Comment ca marche ?' }}</h2>
                <p class="text-gray-600">{{ $steps['subtitle'] ?? 'Un processus simple en 4 etapes' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-{{ count($steps['items'] ?? []) ?: 4 }} gap-8 relative">
                {{-- Ligne de connexion (desktop) --}}
                <div class="hidden md:block absolute top-8 left-[12.5%] right-[12.5%] h-0.5 bg-gray-200"></div>

                @foreach($steps['items'] ?? [
                    ['number' => '1', 'title' => 'Inscription', 'description' => 'Remplissez le formulaire en ~10 minutes', 'duration' => '~10 min'],
                    ['number' => '2', 'title' => 'Verification', 'description' => 'Nous verifions vos diplomes', 'duration' => '~48h'],
                    ['number' => '3', 'title' => 'Validation', 'description' => 'Votre profil est approuve', 'duration' => '~48h'],
                    ['number' => '4', 'title' => 'En ligne', 'description' => 'Les familles vous contactent', 'duration' => 'Pour toujours', 'is_final' => true]
                ] as $step)
                <div class="text-center relative">
                    @if(!empty($step['is_final']))
                    <div class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    @else
                    <div class="w-16 h-16 bg-ctm-burgundy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10" style="background-color: {{ $step['color'] ?? '#7A1F2E' }}">{{ $step['number'] ?? $loop->iteration }}</div>
                    @endif
                    <h3 class="font-bold text-gray-900 mb-2">{{ $step['title'] ?? '' }}</h3>
                    <p class="text-gray-600 text-sm">{{ $step['description'] ?? '' }}</p>
                    @if(!empty($step['duration']))
                    <div class="text-xs font-semibold mt-2 {{ !empty($step['is_final']) ? 'text-green-600' : 'text-ctm-teal' }}">{{ $step['duration'] }}</div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Apercu Fiche Pro avec Hotspots --}}
    @if(!empty($content['preview_section']['show'] ?? true))
    @php $preview = $content['preview_section'] ?? []; @endphp
    <section class="py-16 bg-gray-50" style="background-color: {{ $preview['background_color'] ?? '#F9FAFB' }}">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $preview['title'] ?? 'Apercu de votre fiche professionnelle' }}</h2>
                <p class="text-gray-600">{{ $preview['subtitle'] ?? 'Survolez les elements pour decouvrir les fonctionnalites' }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 relative max-w-3xl mx-auto">
                {{-- Header du profil --}}
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    {{-- Photo --}}
                    <div class="relative group">
                        <div class="w-32 h-32 bg-gradient-to-br from-ctm-teal to-ctm-teal-dark rounded-2xl flex items-center justify-center text-white text-3xl font-bold">
                            {{ $preview['demo_initials'] ?? 'MD' }}
                        </div>
                        <div class="absolute -top-2 -right-2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-48">
                            {{ $preview['tooltip_photo'] ?? 'Photo professionnelle pour humaniser votre profil' }}
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $preview['demo_name'] ?? 'Dr. Marie Dupont' }}</h3>
                                <p class="text-ctm-teal font-medium">{{ $preview['demo_profession'] ?? 'Psychologue specialisee' }}</p>
                            </div>
                            {{-- Badge verifie --}}
                            <div class="relative group">
                                <div class="bg-ctm-burgundy/10 text-ctm-burgundy px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $preview['badge_text'] ?? 'Verifie' }}
                                </div>
                                <div class="absolute -bottom-2 right-0 translate-y-full opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-56">
                                    {{ $preview['tooltip_badge'] ?? 'Badge de confiance attribue apres verification de vos diplomes' }}
                                </div>
                            </div>
                        </div>

                        {{-- Disponibilite & Localisation --}}
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <div class="relative group">
                                <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    {{ $preview['demo_availability'] ?? 'Disponible' }}
                                </span>
                                <div class="absolute -bottom-2 left-0 translate-y-full opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-48">
                                    {{ $preview['tooltip_availability'] ?? 'Indiquez votre disponibilite en temps reel' }}
                                </div>
                            </div>
                            <span class="text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $preview['demo_location'] ?? 'Geneve' }}
                            </span>
                            <span class="text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                {{ $preview['demo_visio'] ?? 'Visio disponible' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Specialites --}}
                <div class="mb-6 relative group">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">{{ $preview['specialties_label'] ?? 'Specialites' }}</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($preview['demo_specialties'] ?? ['Phobie scolaire', 'Refus scolaire anxieux', 'Anxiete', 'TDA/H'] as $specialty)
                        <span class="bg-ctm-teal/10 text-ctm-teal px-3 py-1 rounded-full text-sm">{{ $specialty }}</span>
                        @endforeach
                    </div>
                    <div class="absolute -top-2 right-0 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-56">
                        {{ $preview['tooltip_specialties'] ?? 'Vos domaines d\'expertise mis en avant' }}
                    </div>
                </div>

                {{-- Remboursements --}}
                <div class="mb-6 relative group">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">{{ $preview['insurance_label'] ?? 'Remboursements' }}</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($preview['demo_insurances'] ?? ['LAMal', 'ASCA', 'RME'] as $insurance)
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm">{{ $insurance }}</span>
                        @endforeach
                    </div>
                    <div class="absolute -top-2 right-0 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-56">
                        {{ $preview['tooltip_insurance'] ?? 'Information importante pour les familles' }}
                    </div>
                </div>

                {{-- Bouton contact --}}
                <div class="relative group">
                    <button class="w-full bg-ctm-burgundy text-white py-4 rounded-xl font-bold text-lg hover:bg-ctm-burgundy-dark transition-colors">
                        {{ $preview['contact_button_text'] ?? 'Contacter ce professionnel' }}
                    </button>
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 -translate-y-full opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-10 w-64 text-center">
                        {{ $preview['tooltip_contact'] ?? 'Les familles peuvent vous contacter directement' }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Section Speed Dating --}}
    @if(!empty($speedDating['show']))
    <section class="py-16 text-white" style="background-color: {{ $speedDating['background_color'] ?? '#156d7a' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-white/20 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $speedDating['badge_text'] ?? 'Evenements exclusifs' }}
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">{{ $speedDating['title'] ?? 'Speed Dating Therapeutes-Familles' }}</h2>
                    <p class="text-white/80 text-lg mb-6">
                        {{ $speedDating['description'] ?? 'Participez a nos evenements de mise en relation directe avec les familles. Un format unique pour vous presenter et creer des liens de confiance.' }}
                    </p>
                    <ul class="space-y-4 mb-8">
                        @foreach($speedDating['features'] ?? [
                            'Rencontres en visio de 15 minutes',
                            'Plusieurs familles rencontrees en une soiree',
                            'Gratuit pour les professionnels inscrits'
                        ] as $feature)
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ $speedDating['button_url'] ?? route('register') }}" class="inline-flex items-center gap-2 bg-white font-bold px-6 py-3 rounded-full hover:bg-gray-100 transition-colors" style="color: {{ $speedDating['background_color'] ?? '#156d7a' }}">
                        {{ $speedDating['button_text'] ?? 'Participer aux prochains evenements' }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8">
                        <div class="text-center mb-6">
                            <div class="text-sm text-white/60 uppercase tracking-wide mb-2">{{ $speedDating['next_event_label'] ?? 'Prochain evenement' }}</div>
                            <div class="text-2xl font-bold">{{ $speedDating['next_event_title'] ?? 'Speed Dating #12' }}</div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 bg-white/10 rounded-xl p-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">{{ $speedDating['next_event_date'] ?? 'Jeudi 30 janvier 2026' }}</div>
                                    <div class="text-white/60 text-sm">{{ $speedDating['next_event_time'] ?? '18h30 - 20h30' }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 bg-white/10 rounded-xl p-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">{{ $speedDating['next_event_participants'] ?? '15 familles inscrites' }}</div>
                                    <div class="text-white/60 text-sm">{{ $speedDating['next_event_places'] ?? 'Places limitees' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Section A propos Cap Toi M'aime --}}
    @if(!empty($about['show']))
    <section class="py-16 bg-white" style="background-color: {{ $about['background_color'] ?? '#FFFFFF' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    @if(!empty($about['subtitle']))
                    <div class="inline-flex items-center gap-2 bg-ctm-burgundy/10 text-ctm-burgundy px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        {{ $about['subtitle'] }}
                    </div>
                    @endif
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $about['title'] ?? 'Cap Toi M\'aime' }}</h2>
                    <div class="text-gray-600 text-lg mb-6 prose prose-lg">
                        {!! $about['content'] ?? '<p>Cap Toi M\'aime accompagne les familles confrontees au refus scolaire anxieux en Suisse romande. Notre mission : briser l\'isolement et faciliter l\'acces aux soins.</p>' !!}
                    </div>
                    @if(!empty($about['link_text']))
                    <a href="{{ $about['link_url'] ?? '/a-propos' }}" target="_blank" class="inline-flex items-center gap-2 text-ctm-teal hover:text-ctm-teal-dark font-semibold">
                        {{ $about['link_text'] }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    @endif
                </div>
                <div class="flex justify-center">
                    <div class="bg-gray-50 rounded-2xl p-8 max-w-sm">
                        @if(!empty($about['image']))
                        <img src="{{ Storage::url($about['image']) }}" alt="{{ $about['title'] ?? '' }}" class="w-24 h-24 mx-auto mb-4 object-contain">
                        @else
                        <div class="text-6xl mb-4">
                            <svg class="w-24 h-24 mx-auto text-ctm-burgundy" viewBox="0 0 100 100" fill="currentColor">
                                <path d="M50 90c-22.1 0-40-17.9-40-40S27.9 10 50 10s40 17.9 40 40-17.9 40-40 40zm0-70c-16.5 0-30 13.5-30 30s13.5 30 30 30 30-13.5 30-30-13.5-30-30-30z"/>
                                <path d="M50 35c-8.3 0-15 6.7-15 15s6.7 15 15 15 15-6.7 15-15-6.7-15-15-15zm0 20c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5z"/>
                            </svg>
                        </div>
                        @endif
                        @if(!empty($about['quote']))
                        <blockquote class="text-center">
                            <p class="text-gray-600 italic mb-4">"{{ $about['quote'] }}"</p>
                            @if(!empty($about['quote_author']))
                            <footer class="text-sm text-gray-500">— {{ $about['quote_author'] }}</footer>
                            @endif
                        </blockquote>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- FAQ Accordeon --}}
    @if(!empty($faqSection['show']))
    <section class="py-16 bg-gray-50" style="background-color: {{ $faqSection['background_color'] ?? '#F9FAFB' }}">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $faqSection['title'] ?? 'Questions frequentes' }}</h2>
                <p class="text-gray-600">{{ $faqSection['subtitle'] ?? 'Tout ce que vous devez savoir avant de vous inscrire' }}</p>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                @foreach($faqSection['custom_items'] ?? [
                    ['question' => 'L\'inscription est-elle payante ?', 'answer' => 'Non, l\'inscription et la presence dans l\'annuaire sont <strong>entierement gratuites</strong>. Notre mission est de faciliter l\'acces aux soins, pas de generer des revenus. Aucune commission n\'est prelevee sur les consultations.'],
                    ['question' => 'Combien de temps prend la validation ?', 'answer' => 'Nous validons les profils sous <strong>24 a 48 heures ouvrees</strong>. Vous recevrez un email de confirmation des que votre profil sera approuve et visible dans l\'annuaire.'],
                    ['question' => 'Puis-je modifier mon profil apres inscription ?', 'answer' => 'Oui, vous avez acces a votre espace personnel pour <strong>mettre a jour vos informations a tout moment</strong> : disponibilite, tarifs, specialites, coordonnees, etc.'],
                    ['question' => 'Comment les familles me contactent-elles ?', 'answer' => 'Vos coordonnees (telephone, email, site web) sont affichees sur votre profil. <strong>Les familles vous contactent directement</strong>, sans intermediaire. Vous gerez vos rendez-vous comme d\'habitude.'],
                    ['question' => 'Qui peut voir mon profil ?', 'answer' => 'L\'annuaire est reserve aux <strong>familles membres de l\'association Cap Toi M\'aime</strong>. Cela garantit une audience qualifiee et reellement concernee par le refus scolaire anxieux.'],
                    ['question' => 'Quels documents dois-je fournir ?', 'answer' => 'Pour la validation, nous demandons une <strong>copie de vos diplomes</strong> et eventuellement vos certifications complementaires. Ces documents sont uniquement utilises pour la verification et ne sont pas publies.']
                ] as $index => $faq)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button @click="openFaq = openFaq === {{ $index + 1 }} ? null : {{ $index + 1 }}" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ $faq['question'] }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === {{ $index + 1 }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === {{ $index + 1 }}" x-collapse>
                        <div class="px-6 pb-6 text-gray-600">
                            {!! $faq['answer'] !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Final avec gradient --}}
    @if(!empty($cta['show']))
    <section class="py-20" style="background: {{ !empty($cta['gradient_start']) && !empty($cta['gradient_end']) ? 'linear-gradient(to bottom right, ' . $cta['gradient_start'] . ', ' . $cta['gradient_end'] . ')' : ($cta['background_color'] ?? 'linear-gradient(to bottom right, #7A1F2E, #1E8A9B)') }}">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ $cta['title'] ?? 'Pret a rejoindre notre reseau ?' }}</h2>
            <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">
                {{ $cta['subtitle'] ?? 'L\'inscription est gratuite et ne prend que quelques minutes. Rejoignez les professionnels qui font la difference pour les familles en Suisse romande.' }}
            </p>
            <a href="{{ $cta['button_url'] ?? route('register') }}" class="inline-flex items-center gap-3 bg-white hover:bg-gray-100 font-bold uppercase px-10 py-5 rounded-full transition-all hover:shadow-2xl text-lg" style="color: {{ $cta['gradient_start'] ?? '#7A1F2E' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                {{ $cta['button_text'] ?? 'Creer mon profil gratuitement' }}
            </a>
            @if(!empty($cta['contact_text']))
            <p class="text-white/60 text-sm mt-6">
                {{ $cta['contact_text'] }}
                @if(!empty($cta['contact_email']))
                <a href="mailto:{{ $cta['contact_email'] }}" class="text-white hover:underline">{{ $cta['contact_email'] }}</a>
                @endif
            </p>
            @else
            <p class="text-white/60 text-sm mt-6">{{ $cta['footer_text'] ?? 'Aucune carte de credit requise' }}</p>
            @endif
        </div>
    </section>
    @endif
</div>
