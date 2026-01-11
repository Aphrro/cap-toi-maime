<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A propos - Cap Toi M'aime</title>
        <meta name="description" content="Decouvrez Cap Toi M'aime, association dediee a l'accompagnement des familles confrontees a la phobie scolaire en Suisse romande.">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|bowlby-one-sc:400&display=swap" rel="stylesheet" />
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
                        <a href="{{ route('home') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Accueil</a>
                        <a href="{{ route('about') }}" class="text-ctm-burgundy text-sm font-bold uppercase">A propos</a>
                        <a href="{{ route('faq') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">FAQ</a>
                        <a href="{{ route('temoignages') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Temoignages</a>
                        <a href="{{ route('contact') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Contact</a>
                        <a href="{{ route('login') }}" class="text-gray-500 text-sm hover:text-gray-700 transition-colors">Connexion</a>
                        <a href="{{ route('annuaire') }}" class="bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white text-sm font-bold uppercase px-6 py-3 rounded-full transition-all hover:shadow-xl">Trouver un pro</a>
                    </div>
                    <div class="md:hidden flex items-center">
                        <a href="{{ route('annuaire') }}" class="bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white text-sm font-bold uppercase px-4 py-2 rounded-full">Annuaire</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero -->
        <section class="bg-ctm-burgundy py-16 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-12"></div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
                <h1 class="font-display text-3xl md:text-4xl text-white uppercase">A propos de Cap Toi M'aime</h1>
                <p class="mt-4 text-lg text-ctm-cream">Association dediee a l'accompagnement des familles confrontees a la phobie scolaire</p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-16 bg-ctm-cream">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
                    <div class="prose prose-lg max-w-none">
                        <div class="mb-10">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-ctm-burgundy/10 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900">Notre mission</h2>
                            </div>
                            <p class="text-gray-600 leading-relaxed">
                                Cap Toi M'aime est une association dediee a l'accompagnement des familles confrontees a la phobie scolaire en Suisse romande. Notre annuaire a pour objectif de faciliter la mise en relation entre les familles et les professionnels specialises dans l'accompagnement de la phobie scolaire.
                            </p>
                        </div>

                        <div class="mb-10">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-ctm-teal/10 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900">Pourquoi cet annuaire ?</h2>
                            </div>
                            <p class="text-gray-600 leading-relaxed">
                                Face a la phobie scolaire, les familles se retrouvent souvent demunies et ne savent pas vers qui se tourner. Cet annuaire regroupe des professionnels de confiance, verifies et specialises dans cette problematique specifique.
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-ctm-burgundy/10 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900">Les professionnels</h2>
                            </div>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Notre annuaire regroupe differents types de professionnels :
                            </p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium text-center">Psychologues</span>
                                <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium text-center">Pedopsychiatres</span>
                                <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium text-center">Therapeutes familiaux</span>
                                <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium text-center">Coachs scolaires</span>
                                <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium text-center">Orthopedagogues</span>
                                <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium text-center">Sophrologues</span>
                                <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium text-center">Art-therapeutes</span>
                                <span class="px-4 py-2 bg-ctm-teal/10 text-ctm-teal rounded-xl text-sm font-medium text-center">Hypnotherapeutes</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                        <a href="{{ route('annuaire') }}" class="inline-flex items-center bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl">
                            Consulter l'annuaire
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
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
                            Association dediee a l'accompagnement des familles confrontees a la phobie scolaire en Suisse romande.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold uppercase text-sm mb-4">Navigation</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('annuaire') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Annuaire</a></li>
                            <li><a href="{{ route('faq') }}" class="text-sm text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                            <li><a href="{{ route('temoignages') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Temoignages</a></li>
                            <li><a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-white transition-colors">A propos</a></li>
                            <li><a href="{{ route('contact') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold uppercase text-sm mb-4">Contact</h3>
                        <ul class="space-y-2">
                            <li class="text-sm text-gray-400">contact@captoimaime.ch</li>
                            <li class="text-sm text-gray-400">Suisse romande</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-800 text-center">
                    <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Cap Toi M'aime. Tous droits reserves.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
