<x-public-layout title="FAQ - Cap Toi M'aime">
    <!-- Hero -->
    <section class="bg-ctm-burgundy py-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-12"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <h1 class="font-display text-3xl md:text-4xl text-white uppercase">Questions Frequentes</h1>
            <p class="mt-4 text-lg text-ctm-cream">Trouvez des reponses a vos questions sur la phobie scolaire</p>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="py-16 bg-ctm-cream">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4" x-data="{ openIndex: null }">
                @foreach(config('faq') as $index => $item)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <button
                            @click="openIndex = openIndex === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors"
                        >
                            <span class="font-semibold text-gray-900 pr-4">{{ $item['question'] }}</span>
                            <svg
                                class="w-5 h-5 text-ctm-teal flex-shrink-0 transition-transform duration-200"
                                :class="{ 'rotate-180': openIndex === {{ $index }} }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div
                            x-show="openIndex === {{ $index }}"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1"
                            class="px-6 pb-5"
                        >
                            <p class="text-gray-600 leading-relaxed">{{ $item['answer'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- CTA -->
            <div class="mt-12 bg-white rounded-2xl shadow-lg p-8 text-center">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Vous n'avez pas trouve votre reponse ?</h2>
                <p class="text-gray-600 mb-6">Contactez-nous directement ou consultez notre annuaire de professionnels.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-ctm-teal hover:bg-ctm-teal-dark text-white font-bold uppercase px-6 py-3 rounded-full transition-all hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Nous contacter
                    </a>
                    <a href="{{ route('annuaire') }}" class="inline-flex items-center justify-center bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-6 py-3 rounded-full transition-all hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Trouver un pro
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
