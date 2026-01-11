<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Temoignages - Cap Toi M'aime</title>
        <meta name="description" content="Decouvrez les temoignages de familles accompagnees face a la phobie scolaire en Suisse romande.">
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
                        <a href="{{ route('about') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">A propos</a>
                        <a href="{{ route('faq') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">FAQ</a>
                        <a href="{{ route('temoignages') }}" class="text-ctm-burgundy text-sm font-bold uppercase">Temoignages</a>
                        <a href="{{ route('contact') }}" class="text-ctm-teal text-sm font-bold uppercase hover:text-ctm-teal-dark transition-colors">Contact</a>
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
                <h1 class="font-display text-3xl md:text-4xl text-white uppercase">Temoignages</h1>
                <p class="mt-4 text-lg text-ctm-cream">Ce que les familles disent de leur experience</p>
            </div>
        </section>

        <!-- Testimonials Grid -->
        <section class="py-16 bg-ctm-cream">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($testimonials->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-ctm-teal/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Aucun temoignage pour le moment</h2>
                        <p class="text-gray-600">Les temoignages seront bientot disponibles.</p>
                    </div>
                @else
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($testimonials as $testimonial)
                            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col">
                                <!-- Stars -->
                                <div class="flex items-center mb-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>

                                <!-- Quote icon -->
                                <div class="text-ctm-teal/30 mb-2">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                    </svg>
                                </div>

                                <!-- Content -->
                                <p class="text-gray-600 flex-grow mb-6 leading-relaxed">{{ $testimonial->content }}</p>

                                <!-- Author -->
                                <div class="border-t border-gray-100 pt-4 mt-auto">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-ctm-burgundy/10 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-ctm-burgundy font-semibold">{{ strtoupper(substr($testimonial->author_name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $testimonial->author_name }}</p>
                                            @if($testimonial->author_role)
                                                <p class="text-sm text-gray-500">{{ $testimonial->author_role }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- CTA -->
                <div class="mt-12 bg-white rounded-2xl shadow-lg p-8 text-center">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Vous souhaitez partager votre experience ?</h2>
                    <p class="text-gray-600 mb-6">Votre temoignage peut aider d'autres familles confrontees a la phobie scolaire.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-6 py-3 rounded-full transition-all hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Nous contacter
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
                            Association dediee a l'accompagnement des familles confrontees a la phobie scolaire en Suisse romande.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold uppercase text-sm mb-4">Navigation</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('annuaire') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Annuaire</a></li>
                            <li><a href="{{ route('faq') }}" class="text-sm text-gray-400 hover:text-white transition-colors">FAQ</a></li>
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
