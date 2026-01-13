<x-public-layout title="Accès réservé - Cap Toi M'aime">
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-ctm-burgundy to-ctm-burgundy-dark text-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-2xl mx-auto">
                {{-- Logo --}}
                <img src="{{ asset('logo-cap-toi-maime.png') }}" alt="Cap Toi M'aime" class="h-20 mx-auto mb-8 rounded-lg" onerror="this.style.display='none'">

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                    Accès réservé aux membres
                </h1>
                <p class="text-lg md:text-xl text-white/90">
                    L'annuaire des professionnels est un avantage exclusif pour les membres de l'association Cap Toi M'aime.
                </p>
            </div>
        </div>
    </section>

    {{-- Info Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div class="bg-gray-50 rounded-2xl p-6 text-center">
                    <div class="w-14 h-14 bg-ctm-burgundy/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Professionnels vérifiés</h3>
                    <p class="text-gray-600 text-sm">Selection rigoureuse de praticiens formés au RSA</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 text-center">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Disponibilite temps reel</h3>
                    <p class="text-gray-600 text-sm">Identifiez rapidement les praticiens disponibles</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 text-center">
                    <div class="w-14 h-14 bg-ctm-teal/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Communauté entraide</h3>
                    <p class="text-gray-600 text-sm">Rejoignez des familles qui comprennent</p>
                </div>
            </div>

            {{-- Main Card --}}
            <div class="bg-gray-50 rounded-2xl p-8 md:p-12">
                <div class="max-w-xl mx-auto text-center">
                    <div class="w-16 h-16 bg-ctm-burgundy/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Comment adherer ?</h2>

                    <div class="text-left bg-white rounded-xl p-6 mb-8 border border-gray-200">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-8 h-8 bg-ctm-burgundy text-white rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">1</div>
                            <div>
                                <p class="text-gray-700">Remplissez le formulaire d'adhésion sur notre site principal</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-8 h-8 bg-ctm-burgundy text-white rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">2</div>
                            <div>
                                <p class="text-gray-700">Notre équipe étudie votre demande sous <strong>48h</strong></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-ctm-burgundy text-white rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">3</div>
                            <div>
                                <p class="text-gray-700">Vous recevez un email de confirmation avec vos codes d'acces</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a
                            href="https://infomaniak.events/fr-ch/shop/association-cap-toi-maime-CMM9TZMBZU/product/2522"
                            target="_blank"
                            class="flex items-center justify-center gap-2 w-full bg-ctm-burgundy text-white py-4 rounded-xl font-bold uppercase hover:bg-ctm-burgundy-dark transition-all hover:shadow-lg"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Devenir membre
                        </a>

                        <a
                            href="{{ route('login') }}"
                            class="flex items-center justify-center gap-2 w-full bg-white border-2 border-ctm-burgundy text-ctm-burgundy py-4 rounded-xl font-bold uppercase hover:bg-ctm-burgundy hover:text-white transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Déjà membre ? Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-ctm-burgundy text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Des questions ?</h2>
            <p class="text-white/80 mb-8 text-lg">Notre équipe est la pour vous accompagnér.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('faq') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold uppercase px-8 py-4 rounded-full transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Consulter la FAQ
                </a>
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 bg-white text-ctm-burgundy hover:bg-gray-100 font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Nous contacter
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
