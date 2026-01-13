<x-public-layout title="A propos - Cap Toi M'aime">
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-ctm-burgundy to-ctm-burgundy-dark text-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                        Pourquoi cet annuaire est ne ?
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 mb-8">
                        A force d'echanger avec des familles, nous avons fait un constat : trouver un professionnel disponible rapidement peut devenir un veritable parcours du combattant.
                    </p>
                    <a href="{{ route('annuaire') }}" class="inline-flex items-center gap-2 bg-white text-ctm-burgundy hover:bg-gray-100 font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl text-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Consulter l'annuaire
                    </a>
                </div>
                <div class="hidden md:flex justify-center">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8">
                        <div class="grid grid-cols-1 gap-6 text-center">
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">Reserve aux membres</div>
                                    <div class="text-white/80 text-sm">Avantage de l'adhesion</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">Professionnels verifies</div>
                                    <div class="text-white/80 text-sm">Formes au RSA</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">Disponibilite en temps reel</div>
                                    <div class="text-white/80 text-sm">Mise a jour reguliere</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Notre reponse --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Notre reponse</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Un annuaire associatif, independant et qualifie, pense pour les parents de jeunes en phobie / refus scolaire anxieux (RSA) en Suisse romande.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Reserve aux membres</h3>
                    <p class="text-gray-600">Un outil reserve aux membres de Cap Toi M'aime : un avantage concret de l'adhesion, au service des familles.</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-ctm-teal/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Professionnels selectionnes</h3>
                    <p class="text-gray-600">Une selection de professionnels connus de l'association, sensibilises et/ou formes a la thematique du refus scolaire anxieux.</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-ctm-burgundy/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fiches claires</h3>
                    <p class="text-gray-600">Des fiches detaillees : specialites, modalites de remboursement (LAMal/LCA/ASCA/RME), disponibilite en temps reel.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Nos plus --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Notre "plus" pour vous faire gagner du temps</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">&#x1F7E2;</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Reperage rapide de la disponibilite</h3>
                            <p class="text-gray-600">Code simple declare par les professionnels et mis a jour regulierement.</p>
                            <div class="flex flex-wrap gap-3 mt-4">
                                <span class="flex items-center gap-2 text-sm">
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    Disponible
                                </span>
                                <span class="flex items-center gap-2 text-sm">
                                    <span class="w-3 h-3 bg-orange-500 rounded-full"></span>
                                    2-4 semaines
                                </span>
                                <span class="flex items-center gap-2 text-sm">
                                    <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                                    Liste d'attente
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-ctm-burgundy/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">&#x1F3A5;</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Presentation video</h3>
                            <p class="text-gray-600">Quand c'est possible, une presentation video du praticien pour "mettre un visage sur un nom" et comprendre son approche avant de reserver.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pourquoi --}}
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Pourquoi nous l'avons construit ainsi ?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Notre but est de reduire l'errance therapeutique, rassurer les parents et faciliter un premier pas utile.</p>
            </div>

            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-amber-800 mb-2">Limites et rappel important</h3>
                        <p class="text-amber-900">Cet annuaire est informatif : il ne remplace pas un avis medical et n'engage pas une garantie de resultat clinique. Chaque famille reste libre de son choix ; l'association met a disposition des informations fiables et actualisees pour faciliter l'orientation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-ctm-burgundy text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Pret a trouver le bon professionnel ?</h2>
            <p class="text-white/80 mb-8 text-lg">Consultez notre annuaire de professionnels specialises.</p>
            <a href="{{ route('annuaire') }}" class="inline-flex items-center gap-2 bg-white text-ctm-burgundy hover:bg-gray-100 font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl text-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Consulter l'annuaire
            </a>
        </div>
    </section>
</x-public-layout>
