<div class="min-h-screen bg-gray-100">
    {{-- Header --}}
    <header class="bg-cap-900 text-white px-4 py-4">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-display text-xl tracking-wide">Cap Toi M'aime</a>
            <a
                href="{{ route('questionnaire') }}"
                class="flex items-center gap-2 text-sm bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Modifier recherche
            </a>
        </div>
    </header>

    <div class="max-w-4xl mx-auto p-6">
        {{-- Title --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">VOS RECOMMANDATIONS PERSONNALISÉES</h1>
            <p class="text-gray-500">
                <span class="font-semibold text-cap-900">{{ $professionals->count() }}</span> professionnel(s) correspondent à votre recherche
            </p>
        </div>

        {{-- Analyse Box --}}
        @if(count($recommendations) > 0)
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-8 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-blue-900 mb-3 text-lg">NOTRE ANALYSE</h3>
                    <p class="text-blue-800 mb-4">D'après votre situation, nous recommandons :</p>
                    <div class="space-y-3">
                        @foreach($recommendations as $i => $rec)
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-blue-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $rec['icon'] }}"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-blue-900 font-semibold">{{ $i + 1 }}. {{ $rec['type'] }}</span>
                                    <span class="text-blue-700"> {{ $rec['reason'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Results --}}
        @if($professionals->count() > 0)
        <div class="space-y-4">
            @foreach($professionals->take(10) as $index => $pro)
                <a href="{{ route('professional.show', $pro) }}" class="block group">
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition border border-gray-100">
                        <div class="flex justify-between items-start gap-4">
                            <div class="flex items-start gap-4 flex-1">
                                {{-- Avatar --}}
                                @if($pro->getFirstMediaUrl('avatar'))
                                    <img src="{{ $pro->getFirstMediaUrl('avatar') }}" alt="{{ $pro->full_name }}" class="w-16 h-16 rounded-full object-cover flex-shrink-0">
                                @else
                                    <div class="w-16 h-16 bg-cap-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-cap-900 font-bold text-lg">
                                            {{ substr($pro->first_name, 0, 1) }}{{ substr($pro->last_name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-semibold text-gray-900 text-lg group-hover:text-cap-900 transition">{{ $pro->full_name }}</h3>
                                        @if($pro->is_verified)
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <p class="text-cap-900 font-medium">{{ $pro->category->name }}</p>

                                    {{-- Matched Specialties --}}
                                    @if(!empty($pro->match_details['matched_specialties']))
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            @foreach($pro->match_details['matched_specialties'] as $spec)
                                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs font-medium">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ str_replace('_', ' ', ucfirst($spec)) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @elseif($pro->specialties && $pro->specialties->isNotEmpty())
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            @foreach($pro->specialties->take(3) as $specialty)
                                                <span class="bg-cap-100 text-cap-900 px-2 py-0.5 rounded text-xs font-medium">
                                                    {{ $specialty->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex flex-wrap gap-4 mt-3 text-sm text-gray-500">
                                        @if($pro->city)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $pro->city->name }}, {{ $pro->city->canton->code }}
                                            </span>
                                        @endif
                                        @if($pro->mode_cabinet || $pro->mode_visio || $pro->mode_domicile)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                                @php
                                                    $modes = [];
                                                    if($pro->mode_cabinet) $modes[] = 'Cabinet';
                                                    if($pro->mode_visio) $modes[] = 'Visio';
                                                    if($pro->mode_domicile) $modes[] = 'Domicile';
                                                @endphp
                                                {{ implode(', ', $modes) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Score --}}
                            <div class="text-right flex flex-col items-end">
                                @if($index < 3)
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2
                                        {{ $index === 0 ? 'bg-yellow-100' : ($index === 1 ? 'bg-gray-100' : 'bg-orange-100') }}">
                                        @if($index === 0)
                                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @elseif($index === 1)
                                            <span class="font-bold text-gray-500">#2</span>
                                        @else
                                            <span class="font-bold text-orange-600">#3</span>
                                        @endif
                                    </div>
                                @endif
                                <div class="text-2xl font-bold {{ $pro->match_score >= 80 ? 'text-green-600' : ($pro->match_score >= 60 ? 'text-yellow-600' : 'text-gray-600') }}">
                                    {{ round($pro->match_score) }}%
                                </div>
                                <div class="text-xs text-gray-400">compatibilité</div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($professionals->count() > 10)
            <div class="text-center mt-8">
                <a
                    href="{{ route('annuaire') }}"
                    class="inline-flex items-center gap-2 text-cap-900 hover:text-cap-700 font-medium"
                >
                    Voir tous les résultats ({{ $professionals->count() }})
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        @endif
        @else
        {{-- No results --}}
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
            <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun professionnel trouvé</h3>
            <p class="text-gray-500 mb-6">Essayez de modifier vos critères de recherche</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a
                    href="{{ route('questionnaire') }}"
                    class="inline-flex items-center justify-center gap-2 bg-cap-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-cap-800 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier mes critères
                </a>
                <a
                    href="{{ route('annuaire') }}"
                    class="inline-flex items-center justify-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Voir tous les professionnels
                </a>
            </div>
        </div>
        @endif

        {{-- Back to home --}}
        <div class="text-center mt-12">
            <a
                href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
