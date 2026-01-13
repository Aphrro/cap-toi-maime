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
                <p class="text-gray-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $professional->city?->name }}, {{ $professional->city?->canton?->code }}
                </p>
            </div>
        </div>

        {{-- Boutons de contact --}}
        <div class="flex gap-3 mt-6">
            @if($professional->phone)
                <a
                    href="tel:{{ $professional->phone }}"
                    class="flex-1 flex items-center justify-center gap-2 bg-cap-900 text-white py-3 px-4 rounded-lg font-medium hover:bg-cap-800 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Appeler
                </a>
            @endif

            @if($professional->email)
                <a
                    href="mailto:{{ $professional->email }}"
                    class="flex-1 flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Email
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
        <div class="flex flex-wrap gap-4">
            <span class="flex items-center gap-1 {{ $professional->mode_cabinet ? 'text-green-600' : 'text-gray-400' }}">
                @if($professional->mode_cabinet)
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @else
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                @endif
                Cabinet
            </span>
            <span class="flex items-center gap-1 {{ $professional->mode_visio ? 'text-green-600' : 'text-gray-400' }}">
                @if($professional->mode_visio)
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @else
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                @endif
                Visio
            </span>
            <span class="flex items-center gap-1 {{ $professional->mode_domicile ? 'text-green-600' : 'text-gray-400' }}">
                @if($professional->mode_domicile)
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @else
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                @endif
                Domicile
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
            class="text-cap-900 hover:underline inline-flex items-center gap-1"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour a l'annuaire
        </a>
    </div>

</div>
