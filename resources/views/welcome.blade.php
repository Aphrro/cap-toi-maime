<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cap Toi M'aime - Annuaire phobie scolaire Suisse romande</title>
        <meta name="description" content="Annuaire de professionnels specialises dans la phobie scolaire en Suisse romande. Trouvez psychologues, therapeutes et coachs scolaires pres de chez vous.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-900">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                            Cap Toi M'aime
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('annuaire') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            Annuaire
                        </a>
                        <a href="{{ route('about') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            A propos
                        </a>
                        <a href="{{ route('contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            Contact
                        </a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    Tableau de bord
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    Connexion
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative bg-indigo-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        Trouvez le bon professionnel
                    </h1>
                    <p class="mt-6 text-xl text-indigo-100 max-w-3xl mx-auto">
                        Annuaire de professionnels specialises dans l'accompagnement de la phobie scolaire en Suisse romande
                    </p>
                    <div class="mt-10">
                        <a href="{{ route('annuaire') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-600 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white">
                            Consulter l'annuaire
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="py-16 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        Nos categories de professionnels
                    </h2>
                    <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                        Decouvrez les differents types de professionnels pour accompagner votre enfant
                    </p>
                </div>

                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-4">🧠</div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Psychologue</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Accompagnement psychologique personnalise</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-4">💙</div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pedopsychiatre</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Suivi medical specialise enfants</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-4">👨‍👩‍👧</div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Therapeute familial</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Therapie pour toute la famille</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
                        <div class="text-4xl mb-4">🎓</div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Coach scolaire</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Soutien et motivation scolaire</p>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('annuaire') }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                        Voir tous les professionnels →
                    </a>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-indigo-50 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    <span class="block">Vous etes professionnel ?</span>
                    <span class="block text-indigo-600 dark:text-indigo-400">Rejoignez notre annuaire.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-400 text-sm">
                        &copy; {{ date('Y') }} Cap Toi M'aime. Tous droits reserves.
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-6">
                        <a href="{{ route('about') }}" class="text-gray-400 hover:text-gray-500 text-sm">A propos</a>
                        <a href="{{ route('contact') }}" class="text-gray-400 hover:text-gray-500 text-sm">Contact</a>
                        <a href="{{ route('annuaire') }}" class="text-gray-400 hover:text-gray-500 text-sm">Annuaire</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
