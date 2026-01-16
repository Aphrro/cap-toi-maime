<div>
    @php
        // Extraction des 5 sections depuis le contenu de la page
        $hero = $content['hero'] ?? [];
        $mission = $content['mission'] ?? [];
        $valeurs = $content['valeurs'] ?? [];
        $equipe = $content['equipe'] ?? [];
        $cta = $content['cta'] ?? [];
    @endphp

    {{-- ================================================== --}}
    {{-- SECTION 1 : HERO --}}
    {{-- ================================================== --}}
    <section
        class="py-16 px-4"
        style="background: linear-gradient(135deg, {{ $hero['background_color'] ?? '#7A1F2E' }} 0%, {{ $hero['background_color'] ?? '#7A1F2E' }}dd 100%);"
    >
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-6" style="color: {{ $hero['text_color'] ?? '#FFFFFF' }}">
                {{ $hero['title'] ?? 'A propos de Cap Toi M\'aime' }}
            </h1>

            @if(!empty($hero['subtitle']))
            <p class="text-xl mb-8" style="color: {{ $hero['text_color'] ?? '#FFFFFF' }}; opacity: 0.9;">
                {{ $hero['subtitle'] }}
            </p>
            @endif
        </div>
    </section>

    {{-- ================================================== --}}
    {{-- SECTION 2 : NOTRE MISSION --}}
    {{-- ================================================== --}}
    @if($mission['show'] ?? true)
    <section class="py-16 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">
                        {{ $mission['title'] ?? 'Notre mission' }}
                    </h2>
                    <div class="prose prose-lg text-gray-600">
                        {!! $mission['content'] ?? '' !!}
                    </div>
                </div>

                @if(!empty($mission['image']))
                <div>
                    <img src="{{ Storage::url($mission['image']) }}" alt="Notre mission" class="rounded-xl shadow-lg">
                </div>
                @else
                <div class="bg-gray-100 rounded-xl p-8 flex items-center justify-center h-64">
                    <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================== --}}
    {{-- SECTION 3 : NOS VALEURS --}}
    {{-- ================================================== --}}
    @if($valeurs['show'] ?? true)
    <section class="py-16 px-4 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">
                {{ $valeurs['title'] ?? 'Nos valeurs' }}
            </h2>

            @if(!empty($valeurs['items']))
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($valeurs['items'] as $valeur)
                <div class="bg-white rounded-xl p-8 text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-ctm-burgundy/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <x-heroicon-o-heart class="w-8 h-8 text-ctm-burgundy" />
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $valeur['title'] ?? '' }}</h3>
                    <p class="text-gray-600">{{ $valeur['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ================================================== --}}
    {{-- SECTION 4 : L'EQUIPE --}}
    {{-- ================================================== --}}
    @if($equipe['show'] ?? true)
    <section class="py-16 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">
                {{ $equipe['title'] ?? 'L\'equipe' }}
            </h2>

            @if(!empty($equipe['members']))
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($equipe['members'] as $member)
                <div class="text-center">
                    @if(!empty($member['photo']))
                    <img src="{{ Storage::url($member['photo']) }}" alt="{{ $member['name'] }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    @else
                    <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-4xl font-bold text-gray-400">
                            {{ substr($member['name'] ?? 'M', 0, 1) }}
                        </span>
                    </div>
                    @endif
                    <h3 class="text-xl font-semibold text-gray-800">{{ $member['name'] ?? '' }}</h3>
                    <p class="text-ctm-teal font-medium mb-2">{{ $member['role'] ?? '' }}</p>
                    <p class="text-gray-600 text-sm">{{ $member['bio'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ================================================== --}}
    {{-- SECTION 5 : CTA FINAL --}}
    {{-- ================================================== --}}
    @if($cta['show'] ?? true)
    <section class="py-16 px-4 bg-ctm-burgundy">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-4">
                {{ $cta['title'] ?? 'Rejoignez notre communaute' }}
            </h2>

            @if(!empty($cta['subtitle']))
            <p class="text-xl text-white/90 mb-8">
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
