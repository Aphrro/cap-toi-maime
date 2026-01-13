<x-public-layout title="Adhesion en cours - Cap Toi M'aime">
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-ctm-burgundy to-ctm-burgundy-dark text-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-2xl mx-auto">
                {{-- Icon --}}
                <div class="w-20 h-20 bg-white/10 backdrop-blur rounded-2xl flex items-center justify-center mx-auto mb-8">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                    Adhesion en cours de validation
                </h1>
                <p class="text-lg md:text-xl text-white/90">
                    Merci pour votre demande ! Notre equipe examine votre dossier.
                </p>
            </div>
        </div>
    </section>

    {{-- Info Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Status Card --}}
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-amber-800 mb-1">En attente de validation</h3>
                        <p class="text-amber-700">Vous recevrez une reponse par email sous <strong>48 heures</strong>.</p>
                    </div>
                </div>
            </div>

            {{-- Details Card --}}
            <div class="bg-gray-50 rounded-2xl p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Que se passe-t-il ensuite ?</h2>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-ctm-burgundy text-white rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">1</div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Verification de votre demande</h4>
                            <p class="text-gray-600 text-sm">Notre equipe examine votre dossier d'adhesion.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-ctm-burgundy text-white rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">2</div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Confirmation par email</h4>
                            <p class="text-gray-600 text-sm">Vous recevrez un email de confirmation a l'adresse suivante :</p>
                            <p class="text-ctm-burgundy font-medium mt-1">{{ auth()->user()->email ?? 'Non connecte' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-ctm-burgundy text-white rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">3</div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Acces a l'annuaire</h4>
                            <p class="text-gray-600 text-sm">Une fois valide, vous aurez acces a l'annuaire complet des professionnels.</p>
                        </div>
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Questions ? Ecrivez-nous a </span>
                        <a href="mailto:hello@captoimaime.ch" class="text-ctm-burgundy font-medium hover:underline">hello@captoimaime.ch</a>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-bold uppercase px-6 py-3 rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Retour a l'accueil
                </a>

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-6 py-3 rounded-xl transition-all w-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Se deconnecter
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </section>

    {{-- Help Section --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">En attendant, decouvrez...</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <a href="{{ route('about') }}" class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition flex items-start gap-4">
                    <div class="w-12 h-12 bg-ctm-burgundy/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">A propos de l'annuaire</h3>
                        <p class="text-gray-600 text-sm">Decouvrez comment nous selectionnons nos professionnels.</p>
                    </div>
                </a>

                <a href="{{ route('faq') }}" class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition flex items-start gap-4">
                    <div class="w-12 h-12 bg-ctm-teal/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">Questions frequentes</h3>
                        <p class="text-gray-600 text-sm">Retrouvez les reponses aux questions les plus courantes.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
