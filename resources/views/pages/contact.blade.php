<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact - Cap Toi M'aime</title>
        <meta name="description" content="Contactez Cap Toi M'aime pour toute question concernant la phobie scolaire en Suisse romande.">
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
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Accueil</a>
                        <a href="{{ route('annuaire') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Annuaire</a>
                        <a href="{{ route('about') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">A propos</a>
                        <a href="{{ route('contact') }}" class="text-ctm-burgundy text-sm font-bold uppercase">Contact</a>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Tableau de bord</a>
                        @endauth
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
                <h1 class="font-display text-3xl md:text-4xl text-white uppercase">Contact</h1>
                <p class="mt-4 text-lg text-ctm-cream">Vous avez des questions ? N'hesitez pas a nous contacter</p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-16 bg-ctm-cream">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Contact Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Informations de contact</h2>

                        <div class="space-y-6">
                            <a href="mailto:contact@captoimaime.ch" class="flex items-center p-4 bg-ctm-cream rounded-xl hover:bg-ctm-teal/10 transition-colors group">
                                <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 group-hover:bg-ctm-teal/30 transition-colors">
                                    <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Email</div>
                                    <div class="text-ctm-teal font-medium">contact@captoimaime.ch</div>
                                </div>
                            </a>

                            <a href="https://captoimaime.ch" target="_blank" rel="noopener noreferrer" class="flex items-center p-4 bg-ctm-cream rounded-xl hover:bg-ctm-teal/10 transition-colors group">
                                <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 group-hover:bg-ctm-teal/30 transition-colors">
                                    <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Site web</div>
                                    <div class="text-ctm-teal font-medium">captoimaime.ch</div>
                                </div>
                            </a>

                            <div class="flex items-center p-4 bg-ctm-cream rounded-xl">
                                <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Region</div>
                                    <div class="text-gray-900 font-medium">Suisse romande</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional CTA -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-ctm-burgundy/10 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900">Vous etes professionnel ?</h2>
                        </div>

                        <p class="text-gray-600 mb-6">
                            Si vous etes un professionnel specialise dans l'accompagnement de la phobie scolaire et souhaitez apparaitre dans notre annuaire, contactez-nous par email avec les informations suivantes :
                        </p>

                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-ctm-teal mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Votre nom et prenom
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-ctm-teal mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Votre profession et specialites
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-ctm-teal mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Votre lieu d'exercice (ville, canton)
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-ctm-teal mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Vos coordonnees de contact
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-ctm-teal mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Une courte presentation de votre approche
                            </li>
                        </ul>

                        <a href="mailto:contact@captoimaime.ch?subject=Demande%20d%27inscription%20annuaire" class="inline-flex items-center bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-6 py-3 rounded-full transition-all hover:shadow-xl w-full justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Nous contacter
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
