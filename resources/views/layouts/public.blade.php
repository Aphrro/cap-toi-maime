<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Cap Toi M\'aime - Annuaire phobie scolaire Suisse romande' }}</title>
        <meta name="description" content="Trouvez des thérapeutes spécialises dans le refus scolaire anxieux en Suisse romande.">

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
                        <a href="{{ route('about') }}" class="text-sm font-bold uppercase transition-colors {{ request()->routeIs('about') ? 'text-ctm-burgundy' : 'text-ctm-teal hover:text-ctm-teal-dark' }}">À propos</a>
                        <a href="{{ route('faq') }}" class="text-sm font-bold uppercase transition-colors {{ request()->routeIs('faq') ? 'text-ctm-burgundy' : 'text-ctm-teal hover:text-ctm-teal-dark' }}">FAQ</a>
                        <a href="{{ route('temoignages') }}" class="text-sm font-bold uppercase transition-colors {{ request()->routeIs('temoignages') ? 'text-ctm-burgundy' : 'text-ctm-teal hover:text-ctm-teal-dark' }}">Témoignages</a>
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
                        À propos
                    </a>
                    <a href="{{ route('faq') }}" class="block px-4 py-3 rounded-xl text-base font-semibold transition-colors {{ request()->routeIs('faq') ? 'bg-ctm-burgundy/10 text-ctm-burgundy' : 'text-gray-700 hover:bg-gray-50' }}">
                        FAQ
                    </a>
                    <a href="{{ route('temoignages') }}" class="block px-4 py-3 rounded-xl text-base font-semibold transition-colors {{ request()->routeIs('temoignages') ? 'bg-ctm-burgundy/10 text-ctm-burgundy' : 'text-gray-700 hover:bg-gray-50' }}">
                        Témoignages
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
                    <div class="md:col-span-1">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('logo-cap-toi-maime.png') }}" alt="Logo" class="h-10 w-10" onerror="this.style.display='none'">
                            <span class="font-display text-lg text-white uppercase">Cap Toi M'aime</span>
                        </div>
                        <p class="mt-4 text-sm text-gray-400 max-w-md">
                            Association dediee a l'accompagnement des familles confrontees a la phobie scolaire en Suisse romande.
                        </p>
                        {{-- Social Links --}}
                        <div class="mt-6 flex space-x-4">
                            <a href="https://www.facebook.com/captoimaime" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition-colors" aria-label="Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            </a>
                            <a href="https://www.instagram.com/captoimaime" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition-colors" aria-label="Instagram">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/company/captoimaime" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition-colors" aria-label="LinkedIn">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        </div>
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
                        <h3 class="text-white font-semibold uppercase text-sm mb-4">Legal</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('conditions') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Conditions d'utilisation</a></li>
                            <li><a href="{{ route('confidentialite') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Politique de confidentialite</a></li>
                            <li><a href="{{ route('charte-ethique') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Charte ethique</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold uppercase text-sm mb-4">Contact</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="mailto:hello@captoimaime.ch" class="text-sm text-gray-400 hover:text-white transition-colors">hello@captoimaime.ch</a>
                            </li>
                            <li class="text-sm text-gray-400">Suisse romande</li>
                        </ul>
                        <div class="mt-6">
                            <a href="https://www.captoimaime.ch" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm text-ctm-teal hover:text-ctm-teal-light transition-colors">
                                Site principal
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Cap Toi M'aime. Tous droits reserves.</p>
                    <p class="text-xs text-gray-600">Annuaire de professionnels specialises dans le refus scolaire anxieux</p>
                </div>
            </div>
        </footer>
    </body>
</html>
