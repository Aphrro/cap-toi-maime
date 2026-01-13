<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cap Toi M'aime - Annuaire phobie scolaire Suisse romande</title>
        <meta name="description" content="Trouvez des thérapeutes spécialises dans le refus scolaire anxieux en Suisse romande. Psychologues, pedopsychiatrès et coachs vérifiés.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|bowlby-one-sc:400&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white">
        <!-- Navigation -->
        <nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3">
                            <img src="{{ asset('logo-cap-toi-maime.png') }}" alt="Logo" class="h-12 w-12" onerror="this.style.display='none'">
                            <span class="font-display text-xl text-ctm-burgundy uppercase tracking-wide">Cap Toi M'aime</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-ctm-burgundy text-sm font-bold uppercase">Accueil</a>
                        <a href="{{ route('about') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">À propos</a>
                        <a href="{{ route('faq') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">FAQ</a>
                        <a href="{{ route('témoignages') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Témoignages</a>
                        <a href="{{ route('contact') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Contact</a>
                        <a href="{{ route('login') }}" class="text-gray-500 text-sm hover:text-gray-700 transition-colors">Connexion</a>
                        <a href="{{ route('annuaire') }}" class="bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white text-sm font-bold uppercase px-6 py-3 rounded-full transition-all hover:shadow-xl">Trouver un pro</a>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <a href="{{ route('annuaire') }}" class="bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white text-sm font-bold uppercase px-4 py-2 rounded-full">
                            Annuaire
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Column - Content -->
                    <div>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                            Trouvez des thérapeutes disponibles et
                            <span class="text-ctm-burgundy">formés au refus scolaire anxieux</span>
                        </h1>
                        <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                            Notre annuaire regroupe des professionnels de confiance, vérifiés et spécialises dans l'accompagnément de la phobie scolaire en Suisse romande.
                        </p>
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a href="{{ route('annuaire') }}" class="bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl">
                                Consulter l'annuaire
                            </a>
                            <a href="{{ route('about') }}" class="bg-white hover:shadow-lg text-gray-900 font-bold uppercase px-8 py-4 rounded-full border-2 border-gray-900 transition-all">
                                En savoir plus
                            </a>
                        </div>
                        <!-- Stats -->
                        <div class="mt-12 grid grid-cols-3 gap-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-ctm-burgundy">50+</div>
                                <div class="text-sm text-gray-600 mt-1">Professionnels</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-ctm-teal">7</div>
                                <div class="text-sm text-gray-600 mt-1">Cantons</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600">4.9/5</div>
                                <div class="text-sm text-gray-600 mt-1">Satisfaction</div>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column - Visual -->
                    <div class="relative hidden lg:block">
                        <div class="absolute -top-10 -right-10 w-72 h-72 bg-ctm-burgundy/10 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-ctm-teal/10 rounded-full blur-3xl"></div>
                        <div class="relative bg-white rounded-3xl shadow-2xl p-8">
                            <div class="space-y-6">
                                <div class="flex items-center space-x-4 p-4 bg-ctm-cream rounded-xl">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">Recherchez</div>
                                        <div class="text-sm text-gray-600">Par spécialité ou lieu</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4 p-4 bg-ctm-cream rounded-xl">
                                    <div class="w-12 h-12 bg-ctm-burgundy/20 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">Consultez</div>
                                        <div class="text-sm text-gray-600">Les disponibilités</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4 p-4 bg-ctm-cream rounded-xl">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">Contactez</div>
                                        <div class="text-sm text-gray-600">Le professionnel</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Catégories Section -->
        <section class="py-20 bg-ctm-cream">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="font-display text-2xl md:text-3xl text-gray-900 uppercase">
                        Nos catégories de professionnels
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Découvrez les diffèrents types de professionnels pour accompagnér votre enfant
                    </p>
                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow hover:-translate-y-1 transform transition-transform">
                        <div class="w-16 h-16 bg-ctm-burgundy/10 rounded-full flex items-center justify-center mx-auto">
                            <svg class="w-8 h-8 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-gray-900">Psychologue</h3>
                        <p class="mt-2 text-sm text-gray-600">Accompagnement psychologique personnalisé</p>
                    </div>
                    <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow hover:-translate-y-1 transform transition-transform">
                        <div class="w-16 h-16 bg-ctm-teal/10 rounded-full flex items-center justify-center mx-auto">
                            <svg class="w-8 h-8 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-gray-900">Pedopsychiatre</h3>
                        <p class="mt-2 text-sm text-gray-600">Suivi médical spécialise enfants</p>
                    </div>
                    <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow hover:-translate-y-1 transform transition-transform">
                        <div class="w-16 h-16 bg-ctm-burgundy/10 rounded-full flex items-center justify-center mx-auto">
                            <svg class="w-8 h-8 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-gray-900">Thérapeute familial</h3>
                        <p class="mt-2 text-sm text-gray-600">Therapie pour toute la famille</p>
                    </div>
                    <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow hover:-translate-y-1 transform transition-transform">
                        <div class="w-16 h-16 bg-ctm-teal/10 rounded-full flex items-center justify-center mx-auto">
                            <svg class="w-8 h-8 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-gray-900">Coach scolaire</h3>
                        <p class="mt-2 text-sm text-gray-600">Soutien et motivation scolaire</p>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('annuaire') }}" class="inline-flex items-center text-ctm-burgundy font-semibold hover:text-ctm-burgundy-dark transition-colors">
                        Voir tous les professionnels
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-display text-2xl md:text-3xl text-gray-900 uppercase">
                    Vous êtes professionnel ?
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Rejoignez notre annuaire et aidez les familles confrontees à la phobie scolaire a trouver le bon accompagnément.
                </p>
                <div class="mt-8">
                    <a href="{{ route('contact') }}" class="inline-flex items-center bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl">
                        Nous contacter
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-ctm-black text-gray-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('logo-cap-toi-maime.png') }}" alt="Logo" class="h-10 w-10" onerror="this.style.display='none'">
                            <span class="font-display text-lg text-white uppercase">Cap Toi M'aime</span>
                        </div>
                        <p class="mt-4 text-sm text-gray-400 max-w-md">
                            Association dédiée à l'accompagnément des familles confrontees à la phobie scolaire en Suisse romande.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold uppercase text-sm mb-4">Navigation</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('annuaire') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Annuaire</a></li>
                            <li><a href="{{ route('faq') }}" class="text-sm text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                            <li><a href="{{ route('témoignages') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Témoignages</a></li>
                            <li><a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-white transition-colors">À propos</a></li>
                            <li><a href="{{ route('contact') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold uppercase text-sm mb-4">Contact</h3>
                        <ul class="space-y-2">
                            <li class="text-sm text-gray-400">hello@captoimaime.ch</li>
                            <li class="text-sm text-gray-400">Suisse romande</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-800 text-center">
                    <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Cap Toi M'aime. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
