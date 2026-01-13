<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Charte Ethique - Cap Toi M'aime</title>
        <meta name="description" content="Charte ethique des professionnels de Cap Toi M'aime.">
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
                    <h1 class="text-2xl font-bold text-gray-900 mb-8">Charte Ethique des Professionnels</h1>
                    <p class="text-sm text-gray-500 mb-8">Dernière mise à jour : {{ date('d/m/Y') }}</p>

                    <div class="prose prose-gray max-w-none space-y-6">
                        <div class="bg-ctm-cream rounded-lg p-6 mb-8">
                            <p class="text-gray-700 italic">
                                En m'inscrivant sur Cap Toi M'aime, je m'engage à respecter les principes ethiques suivants dans ma pratique professionnelle auprès des enfants et familles confrontes à la phobie scolaire.
                            </p>
                        </div>

                        <h2 class="text-lg font-semibold text-gray-900">1. Respect de l'enfant et de sa famille</h2>
                        <p class="text-gray-600">
                            Je m'engage à placer le bien-être de l'enfant au centré de ma pratique. Je respecte sa dignite, son rythme et ses besoins specifiques. J'accueille la famille sans jugement et avec bienveillance, en reconnaissant les difficultés qu'elle traverse.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">2. Competences et formation continue</h2>
                        <p class="text-gray-600">
                            Je m'engage à exercer uniquement dans mon domaine de competence. Je maintiens et developpe mes connaissances par une formation continue, particulièrement sur les problématiques liees à la phobie scolaire, l'anxiété et le refus scolaire.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">3. Honnetété et transparence</h2>
                        <p class="text-gray-600">
                            Je communique de manière claire et honnété sur mes qualifications, mon approché et mes tarifs. Je ne fais pas de promesses de résultats irrealistes. J'informe les familles des limités de mon intervention et les orienté vers d'autrès professionnels si necessaire.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">4. Confidentialite</h2>
                        <p class="text-gray-600">
                            Je respecte le secret professionnel. Toutes les informations partagees par l'enfant et sa famille restent strictement confidentielles, sauf obligation legale ou situation de danger. Je traite les données personnelles conformêment à la legislation en vigueur.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">5. Collaboration pluridisciplinaire</h2>
                        <p class="text-gray-600">
                            Je favorise la collaboration avec les autrès professionnels impliques (école, medecins, thérapeutes) dans l'intérêt de l'enfant. Je communique avec les partenaires avec l'accord des parents et dans le respect de la confidentialite.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">6. Non-discrimination</h2>
                        <p class="text-gray-600">
                            J'accueille toutes les familles sans discrimination basee sur l'origine, la religion, l'orientation sexuelle, le handicap ou la situation économique. Je m'efforce de rendre mes services accessibles au plus grand nombre.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">7. Limites professionnelles</h2>
                        <p class="text-gray-600">
                            Je maintiens des limités professionnelles claires avec les familles accompagnées. Je m'abstiens de toute relation duale (financière, amicale, intime) qui pourrait compromettre la relation professionnelle.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">8. Supervision et entraide</h2>
                        <p class="text-gray-600">
                            Je m'engage à beneficier d'une supervision ou intervision régulière pour maintenir la qualité de ma pratique. Je participe à la reflexion collective et au partage d'expériences avec mes pairs.
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">9. Engagement envers la plateforme</h2>
                        <p class="text-gray-600">
                            Je m'engage à maintenir mon profil à jour sur Cap Toi M'aime. Je réponds aux sollicitations des familles dans un délai raisonnable. Je signalé tout changement de situation (cessation d'activité, changement de coordonnées).
                        </p>

                        <h2 class="text-lg font-semibold text-gray-900">10. Signalement</h2>
                        <p class="text-gray-600">
                            En cas de situation de danger pour un enfant, je respecte mon obligation de signalément aux autorites competentes, conformêment à la legislation suisse sur la protection de l'enfance.
                        </p>

                        <div class="bg-ctm-teal/10 rounded-lg p-6 mt-8">
                            <h3 class="font-semibold text-ctm-teal-dark mb-2">Engagement</h3>
                            <p class="text-gray-600">
                                En cochant la case "J'accepte la charte ethique" lors de mon inscription, je confirme avoir lu et compris cette charte. Je m'engage à la respecter dans l'ensemble de ma pratique professionnelle.
                            </p>
                            <p class="text-gray-600 mt-4">
                                Le non-respect de cette charte peut entrainer la suspension ou le retrait de mon profil de l'annuaire Cap Toi M'aime.
                            </p>
                        </div>

                        <h2 class="text-lg font-semibold text-gray-900">Contact</h2>
                        <p class="text-gray-600">
                            Pour toute question concernant cette charte ethique, contactez-nous à : <a href="mailto:hello@captoimaime.ch" class="text-ctm-teal hover:underline">hello@captoimaime.ch</a>
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
