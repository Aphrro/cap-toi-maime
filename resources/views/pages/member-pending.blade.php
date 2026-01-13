<x-public-layout>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-12">
        <div class="max-w-lg w-full bg-white rounded-2xl shadow-lg p-8 text-center">
            <div class="text-6xl mb-4">&#x23F3;</div>

            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Adhesion en cours de validation
            </h1>

            <p class="text-gray-600 mb-6">
                Merci pour votre demande d'adhesion ! Notre equipe examine votre dossier et vous recevrez une reponse par email sous <strong>48 heures</strong>.
            </p>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-left text-sm text-blue-800">
                <p><strong>Email de contact :</strong> hello@captoimaime.ch</p>
                <p class="mt-1"><strong>Votre email :</strong> {{ auth()->user()->email ?? 'Non connecte' }}</p>
            </div>

            @auth
                <form method="POST" action="{{ route('logout') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-gray-700 text-sm">
                        Se deconnecter
                    </button>
                </form>
            @endauth

            <p class="mt-6 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="text-ctm-burgundy hover:underline">
                    Retour a l'accueil
                </a>
            </p>
        </div>
    </div>
</x-public-layout>
