<x-public-layout>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-12">
        <div class="max-w-lg w-full bg-white rounded-2xl shadow-lg p-8 text-center">
            {{-- Logo --}}
            <div class="mb-6">
                <img src="{{ asset('logo-cap-toi-maime.png') }}" alt="Cap Toi M'aime" class="h-16 mx-auto" onerror="this.style.display='none'">
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Acces reserve aux membres
            </h1>

            <div class="bg-ctm-burgundy/5 border border-ctm-burgundy/20 rounded-xl p-6 mb-6 text-left">
                <p class="text-gray-700 mb-4">
                    Les fonctionnalites de cet annuaire sont accessibles <strong>uniquement aux membres</strong> de l'association Cap Toi M'aime.
                </p>
                <p class="text-gray-700">
                    Si cela vous interesse, vous pouvez prendre votre adhesion de facon automatique sur le lien ci-dessous. Nous etudions votre demande sous <strong>48h</strong> et apres validation, vous recevrez un email de confirmation avec vos codes d'acces.
                </p>
            </div>

            <div class="space-y-3">
                <a
                    href="#adhesion"
                    class="block w-full bg-ctm-burgundy text-white py-3 rounded-lg font-medium hover:bg-ctm-burgundy-dark transition"
                >
                    Devenir membre
                </a>

                <a
                    href="{{ route('login') }}"
                    class="block w-full bg-white border border-gray-300 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition"
                >
                    Deja membre ? Se connecter
                </a>
            </div>

            <p class="mt-6 text-sm text-gray-500">
                En savoir plus sur l'association :
                <a href="https://www.captoimaime.ch" target="_blank" class="text-ctm-burgundy hover:underline">
                    www.captoimaime.ch
                </a>
            </p>
        </div>
    </div>
</x-public-layout>
