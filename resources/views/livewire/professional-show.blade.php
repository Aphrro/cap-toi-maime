{{-- resources/views/livewire/professional-show.blade.php --}}

<div class="max-w-2xl mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
        <div class="flex items-start gap-4">
            {{-- Avatar --}}
            <div class="flex-shrink-0">
                @if($professional->profile_photo)
                    <img
                        src="{{ Storage::url($professional->profile_photo) }}"
                        alt="{{ $professional->full_name }}"
                        class="w-20 h-20 rounded-full object-cover"
                    >
                @elseif($professional->getFirstMediaUrl('avatar'))
                    <img
                        src="{{ $professional->getFirstMediaUrl('avatar') }}"
                        alt="{{ $professional->full_name }}"
                        class="w-20 h-20 rounded-full object-cover"
                    >
                @else
                    <div class="w-20 h-20 bg-cap-100 rounded-full flex items-center justify-center">
                        <span class="text-cap-900 font-bold text-2xl">
                            {{ substr($professional->first_name, 0, 1) }}{{ substr($professional->last_name, 0, 1) }}
                        </span>
                    </div>
                @endif
            </div>

            {{-- Infos principales --}}
            <div class="flex-1">
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-bold text-gray-900">{{ $professional->full_name }}</h1>

                    {{-- Badge verifie vert style Twitter --}}
                    @if($professional->is_verified)
                        <svg class="w-5 h-5 text-green-500" viewBox="0 0 24 24" fill="currentColor" title="Verifie par Cap Toi M'aime">
                            <path d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.491 4.491 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" />
                        </svg>
                    @endif
                </div>

                <p class="text-cap-900 font-medium">{{ $professional->category->name }}</p>
                <p class="text-gray-500">📍 {{ $professional->city?->name }}, {{ $professional->city?->canton?->code }}</p>
            </div>
        </div>

        {{-- Boutons de contact --}}
        <div class="flex gap-3 mt-6">
            @if($professional->phone)
                <a
                    href="tel:{{ $professional->phone }}"
                    class="flex-1 flex items-center justify-center gap-2 bg-cap-900 text-white py-3 px-4 rounded-lg font-medium hover:bg-cap-800 transition"
                >
                    📞 Appeler
                </a>
            @endif

            @if($professional->email)
                <a
                    href="mailto:{{ $professional->email }}"
                    class="flex-1 flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 transition"
                >
                    ✉️ Email
                </a>
            @endif
        </div>
    </div>

    {{-- Specialites --}}
    @if($professional->specialties && $professional->specialties->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Specialites</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($professional->specialties as $specialty)
                    <span class="bg-cap-100 text-cap-900 px-3 py-1 rounded-full text-sm">
                        {{ $specialty->name }}
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Consultations --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Consultations</h2>
        <div class="flex gap-4">
            <span class="{{ $professional->mode_cabinet ? 'text-green-600' : 'text-gray-400' }}">
                {{ $professional->mode_cabinet ? '✓' : '✗' }} Cabinet
            </span>
            <span class="{{ $professional->mode_visio ? 'text-green-600' : 'text-gray-400' }}">
                {{ $professional->mode_visio ? '✓' : '✗' }} Visio
            </span>
            <span class="{{ $professional->mode_domicile ? 'text-green-600' : 'text-gray-400' }}">
                {{ $professional->mode_domicile ? '✓' : '✗' }} Domicile
            </span>
        </div>
    </div>

    {{-- Remboursements --}}
    @if($professional->reimbursements && count($professional->reimbursements) > 0)
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Remboursements acceptes</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($professional->reimbursements_list as $reimbursement)
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                        {{ $reimbursement }}
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    {{-- A propos --}}
    @if($professional->bio)
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">A propos</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $professional->bio }}
            </p>
        </div>
    @endif

    {{-- Bouton retour --}}
    <div class="text-center">
        <a
            href="{{ route('annuaire') }}"
            class="text-cap-900 hover:underline"
        >
            ← Retour a l'annuaire
        </a>
    </div>

</div>
