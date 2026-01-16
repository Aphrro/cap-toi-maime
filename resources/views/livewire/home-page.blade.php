<div>
    @php
        // Extraction des 5 sections depuis le contenu de la page
        $hero = $content['hero'] ?? [];
        $reponse = $content['reponse'] ?? [];
        $plus = $content['plus'] ?? [];
        $pourquoi = $content['pourquoi'] ?? [];
        $cta = $content['cta'] ?? [];
    @endphp

    {{-- ================================================== --}}
    {{-- SECTION 1 : HERO --}}
    {{-- ================================================== --}}
    <section
        class="py-16 px-4"
        style="background: linear-gradient(135deg, {{ $hero['background_color'] ?? '#7A1F2E' }} 0%, {{ $hero['background_color'] ?? '#7A1F2E' }}dd 100%);"
    >
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                {{-- Colonne gauche : Contenu --}}
                <div class="text-white">
                    <h1 class="text-3xl md:text-4xl font-bold mb-6" style="color: {{ $hero['text_color'] ?? '#FFFFFF' }}">
                        {{ $hero['title'] ?? 'Pourquoi cet annuaire ?' }}
                    </h1>

                    <p class="text-lg text-white/90 mb-8 leading-relaxed">
                        {{ $hero['paragraph'] ?? "A force d'echanger avec des familles, nous avons fait un constat : trouver un professionnel disponible rapidement peut devenir un veritable parcours du combattant." }}
                    </p>

                    @if(!empty($hero['button_text']))
                    <a
                        href="{{ $hero['button_url'] ?? '/annuaire' }}"
                        class="inline-flex items-center gap-2 bg-white text-ctm-burgundy px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg"
                    >
                        {{ $hero['button_text'] }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    @endif
                </div>

                {{-- Colonne droite : Highlights --}}
                @if(!empty($hero['highlights']))
                <div class="space-y-4">
                    @foreach($hero['highlights'] as $highlight)
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-check-circle class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">{{ $highlight['title'] ?? '' }}</h3>
                            <p class="text-white/70 text-sm">{{ $highlight['description'] ?? '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ================================================== --}}
    {{-- SECTION 2 : NOTRE REPONSE --}}
    {{-- ================================================== --}}
    @if($reponse['show'] ?? true)
    <section
        class="py-16 px-4"
        style="background-color: {{ $reponse['background_color'] ?? '#FFFFFF' }}"
    >
        <div class="max-w-6xl mx-auto">
            {{-- Titre --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ $reponse['title'] ?? 'Notre reponse' }}
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    {{ $reponse['paragraph'] ?? '' }}
                </p>
            </div>

            {{-- Cards --}}
            @if(!empty($reponse['cards']))
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($reponse['cards'] as $card)
                <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-ctm-teal/10 rounded-lg flex items-center justify-center mb-4">
                        <x-heroicon-o-check-circle class="w-6 h-6 text-ctm-teal" />
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $card['title'] ?? '' }}</h3>
                    <p class="text-gray-600">{{ $card['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ================================================== --}}
    {{-- SECTION 3 : NOTRE PLUS --}}
    {{-- ================================================== --}}
    @if($plus['show'] ?? true)
    <section
        class="py-16 px-4"
        style="background-color: {{ $plus['background_color'] ?? '#F9FAFB' }}"
    >
        <div class="max-w-6xl mx-auto">
            {{-- Titre --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">
                    {{ $plus['title'] ?? 'Notre "plus" pour vous faire gagner du temps' }}
                </h2>
            </div>

            {{-- Features --}}
            @if(!empty($plus['features']))
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($plus['features'] as $feature)
                <div class="bg-white rounded-xl p-8 shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-14 h-14 bg-ctm-teal/10 rounded-xl flex items-center justify-center">
                            <x-heroicon-o-clock class="w-7 h-7 text-ctm-teal" />
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $feature['title'] ?? '' }}</h3>
                            <p class="text-gray-600 mb-4">{{ $feature['description'] ?? '' }}</p>

                            {{-- Badges de disponibilite --}}
                            @if($feature['show_availability_badges'] ?? false)
                            <div class="flex flex-wrap gap-2 mt-4">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    Disponible
                                </span>
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                    2-4 semaines
                                </span>
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                    Liste d'attente
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ================================================== --}}
    {{-- SECTION 4 : POURQUOI --}}
    {{-- ================================================== --}}
    @if($pourquoi['show'] ?? true)
    <section
        class="py-16 px-4"
        style="background-color: {{ $pourquoi['background_color'] ?? '#FFFFFF' }}"
    >
        <div class="max-w-4xl mx-auto">
            {{-- Titre --}}
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ $pourquoi['title'] ?? 'Pourquoi nous l\'avons construit ainsi ?' }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ $pourquoi['paragraph'] ?? '' }}
                </p>
            </div>

            {{-- Encadre alerte --}}
            @php $alert = $pourquoi['alert'] ?? []; @endphp
            @if($alert['show'] ?? true)
            <div
                class="rounded-xl p-6 border-l-4"
                style="background-color: {{ $alert['background_color'] ?? '#FEF3C7' }}; border-color: #F59E0B;"
            >
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-yellow-800 mb-2">
                            {{ $alert['title'] ?? 'Limites et rappel important' }}
                        </h3>
                        <p class="text-yellow-700">
                            {{ $alert['text'] ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ================================================== --}}
    {{-- SECTION 5 : CTA FINAL --}}
    {{-- ================================================== --}}
    @if($cta['show'] ?? true)
    <section
        class="py-16 px-4"
        style="background-color: {{ $cta['background_color'] ?? '#7A1F2E' }}"
    >
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4" style="color: {{ $cta['text_color'] ?? '#FFFFFF' }}">
                {{ $cta['title'] ?? 'Pret a trouver le bon professionnel ?' }}
            </h2>

            @if(!empty($cta['subtitle']))
            <p class="text-xl mb-8" style="color: {{ $cta['text_color'] ?? '#FFFFFF' }}; opacity: 0.9;">
                {{ $cta['subtitle'] }}
            </p>
            @endif

            @if(!empty($cta['button_text']))
            <a
                href="{{ $cta['button_url'] ?? '/annuaire' }}"
                class="inline-flex items-center gap-2 bg-white text-ctm-burgundy px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg"
            >
                {{ $cta['button_text'] }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            @endif
        </div>
    </section>
    @endif
</div>
