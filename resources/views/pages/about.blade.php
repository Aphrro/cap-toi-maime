<x-public-layout title="A propos - Cap Toi M'aime">
    <!-- Hero -->
    <section class="bg-ctm-burgundy py-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-12"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <h1 class="font-display text-3xl md:text-4xl text-white uppercase">Pourquoi cet annuaire est ne ?</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-ctm-cream">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p class="text-lg">
                        A force d'echanger avec des familles, nous avons fait le constat suivant :
                    </p>
                    <p>
                        <strong>Trouver un professionnel de sante disponible rapidement</strong> pour accompagner son enfant peut devenir un veritable parcours du combattant. Les delais d'attente s'allongent, les listes d'attente se multiplient, et les parents se retrouvent souvent demunis face a l'urgence de certaines situations.
                    </p>
                    <p>
                        <strong>Notre reponse :</strong> un annuaire associatif, independant et qualifie, pense pour les parents de jeunes en phobie / refus scolaire anxieux (RSA) en Geneve et Suisse romande.
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-10 mb-4">Ce que c'est (et ce que ce n'est pas)</h2>

                    <ul class="space-y-3 list-none pl-0">
                        <li class="flex items-start gap-3">
                            <span class="text-green-500 mt-1">&#x2714;</span>
                            <span>Un outil <strong>reserve aux membres</strong> de Cap Toi M'aime : un avantage concret de l'adhesion, au service des familles.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-green-500 mt-1">&#x2714;</span>
                            <span>Une selection de professionnels <strong>connus de l'association</strong>, qui sont sensibilises et/ou formes a la thematique du refus scolaire anxieux.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-green-500 mt-1">&#x2714;</span>
                            <span>Des fiches claires : specialites, modalites de remboursement (LAMal/LCA/ASCA/RME).</span>
                        </li>
                    </ul>

                    <h2 class="text-2xl font-bold text-gray-800 mt-10 mb-4">Notre "plus" pour vous faire gagner du temps</h2>

                    <ul class="space-y-3 list-none pl-0">
                        <li class="flex items-start gap-3">
                            <span class="text-green-500 mt-1">&#x1F7E2;</span>
                            <span>Un <strong>reperage rapide de la disponibilite</strong> : code simple declare par les professionnels et mis a jour regulierement.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1">&#x1F3A5;</span>
                            <span>Quand c'est possible, une <strong>presentation video</strong> du praticien pour "mettre un visage sur un nom" et comprendre son approche avant de reserver.</span>
                        </li>
                    </ul>

                    <div class="bg-gray-100 rounded-xl p-6 my-8">
                        <h3 class="font-bold text-gray-800 mb-3">Legende disponibilite</h3>
                        <div class="flex flex-wrap gap-4">
                            <span class="flex items-center gap-2">
                                <span class="w-4 h-4 bg-green-500 rounded-full"></span>
                                Prend de nouveaux patients
                            </span>
                            <span class="flex items-center gap-2">
                                <span class="w-4 h-4 bg-orange-500 rounded-full"></span>
                                RDV sous 2-4 semaines
                            </span>
                            <span class="flex items-center gap-2">
                                <span class="w-4 h-4 bg-gray-400 rounded-full"></span>
                                Liste d'attente
                            </span>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-800 mt-10 mb-4">Pourquoi nous l'avons construit ainsi ?</h2>

                    <p>
                        Notre but est de <strong>reduire l'errance therapeutique</strong>, rassurer les parents et faciliter un premier pas utile. Nous avons aussi concu l'outil pour qu'il reste leger a maintenir : informations standardisees, auto-declarees par les pros, et revues periodiquement par l'association.
                    </p>

                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mt-8">
                        <h3 class="font-bold text-amber-800 mb-2">&#x26A0;&#xFE0F; Limites et rappel important</h3>
                        <p class="text-amber-900 mb-0">
                            Cet annuaire est informatif : il ne remplace pas un avis medical et n'engage pas une garantie de resultat clinique. Chaque famille reste libre de son choix ; l'association met a disposition des informations fiables et actualisees pour faciliter l'orientation.
                        </p>
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
</x-public-layout>
