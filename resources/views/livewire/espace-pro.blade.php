<div>
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-ctm-teal to-ctm-teal-dark text-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                        Rejoignez l'annuaire des professionnels de la phobie scolaire
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 mb-8">
                        Faites-vous connaître auprès des familles en Suisse romande qui recherchent un accompagnément spécialisé pour leur enfant.
                    </p>
                    <a href="{{ route('register.professional') }}" class="inline-flex items-center gap-2 bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl text-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        S'inscrire gratuitement
                    </a>
                </div>
                <div class="hidden md:flex justify-center">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8">
                        <div class="grid grid-cols-2 gap-6 text-center">
                            <div>
                                <div class="text-4xl font-bold mb-2">{{ $stats['pros_count'] ?? 0 }}</div>
                                <div class="text-white/80 text-sm">Professionnels<br>référencés</div>
                            </div>
                            <div>
                                <div class="text-4xl font-bold mb-2">{{ $stats['members_count'] ?? 0 }}</div>
                                <div class="text-white/80 text-sm">Familles<br>membres</div>
                            </div>
                            <div>
                                <div class="text-4xl font-bold mb-2">0%</div>
                                <div class="text-white/80 text-sm">Commission<br><span class="text-xs">(100% gratuit)</span></div>
                            </div>
                            <div>
                                <div class="text-4xl font-bold mb-2">7</div>
                                <div class="text-white/80 text-sm">Cantons<br>couverts</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Benefits Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Pourquoi rejoindre Cap Toi M'aime ?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Notre annuaire met en relation les familles en recherche d'aide avec les professionnels spécialisés dans le refus scolaire anxieux.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Benefit 1 --}}
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-ctm-teal/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Visibilité ciblée</h3>
                    <p class="text-gray-600">Soyez visible auprès des familles qui recherchent spécifiquement un accompagnément pour la phobie scolaire.</p>
                </div>

                {{-- Benefit 2 --}}
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-ctm-burgundy/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Mise en relation qualifiée</h3>
                    <p class="text-gray-600">Notre questionnaire intelligent orienté les familles vers les professionnels les plus adaptés à leur situation.</p>
                </div>

                {{-- Benefit 3 --}}
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Profil vérifié</h3>
                    <p class="text-gray-600">Chaque inscription est validée par notre équipe pour garantir la qualité de l'annuaire.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Who can register --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Qui peut s'inscrire ?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Notre annuaire accueille tous les professionnels formés à l'accompagnément du refus scolaire anxieux.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $professions = [
                        ['name' => 'Psychologues', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                        ['name' => 'Thérapeutes', 'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                        ['name' => 'Coachs scolaires', 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
                        ['name' => 'Neuropsychologues', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['name' => 'Sophrologues', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                        ['name' => 'Naturopathes', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['name' => 'Art-thérapeutes', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'],
                        ['name' => 'Et bien d\'autres...', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ];
                @endphp

                @foreach($professions as $profession)
                    <div class="bg-white rounded-xl p-6 text-center shadow-sm">
                        <div class="w-12 h-12 bg-ctm-teal/10 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $profession['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">{{ $profession['name'] }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Comment ça marche ?</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                {{-- Step 1 --}}
                <div class="text-center relative">
                    <div class="w-12 h-12 bg-ctm-burgundy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h3 class="font-bold text-gray-900 mb-2">Inscription</h3>
                    <p class="text-gray-600 text-sm">Remplissez le formulaire avec vos informations professionnelles</p>
                    {{-- Arrow --}}
                    <div class="hidden md:block absolute top-5 -right-4 transform translate-x-1/2">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="text-center relative">
                    <div class="w-12 h-12 bg-ctm-burgundy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h3 class="font-bold text-gray-900 mb-2">Validation</h3>
                    <p class="text-gray-600 text-sm">Notre équipe vérifie votre profil sous 24-48h</p>
                    {{-- Arrow --}}
                    <div class="hidden md:block absolute top-5 -right-4 transform translate-x-1/2">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="text-center relative">
                    <div class="w-12 h-12 bg-ctm-burgundy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h3 class="font-bold text-gray-900 mb-2">Publication</h3>
                    <p class="text-gray-600 text-sm">Votre profil apparaît dans l'annuaire</p>
                    {{-- Arrow --}}
                    <div class="hidden md:block absolute top-5 -right-4 transform translate-x-1/2">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="text-center">
                    <div class="w-12 h-12 bg-ctm-burgundy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h3 class="font-bold text-gray-900 mb-2">Contact</h3>
                    <p class="text-gray-600 text-sm">Les familles vous contactent directement</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Requirements --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Ce dont vous aurez besoin</h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Vos diplômes</h3>
                            <p class="text-gray-600 text-sm">Titre professionnel et formations complémentaires</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Coordonnées professionnelles</h3>
                            <p class="text-gray-600 text-sm">Adresse du cabinet, téléphone, email</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Photo professionnelle</h3>
                            <p class="text-gray-600 text-sm">Pour humaniser votre profil (optionnel)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Présentation de votre pratique</h3>
                            <p class="text-gray-600 text-sm">Décrivez votre approché et vos spécialités</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-ctm-burgundy text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Prêt à rejoindre notre réseau ?</h2>
            <p class="text-white/80 mb-8 text-lg">L'inscription est gratuite et ne prend que quelques minutes.</p>
            <a href="{{ route('register.professional') }}" class="inline-flex items-center gap-2 bg-white text-ctm-burgundy hover:bg-gray-100 font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl text-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Créer mon profil professionnel
            </a>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8 text-center">Questions fréquentes</h2>

            <div class="space-y-4">
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="font-bold text-gray-900 mb-2">L'inscription est-elle payante ?</h3>
                    <p class="text-gray-600">Non, l'inscription et la présence dans l'annuaire sont entièrement gratuites.</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="font-bold text-gray-900 mb-2">Combien de temps prend la validation ?</h3>
                    <p class="text-gray-600">Nous validons les profils sous 24 à 48 heures ouvrées. Vous recevrez un email de confirmation.</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="font-bold text-gray-900 mb-2">Puis-je modifiér mon profil après inscription ?</h3>
                    <p class="text-gray-600">Oui, vous avez accès à votre espace personnel pour mettre à jour vos informations à tout moment.</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="font-bold text-gray-900 mb-2">Comment les familles me contactent-elles ?</h3>
                    <p class="text-gray-600">Vos coordonnées (téléphone, email, site web) sont affichées sur votre profil. Les familles vous contactent directement.</p>
                </div>
            </div>
        </div>
    </section>
</div>
