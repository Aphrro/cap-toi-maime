<div class="min-h-[80vh] bg-gray-50">
    {{-- Progress Header --}}
    <div class="bg-cap-900 text-white px-4 py-6">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">Questionnaire guidé</h1>
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm">Étape {{ $step }}/{{ $totalSteps }}</span>
            </div>
            {{-- Progress Bar --}}
            <div class="h-2 bg-white/20 rounded-full">
                <div
                    class="h-full bg-white rounded-full transition-all duration-300"
                    style="width: {{ ($step / $totalSteps) * 100 }}%"
                ></div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="max-w-2xl mx-auto p-6">

        {{-- Étape 1: Situation --}}
        @if($step === 1)
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-cap-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-cap-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">QUELLE EST LA SITUATION ?</h2>
                <p class="text-gray-500 mt-2">Sélectionnez ce qui décrit le mieux votre situation</p>
            </div>

            @error('situation')
                <div class="bg-red-50 text-red-600 px-4 py-2 rounded-lg mb-4 text-sm">{{ $message }}</div>
            @enderror

            <div class="space-y-3">
                @foreach([
                    'phobie' => ['label' => 'Phobie scolaire', 'desc' => 'Anxiété, peur intense liée à l\'école', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                    'refus' => ['label' => 'Refus scolaire', 'desc' => 'Perte de motivation, opposition active', 'icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636'],
                    'decrochage' => ['label' => 'Décrochage scolaire', 'desc' => 'Absences répétées, désengagement progressif', 'icon' => 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6'],
                    'unknown' => ['label' => 'Je ne sais pas', 'desc' => 'J\'ai besoin d\'aide pour identifier la situation', 'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z']
                ] as $value => $option)
                    <div
                        wire:click="$set('situation', '{{ $value }}')"
                        class="flex items-start p-4 bg-white rounded-xl border-2 cursor-pointer transition
                            {{ $situation === $value ? 'border-cap-500 bg-cap-50 shadow-md' : 'border-gray-200 hover:border-cap-300 hover:shadow-sm' }}"
                    >
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 {{ $situation === $value ? 'bg-cap-500 text-white' : 'bg-gray-100 text-gray-500' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $option['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold text-gray-800 block">{{ $option['label'] }}</span>
                            <span class="text-sm text-gray-500">{{ $option['desc'] }}</span>
                        </div>
                        @if($situation === $value)
                            <svg class="w-6 h-6 text-cap-500 ml-auto flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Étape 2: Particularités --}}
        @if($step === 2)
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-cap-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-cap-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">PARTICULARITÉS DE VOTRE ENFANT ?</h2>
                <p class="text-gray-500 mt-2">Cochez tout ce qui s'applique (optionnel)</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach([
                    'hpi' => ['label' => 'Haut Potentiel (HPI)', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    'tdah' => ['label' => 'TDAH', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                    'tsa' => ['label' => 'TSA / Autisme', 'icon' => 'M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5'],
                    'dys' => ['label' => 'Troubles DYS', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    'hypersensibilite' => ['label' => 'Hypersensibilité', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                    'anxiété' => ['label' => 'Anxiété diagnostiquée', 'icon' => 'M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    'harcélément' => ['label' => 'Harcèlement scolaire', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                    'aucune' => ['label' => 'Aucune particularité', 'icon' => 'M5 13l4 4L19 7']
                ] as $value => $option)
                    <label
                        class="flex items-center p-4 bg-white rounded-xl border-2 cursor-pointer transition
                            {{ in_array($value, $particularities) ? 'border-cap-500 bg-cap-50 shadow-md' : 'border-gray-200 hover:border-cap-300' }}"
                        wire:click="toggleParticularity('{{ $value }}')"
                    >
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 {{ in_array($value, $particularities) ? 'bg-cap-500 text-white' : 'bg-gray-100 text-gray-500' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $option['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="text-gray-800 font-medium">{{ $option['label'] }}</span>
                        @if(in_array($value, $particularities))
                            <svg class="w-5 h-5 text-cap-500 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </label>
                @endforeach
            </div>
        @endif

        {{-- Étape 3: Âge & Durée --}}
        @if($step === 3)
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-cap-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-cap-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">ÂGE ET DURÉE</h2>
                <p class="text-gray-500 mt-2">Ces informations nous aident à trouver les bons professionnels</p>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl p-6 border border-gray-200">
                    <label class="flex items-center gap-3 text-gray-700 font-medium mb-4">
                        <svg class="w-5 h-5 text-cap-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Âge de votre enfant
                    </label>
                    <select
                        wire:model="childAge"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cap-500 focus:border-cap-500"
                    >
                        <option value="">Sélectionner l'âge...</option>
                        @for($age = 6; $age <= 25; $age++)
                            <option value="{{ $age }}">{{ $age }} ans</option>
                        @endfor
                    </select>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-200">
                    <label class="flex items-center gap-3 text-gray-700 font-medium mb-4">
                        <svg class="w-5 h-5 text-cap-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Durée de la situation
                    </label>
                    <select
                        wire:model="duration"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cap-500 focus:border-cap-500"
                    >
                        <option value="">Sélectionner la durée...</option>
                        <option value="less_1_month">Moins d'un mois</option>
                        <option value="1_3_months">1 à 3 mois</option>
                        <option value="3_6_months">3 à 6 mois</option>
                        <option value="6_12_months">6 mois à 1 an</option>
                        <option value="more_1_year">Plus d'un an</option>
                    </select>
                </div>
            </div>
        @endif

        {{-- Étape 4: Localisation --}}
        @if($step === 4)
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-cap-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-cap-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">LOCALISATION</h2>
                <p class="text-gray-500 mt-2">Où souhaitez-vous consulter ?</p>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl p-6 border border-gray-200">
                    <label class="flex items-center gap-3 text-gray-700 font-medium mb-4">
                        <svg class="w-5 h-5 text-cap-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Canton
                    </label>
                    <select
                        wire:model="canton"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cap-500 focus:border-cap-500"
                    >
                        <option value="">Tous les cantons (Suisse romande)</option>
                        @foreach($cantons as $c)
                            <option value="{{ $c->code }}">{{ $c->name }} ({{ $c->code }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-200">
                    <label class="flex items-center gap-3 text-gray-700 font-medium mb-4">
                        <svg class="w-5 h-5 text-cap-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Type de consultation
                    </label>
                    <div class="space-y-2">
                        @foreach([
                            'cabinet' => ['label' => 'En cabinet', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                            'visio' => ['label' => 'En visioconférence', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                            'domicile' => ['label' => 'À domicile', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6']
                        ] as $mode => $option)
                            <label
                                class="flex items-center p-3 bg-white rounded-lg border-2 cursor-pointer transition
                                    {{ in_array($mode, $consultationModes) ? 'border-cap-500 bg-cap-50' : 'border-gray-200 hover:border-cap-300' }}"
                                wire:click="toggleConsultationMode('{{ $mode }}')"
                            >
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 {{ in_array($mode, $consultationModes) ? 'bg-cap-500 text-white' : 'bg-gray-100 text-gray-500' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $option['icon'] }}"/>
                                    </svg>
                                </div>
                                <span class="text-gray-800">{{ $option['label'] }}</span>
                                @if(in_array($mode, $consultationModes))
                                    <svg class="w-5 h-5 text-cap-500 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Étape 5: Besoins --}}
        @if($step === 5)
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-cap-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-cap-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">VOS BESOINS PRIORITAIRES</h2>
                <p class="text-gray-500 mt-2">Sélectionnez ce qui vous semble le plus urgent</p>
            </div>

            <div class="space-y-3">
                @foreach([
                    'diagnostic' => ['label' => 'Diagnostic / Bilan', 'desc' => 'Comprendre la situation avec un bilan professionnel', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                    'suivi' => ['label' => 'Suivi thérapeutique', 'desc' => 'Un accompagnément régulier sur la durée', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                    'crise' => ['label' => 'Gestion de crise urgente', 'desc' => 'Besoin d\'une aide immédiate', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                    'retour_école' => ['label' => 'Accompagnement retour à l\'école', 'desc' => 'Préparer la réintégration scolaire', 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
                    'famille' => ['label' => 'Soutien familial', 'desc' => 'Aide pour toute la famille', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z']
                ] as $value => $option)
                    <label
                        class="flex items-start p-4 bg-white rounded-xl border-2 cursor-pointer transition
                            {{ in_array($value, $priorities) ? 'border-cap-500 bg-cap-50 shadow-md' : 'border-gray-200 hover:border-cap-300' }}"
                        wire:click="togglePriority('{{ $value }}')"
                    >
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 {{ in_array($value, $priorities) ? 'bg-cap-500 text-white' : 'bg-gray-100 text-gray-500' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $option['icon'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-800 block">{{ $option['label'] }}</span>
                            <span class="text-sm text-gray-500">{{ $option['desc'] }}</span>
                        </div>
                        @if(in_array($value, $priorities))
                            <svg class="w-5 h-5 text-cap-500 ml-auto mt-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </label>
                @endforeach
            </div>
        @endif

        {{-- Navigation --}}
        @php
            // Determiner si le bouton Suivant doit etre desactive
            $canProceed = match($step) {
                1 => !empty($situation),
                2 => true, // Optionnel
                3 => !empty($childAge) && !empty($duration),
                4 => true, // Canton optionnel, mode par defaut
                5 => !empty($priorities),
                default => true
            };
        @endphp

        <div class="flex justify-between mt-8">
            <button
                wire:click="previousStep"
                class="flex items-center gap-2 px-6 py-3 text-gray-600 hover:text-gray-800 transition {{ $step === 1 ? 'invisible' : '' }}"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Retour
            </button>

            <button
                wire:click="nextStep"
                @if(!$canProceed) disabled @endif
                class="flex items-center gap-2 px-8 py-3 rounded-lg font-medium transition shadow-lg
                    {{ $canProceed
                        ? 'bg-cap-900 text-white hover:bg-cap-800 cursor-pointer'
                        : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
            >
                @if($step === $totalSteps)
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Voir les recommandations
                @else
                    Suivant
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                @endif
            </button>
        </div>
    </div>
</div>
