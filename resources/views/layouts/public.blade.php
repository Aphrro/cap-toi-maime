<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $siteName = \App\Models\Setting::get('site_name', 'Cap Toi M\'aime');
            $siteLogo = \App\Models\Setting::get('site_logo');
            $siteFavicon = \App\Models\Setting::get('site_favicon');

            $navbarConfigJson = \App\Models\Setting::get('navbar_config', '{}');
            $navbarConfig = json_decode($navbarConfigJson, true) ?? [];
            $navbarLinks = $navbarConfig['links'] ?? [
                ['label' => 'Accueil', 'url' => '/', 'is_active' => true],
                ['label' => 'A propos', 'url' => '/a-propos', 'is_active' => true],
                ['label' => 'FAQ', 'url' => '/faq', 'is_active' => true],
                ['label' => 'Temoignages', 'url' => '/temoignages', 'is_active' => true],
                ['label' => 'Contact', 'url' => '/contact', 'is_active' => true],
                ['label' => 'Espace Pro', 'url' => '/espace-pro', 'is_active' => true],
            ];
            $navbarCtaText = $navbarConfig['cta_text'] ?? 'Trouver un pro';
            $navbarCtaUrl = $navbarConfig['cta_url'] ?? '/annuaire';
            $navbarCtaVisible = $navbarConfig['cta_visible'] ?? true;

            $footerConfigJson = \App\Models\Setting::get('footer_config', '{}');
            $footerConfig = json_decode($footerConfigJson, true) ?? [];
            $footerDescription = $footerConfig['description'] ?? 'Association dediee a l\'accompagnement des familles confrontees a la phobie scolaire en Suisse romande.';
            $footerColumns = $footerConfig['columns'] ?? [
                [
                    'title' => 'Navigation',
                    'links' => [
                        ['label' => 'Annuaire', 'url' => '/annuaire'],
                        ['label' => 'FAQ', 'url' => '/faq'],
                        ['label' => 'Temoignages', 'url' => '/temoignages'],
                        ['label' => 'A propos', 'url' => '/a-propos'],
                        ['label' => 'Contact', 'url' => '/contact'],
                    ]
                ],
                [
                    'title' => 'Legal',
                    'links' => [
                        ['label' => 'Conditions d\'utilisation', 'url' => '/conditions-utilisation'],
                        ['label' => 'Politique de confidentialite', 'url' => '/politique-confidentialite'],
                        ['label' => 'Charte ethique', 'url' => '/charte-ethique'],
                    ]
                ],
                [
                    'title' => 'Contact',
                    'links' => [
                        ['label' => 'hello@captoimaime.ch', 'url' => 'mailto:hello@captoimaime.ch'],
                    ]
                ],
            ];
            $footerSocial = $footerConfig['social'] ?? [
                'facebook' => 'https://www.facebook.com/captoimaime',
                'instagram' => 'https://www.instagram.com/captoimaime',
                'linkedin' => 'https://www.linkedin.com/company/captoimaime',
                'twitter' => '',
            ];
            $footerCopyright = $footerConfig['copyright'] ?? '&copy; ' . date('Y') . ' Cap Toi M\'aime. Tous droits reserves.';
            $footerContactEmail = $footerConfig['contact_email'] ?? 'hello@captoimaime.ch';
            $footerContactLocation = $footerConfig['contact_location'] ?? 'Suisse romande';
            $footerExternalSite = $footerConfig['external_site'] ?? [
                'text' => 'Site principal',
                'url' => 'https://www.captoimaime.ch',
            ];
        @endphp

        <title>{{ $title ?? $siteName . ' - Annuaire phobie scolaire Suisse romande' }}</title>
        <meta name="description" content="Trouvez des therapeutes specialises dans le refus scolaire anxieux en Suisse romande.">

        @if($siteFavicon)
        <link rel="icon" href="{{ Storage::url($siteFavicon) }}" type="image/x-icon">
        @endif

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
                            @if($siteLogo)
                            <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" class="h-12 w-12">
                            @else
                            <img src="{{ asset('logo-cap-toi-maime.png') }}" alt="Logo" class="h-12 w-12" onerror="this.style.display='none'">
                            @endif
                            <span class="font-display text-xl text-ctm-burgundy uppercase tracking-wide hidden sm:inline">{{ $siteName }}</span>
                        </a>
                    </div>
                    <!-- Desktop menu -->
                    <div class="hidden md:flex items-center space-x-1">
                        @foreach($navbarLinks as $link)
                            @if($link['is_active'] ?? true)
                            @php
                                $linkPath = trim($link['url'], '/');
                                $currentPath = request()->path();
                                $isActive = ($linkPath === '' && $currentPath === '/')
                                         || ($linkPath !== '' && ($currentPath === $linkPath || str_starts_with($currentPath, $linkPath . '/')));
                            @endphp
                            <a href="{{ $link['url'] }}"
                               class="relative px-4 py-2 text-sm font-medium whitespace-nowrap {{ $isActive ? 'text-ctm-teal' : 'text-gray-600 hover:text-ctm-teal' }} transition-colors duration-200">
                                {{ $link['label'] }}
                                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 bg-ctm-teal rounded-full transition-all duration-200 {{ $isActive ? 'w-6' : 'w-0' }}"></span>
                            </a>
                            @endif
                        @endforeach
                        @if($navbarCtaVisible)
                        <a href="{{ $navbarCtaUrl }}" class="ml-6 bg-ctm-teal hover:bg-ctm-teal-dark text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-200 shadow-sm hover:shadow-md">
                            {{ $navbarCtaText }}
                        </a>
                        @endif
                    </div>
                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center space-x-3">
                        @if($navbarCtaVisible)
                        <a href="{{ $navbarCtaUrl }}" class="bg-ctm-teal hover:bg-ctm-teal-dark text-white text-xs font-bold px-4 py-2 rounded-full shadow-sm">
                            {{ $navbarCtaText }}
                        </a>
                        @endif
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
                class="md:hidden bg-white border-t border-gray-100 shadow-lg absolute left-0 right-0"
                x-cloak
            >
                <div class="px-4 py-4 space-y-1">
                    @foreach($navbarLinks as $link)
                        @if($link['is_active'] ?? true)
                        @php
                            $linkPath = trim($link['url'], '/');
                            $currentPath = request()->path();
                            $isActiveMobile = ($linkPath === '' && $currentPath === '/')
                                     || ($linkPath !== '' && ($currentPath === $linkPath || str_starts_with($currentPath, $linkPath . '/')));
                        @endphp
                        <a href="{{ $link['url'] }}" class="block px-4 py-3 rounded-lg text-base font-medium transition-colors {{ $isActiveMobile ? 'bg-ctm-teal/10 text-ctm-teal border-l-4 border-ctm-teal' : 'text-gray-700 hover:bg-gray-50' }}">
                            {{ $link['label'] }}
                        </a>
                        @endif
                    @endforeach
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
                    {{-- Logo & Description Column --}}
                    <div class="md:col-span-1">
                        <div class="flex items-center space-x-3">
                            @if($siteLogo)
                            <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" class="h-10 w-10">
                            @else
                            <img src="{{ asset('logo-cap-toi-maime.png') }}" alt="Logo" class="h-10 w-10" onerror="this.style.display='none'">
                            @endif
                            <span class="font-display text-lg text-white uppercase">{{ $siteName }}</span>
                        </div>
                        <p class="mt-4 text-sm text-gray-400 max-w-md">
                            {{ $footerDescription }}
                        </p>
                        {{-- Social Links --}}
                        <div class="mt-6 flex space-x-4">
                            @if(!empty($footerSocial['facebook']))
                            <a href="{{ $footerSocial['facebook'] }}" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition-colors" aria-label="Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            </a>
                            @endif
                            @if(!empty($footerSocial['instagram']))
                            <a href="{{ $footerSocial['instagram'] }}" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition-colors" aria-label="Instagram">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                            </a>
                            @endif
                            @if(!empty($footerSocial['linkedin']))
                            <a href="{{ $footerSocial['linkedin'] }}" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition-colors" aria-label="LinkedIn">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                            @endif
                            @if(!empty($footerSocial['twitter']))
                            <a href="{{ $footerSocial['twitter'] }}" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition-colors" aria-label="Twitter">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            @endif
                        </div>
                    </div>

                    {{-- Dynamic Footer Columns --}}
                    @foreach($footerColumns as $column)
                    <div>
                        <h3 class="text-white font-semibold uppercase text-sm mb-4">{{ $column['title'] ?? '' }}</h3>
                        @if(!empty($column['links']))
                        <ul class="space-y-2">
                            @foreach($column['links'] as $link)
                            <li>
                                <a href="{{ $link['url'] ?? '#' }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                                    {{ $link['label'] ?? '' }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        {{-- Contact info for contact column --}}
                        @if(strtolower($column['title'] ?? '') === 'contact')
                        @if(!empty($footerContactLocation))
                        <p class="mt-2 text-sm text-gray-400">{{ $footerContactLocation }}</p>
                        @endif
                        @if(!empty($footerExternalSite['url']))
                        <div class="mt-4">
                            <a href="{{ $footerExternalSite['url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm text-ctm-teal hover:text-ctm-teal-light transition-colors">
                                {{ $footerExternalSite['text'] ?? 'Site principal' }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                        @endif
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500">{!! $footerCopyright !!}</p>
                    <p class="text-xs text-gray-600">Annuaire de professionnels specialises dans le refus scolaire anxieux</p>
                </div>
            </div>
        </footer>
    </body>
</html>
