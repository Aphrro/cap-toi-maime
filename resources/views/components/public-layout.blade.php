@props(['title' => 'Cap Toi M\'aime - Annuaire phobie scolaire Suisse romande'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>
        <meta name="description" content="Trouvez des therapeutes specialises dans le refus scolaire anxieux en Suisse romande.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|bowlby-one-sc:400&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white">
        <!-- Navigation -->
        <nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm" x-data="{ mobileMenuOpen: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3">
                            <img src="{{ asset('logo-cap-toi-maime.png') }}" alt="Logo" class="h-12 w-12" onerror="this.style.display='none'">
                            <span class="font-display text-xl text-ctm-burgundy uppercase tracking-wide hidden sm:inline">Cap Toi M'aime</span>
                        </a>
                    </div>
                    <!-- Desktop menu -->
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-sm font-bold uppercase transition-colors {{ request()->routeIs('home') ? 'text-ctm-burgundy' : 'text-ctm-teal hover:text-ctm-teal-dark' }}">Accueil</a>
                        <a href="{{ route('about') }}" class="text-sm font-bold uppercase transition-colors {{ request()->routeIs('about') ? 'text-ctm-burgundy' : 'text-ctm-teal hover:text-ctm-teal-dark' }}">A propos</a>
                        <a href="{{ route('faq') }}" class="text-sm font-bold uppercase transition-colors {{ request()->routeIs('faq') ? 'text-ctm-burgundy' : 'text-ctm-teal hover:text-ctm-teal-dark' }}">FAQ</a>
                        <a href="{{ route('temoignages') }}" class="text-sm font-bold uppercase transition-colors {{ request()->routeIs('temoignages') ? 'text-ctm-burgundy' : 'text-ctm-teal hover:text-ctm-teal-dark' }}">Temoignages</a>
                        <a href="{{ route('contact') }}" class="text-sm font-bold uppercase transition-colors {{ request()->routeIs('contact') ? 'text-ctm-burgundy' : 'text-ctm-teal hover:text-ctm-teal-dark' }}">Contact</a>
                        <a href="{{ route('espace-pro') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Espace Pro</a>
                        <a href="{{ route('annuaire') }}" class="bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white text-sm font-bold uppercase px-6 py-3 rounded-full transition-all hover:shadow-xl">Trouver un pro</a>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center space-x-3">
                        <a href="{{ route('annuaire') }}" class="bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white text-xs font-bold uppercase px-3 py-2 rounded-full">
                            Annuaire
                        </a>
                        <button
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="p-2 rounded-lg text-ctm-teal hover:bg-gray-100 transition-colors"
                            aria-label="Menu"
                        >
                            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="md:hidden bg-white border-t border-gray-100 shadow-lg"
                x-cloak
            >
                <div class="px-4 py-4 space-y-1">
                    <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-ctm-burgundy/10 text-ctm-burgundy' : 'text-gray-700 hover:bg-gray-50' }}">
                        Accueil
                    </a>
                    <a href="{{ route('annuaire') }}" class="block px-4 py-3 rounded-xl text-base font-semibold transition-colors {{ request()->routeIs('annuaire') ? 'bg-ctm-burgundy/10 text-ctm-burgundy' : 'text-gray-700 hover:bg-gray-50' }}">
                        Trouver un professionnel
                    </a>
                    <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl text-base font-semibold transition-colors {{ request()->routeIs('about') ? 'bg-ctm-burgundy/10 text-ctm-burgundy' : 'text-gray-700 hover:bg-gray-50' }}">
                        A propos
                    </a>
                    <a href="{{ route('faq') }}" class="block px-4 py-3 rounded-xl text-base font-semibold transition-colors {{ request()->routeIs('faq') ? 'bg-ctm-burgundy/10 text-ctm-burgundy' : 'text-gray-700 hover:bg-gray-50' }}">
                        FAQ
                    </a>
                    <a href="{{ route('temoignages') }}" class="block px-4 py-3 rounded-xl text-base font-semibold transition-colors {{ request()->routeIs('temoignages') ? 'bg-ctm-burgundy/10 text-ctm-burgundy' : 'text-gray-700 hover:bg-gray-50' }}">
                        Temoignages
                    </a>
                    <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl text-base font-semibold transition-colors {{ request()->routeIs('contact') ? 'bg-ctm-burgundy/10 text-ctm-burgundy' : 'text-gray-700 hover:bg-gray-50' }}">
                        Contact
                    </a>
                    <div class="border-t border-gray-100 my-2 pt-2">
                        <a href="{{ route('espace-pro') }}" class="block px-4 py-3 rounded-xl text-base font-semibold text-ctm-teal hover:bg-ctm-teal/10 transition-colors">
                            Espace Pro
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

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
