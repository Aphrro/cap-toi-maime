<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Conditions d'utilisation - Cap Toi M'aime</title>
        <meta name="description" content="Conditions générales d'utilisation de la plateforme Cap Toi M'aime.">
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
                        <a href="{{ route('annuaire') }}" class="bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white text-sm font-bold uppercase px-6 py-3 rounded-full transition-all hover:shadow-xl">Trouver un pro</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <section class="py-16 bg-ctm-cream">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
                    <h1 class="text-2xl font-bold text-gray-900 mb-8">Conditions Générales d'Utilisation</h1>
                    <p class="text-sm text-gray-500 mb-8">Dernière mise à jour : {{ date('d/m/Y') }}</p>

                    <div class="prose prose-gray max-w-none space-y-6">
                        <h2 class="text-lg font-semibold text-gray-900">1. Objet</h2>
                        <p class="text-gray-600">
                            Les présentés Conditions Générales d'Utilisation (CGU) regissent l'acces et l'utilisation de la plateforme Cap Toi M'aime, un annuaire en ligne de professionnels spécialises dans l'accompagnément de la phobie scolaire en Suisse romande.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">2. Acceptation des conditions</h2>
                        <p class="text-gray-600">
                            L'utilisation de la plateforme implique l'acceptation pleine et entière des présentés CGU. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser nos services.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">3. Services proposes</h2>
                        <p class="text-gray-600">
                            Cap Toi M'aime propose un annuaire permettant aux familles de trouver des professionnels qualifies pour accompagnér leurs enfants confrontes à la phobie scolaire. Les services incluent :
                        </p>
                        <ul class="list-disc list-inside text-gray-600 ml-4">
                            <li>La consultation de l'annuaire des professionnels</li>
                            <li>La creation d'un compte parent ou professionnel</li>
                            <li>La mise en relation entre familles et professionnels</li>
                        </ul>

                        <h2 class="text-lg font-semibold text-gray-900">4. Inscription des professionnels</h2>
                        <p class="text-gray-600">
                            Les professionnels souhaitant apparaitre dans l'annuaire doivent fournir des informations exactes et verifiables concernant leurs qualifications, diplômes et expérience. Cap Toi M'aime se réservé le droit de vérifiér ces informations et de refuser ou retirer toute inscription ne respectant pas nos critères de qualité.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">5. Responsabilités</h2>
                        <p class="text-gray-600">
                            Cap Toi M'aime agit en tant qu'intermediaire et ne peut être tenu responsable des prestations fournies par les professionnels listes dans l'annuaire. Les utilisateurs sont invites a exercer leur propre jugement dans le choix d'un professionnel.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">6. Propriété intellectuelle</h2>
                        <p class="text-gray-600">
                            L'ensemble du contenu de la plateforme (textes, images, logos, etc.) est protege par le droit d'auteur. Toute reproduction sans autorisation est interdite.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">7. Modification des CGU</h2>
                        <p class="text-gray-600">
                            Cap Toi M'aime se réservé le droit de modifiér les présentés CGU a tout moment. Les utilisateurs seront informes des modifications importantes.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">8. Droit applicable</h2>
                        <p class="text-gray-600">
                            Les présentés CGU sont soumises au droit suisse. Tout litige sera soumis aux tribunaux competents du canton de Vaud.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">9. Contact</h2>
                        <p class="text-gray-600">
                            Pour toute question concernant ces conditions, veuillez nous contacter a : <a href="mailto:hello@captoimaime.ch" class="text-ctm-teal hover:underline">hello@captoimaime.ch</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-ctm-black text-gray-300 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Cap Toi M'aime. Tous droits réservés.</p>
            </div>
        </footer>
    </body>
</html>
