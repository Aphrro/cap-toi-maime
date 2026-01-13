<x-public-layout title="FAQ - Cap Toi M'aime">
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-ctm-burgundy to-ctm-burgundy-dark text-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                        Questions Frequentes
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 mb-8">
                        Trouvez des reponses a vos questions sur la phobie scolaire, l'annuaire et l'adhesion.
                    </p>
                </div>
                <div class="hidden md:flex justify-center">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">Reponses rapides</div>
                                    <div class="text-white/80 text-sm">Informations essentielles</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">Comprendre le RSA</div>
                                    <div class="text-white/80 text-sm">Refus scolaire anxieux</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">Besoin d'aide ?</div>
                                    <div class="text-white/80 text-sm">Contactez-nous</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Quick Links (Mobile) --}}
    <section class="py-6 bg-white md:hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-3 overflow-x-auto pb-2">
                <a href="#faq-section" class="flex-shrink-0 bg-ctm-burgundy/10 text-ctm-burgundy px-4 py-2 rounded-full text-sm font-medium">
                    Voir les questions
                </a>
                <a href="{{ route('contact') }}" class="flex-shrink-0 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium">
                    Nous contacter
                </a>
            </div>
        </div>
    </section>

    {{-- FAQ Accordion --}}
    <section id="faq-section" class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Toutes les questions</h2>
                <p class="text-gray-600">Cliquez sur une question pour voir la reponse</p>
            </div>

            <div class="space-y-4" x-data="{ openIndex: null }">
                @foreach(config('faq') as $index => $item)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                        <button
                            @click="openIndex = openIndex === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors"
                        >
                            <span class="font-semibold text-gray-900 pr-4">{{ $item['question'] }}</span>
                            <div class="w-8 h-8 bg-ctm-burgundy/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg
                                    class="w-4 h-4 text-ctm-burgundy transition-transform duration-200"
                                    :class="{ 'rotate-180': openIndex === {{ $index }} }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        <div
                            x-show="openIndex === {{ $index }}"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1"
                            class="px-6 pb-5 border-t border-gray-100"
                        >
                            <p class="text-gray-600 leading-relaxed pt-4">{{ $item['answer'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Help Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-50 rounded-2xl p-8 md:p-12">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-ctm-burgundy/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Vous ne trouvez pas la reponse ?</h2>
                    <p class="text-gray-600 mb-8 max-w-lg mx-auto">
                        Notre equipe est disponible pour repondre a toutes vos questions sur l'adhesion, l'annuaire ou le refus scolaire anxieux.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-4 max-w-lg mx-auto">
                    <a href="{{ route('contact') }}" class="flex items-center justify-center gap-2 bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-6 py-4 rounded-xl transition-all hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Nous contacter
                    </a>
                    <a href="{{ route('annuaire') }}" class="flex items-center justify-center gap-2 bg-white border-2 border-ctm-burgundy text-ctm-burgundy hover:bg-ctm-burgundy hover:text-white font-bold uppercase px-6 py-4 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Trouver un pro
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-ctm-burgundy text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Pret a trouver le bon professionnel ?</h2>
            <p class="text-white/80 mb-8 text-lg">Consultez notre annuaire de professionnels specialises dans le refus scolaire anxieux.</p>
            <a href="{{ route('annuaire') }}" class="inline-flex items-center gap-2 bg-white text-ctm-burgundy hover:bg-gray-100 font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl text-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Consulter l'annuaire
            </a>
        </div>
    </section>
</x-public-layout>
