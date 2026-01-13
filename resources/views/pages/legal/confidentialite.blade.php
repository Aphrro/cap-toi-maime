<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Politique de confidentialite - Cap Toi M'aime</title>
        <meta name="description" content="Politique de confidentialite et protection des donnees de Cap Toi M'aime.">
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
                    <h1 class="text-2xl font-bold text-gray-900 mb-8">Politique de Confidentialite</h1>
                    <p class="text-sm text-gray-500 mb-8">Derniere mise a jour : {{ date('d/m/Y') }}</p>

                    <div class="prose prose-gray max-w-none space-y-6">
                        <h2 class="text-lg font-semibold text-gray-900">1. Introduction</h2>
                        <p class="text-gray-600">
                            Cap Toi M'aime s'engage a proteger la vie privee des utilisateurs de sa plateforme. Cette politique de confidentialite explique comment nous collectons, utilisons et protegeons vos donnees personnelles conformement a la Loi federale sur la protection des donnees (LPD) et au Reglement general sur la protection des donnees (RGPD).
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">2. Donnees collectees</h2>
                        <p class="text-gray-600">Nous collectons les donnees suivantes :</p>
                        <ul class="list-disc list-inside text-gray-600 ml-4">
                            <li><strong>Parents :</strong> Nom, prenom, email, telephone, informations sur les enfants (prenom, age, problematique)</li>
                            <li><strong>Professionnels :</strong> Nom, prenom, email, telephone, adresse professionnelle, diplomes, numero professionnel, experience, biographie</li>
                            <li><strong>Donnees de navigation :</strong> Adresse IP, cookies, pages visitees</li>
                        </ul>

                        <h2 class="text-lg font-semibold text-gray-900">3. Utilisation des donnees</h2>
                        <p class="text-gray-600">Vos donnees sont utilisees pour :</p>
                        <ul class="list-disc list-inside text-gray-600 ml-4">
                            <li>Gerer votre compte et vos preferences</li>
                            <li>Afficher les profils des professionnels dans l'annuaire</li>
                            <li>Faciliter la mise en relation entre familles et professionnels</li>
                            <li>Ameliorer nos services</li>
                            <li>Vous envoyer des communications importantes</li>
                        </ul>

                        <h2 class="text-lg font-semibold text-gray-900">4. Protection des donnees</h2>
                        <p class="text-gray-600">
                            Nous mettons en oeuvre des mesures de securite techniques et organisationnelles pour proteger vos donnees contre tout acces non autorise, modification, divulgation ou destruction. Les donnees sensibles sont chiffrees et stockees sur des serveurs securises en Suisse.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">5. Partage des donnees</h2>
                        <p class="text-gray-600">
                            Nous ne vendons pas vos donnees personnelles. Les informations des professionnels sont visibles publiquement dans l'annuaire (apres validation). Les donnees des parents restent confidentielles et ne sont pas partagees sans consentement.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">6. Conservation des donnees</h2>
                        <p class="text-gray-600">
                            Vos donnees sont conservees aussi longtemps que votre compte est actif. En cas de suppression de compte, vos donnees seront effacees dans un delai de 30 jours, sauf obligation legale de conservation.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">7. Vos droits</h2>
                        <p class="text-gray-600">Conformement a la LPD et au RGPD, vous disposez des droits suivants :</p>
                        <ul class="list-disc list-inside text-gray-600 ml-4">
                            <li>Droit d'acces a vos donnees</li>
                            <li>Droit de rectification</li>
                            <li>Droit a l'effacement</li>
                            <li>Droit a la portabilite</li>
                            <li>Droit d'opposition au traitement</li>
                        </ul>
                        <p class="text-gray-600">
                            Pour exercer ces droits, contactez-nous a : <a href="mailto:hello@captoimaime.ch" class="text-ctm-teal hover:underline">hello@captoimaime.ch</a>
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">8. Cookies</h2>
                        <p class="text-gray-600">
                            Notre site utilise des cookies essentiels au fonctionnement de la plateforme. Vous pouvez configurer votre navigateur pour refuser les cookies, mais certaines fonctionnalites pourraient ne plus etre disponibles.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">9. Contact</h2>
                        <p class="text-gray-600">
                            Pour toute question concernant cette politique de confidentialite, contactez notre delegue a la protection des donnees : <a href="mailto:hello@captoimaime.ch" class="text-ctm-teal hover:underline">hello@captoimaime.ch</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-ctm-black text-gray-300 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Cap Toi M'aime. Tous droits reserves.</p>
            </div>
        </footer>
    </body>
</html>
