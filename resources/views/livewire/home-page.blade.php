<div>
    {{-- Hero Section --}}
    <section class="bg-gradient-to-b from-ctm-burgundy to-ctm-burgundy-dark text-white py-16 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-2xl md:text-4xl font-bold mb-4">
                {{ $heroTitle }}
            </h1>
            <p class="text-xl text-white/80 mb-8">
                {{ $heroSubtitle }}
            </p>

            {{-- Search Box --}}
            <div class="bg-white rounded-xl p-6 max-w-xl mx-auto text-gray-800 shadow-lg">
                <form wire:submit="quickSearch" class="flex gap-2 mb-4">
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            type="text"
                            wire:model="search"
                            placeholder="Recherche rapide..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy"
                        >
                    </div>
                    <button type="submit" class="bg-ctm-burgundy text-white px-6 py-3 rounded-lg font-medium hover:bg-ctm-burgundy-dark transition">
                        Chercher
                    </button>
                </form>

                <div class="text-center text-gray-500 mb-4">ou</div>

                <a
                    href="{{ $heroCtaLink }}"
                    class="flex items-center justify-center gap-2 w-full bg-ctm-burgundy/10 text-ctm-burgundy py-4 rounded-lg font-medium hover:bg-ctm-burgundy/20 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    {{ $heroCtaText }}
                </a>
            </div>
        </div>
    </section>

    {{-- Catégories --}}
    <section class="py-12 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">TYPES DE PROFESSIONNELS</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($categories as $category)
                    <a
                        href="{{ route('annuaire', ['categoryId' => $category->id]) }}"
                        class="bg-gray-50 rounded-xl p-4 text-center hover:bg-cap-50 hover:shadow-md transition group"
                    >
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full flex items-center justify-center" style="background-color: {{ $category->color }}20">
                            @switch($category->icon)
                                @case('brain')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                    @break
                                @case('stethoscope')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    @break
                                @case('scan')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                    @break
                                @case('users')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    @break
                                @case('sparkles')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                    </svg>
                                    @break
                                @case('graduation-cap')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    </svg>
                                    @break
                                @default
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                            @endswitch
                        </div>
                        <div class="text-xs text-gray-700 font-medium group-hover:text-cap-900 leading-tight">{{ $category->name }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Spécialties --}}
    <section class="py-8 px-4 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">SPÉCIALITÉS RECHERCHÉES</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($specialties as $specialty)
                    <a
                        href="{{ route('annuaire', ['specialty' => $specialty->slug]) }}"
                        class="bg-cap-100 text-cap-900 px-4 py-2 rounded-full text-sm font-medium hover:bg-cap-200 transition"
                    >
                        {{ $specialty->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Professionals --}}
    @if($featuredPros->count() > 0)
    <section class="py-12 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">PROFESSIONNELS MIS EN AVANT</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredPros as $pro)
                    <a href="{{ route('professional.show', $pro) }}" class="block">
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition text-center border border-gray-100">
                            {{-- Avatar --}}
                            @if($pro->getFirstMediaUrl('avatar'))
                                <img src="{{ $pro->getFirstMediaUrl('avatar') }}" alt="{{ $pro->full_name }}" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                            @else
                                <div class="w-20 h-20 bg-cap-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <span class="text-cap-900 font-bold text-xl">
                                        {{ substr($pro->first_name, 0, 1) }}{{ substr($pro->last_name, 0, 1) }}
                                    </span>
                                </div>
                            @endif

                            <h4 class="font-semibold text-gray-900 flex items-center justify-center gap-1">
                                {{ $pro->full_name }}
                                @if($pro->is_verified)
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.491 4.491 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"/>
                                    </svg>
                                @endif
                            </h4>
                            <p class="text-cap-900 text-sm font-medium">{{ $pro->category->name }}</p>

                            @if($pro->city)
                                <p class="text-gray-500 text-sm mt-2 flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $pro->city->name }}, {{ $pro->city->canton->code }}
                                </p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-16 px-4 bg-ctm-burgundy/5">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                {{ $ctaFinalTitle }}
            </h2>
            <a
                href="{{ $ctaFinalButtonLink }}"
                class="inline-block bg-ctm-burgundy text-white px-8 py-4 rounded-lg font-medium hover:bg-ctm-burgundy-dark transition"
            >
                {{ $ctaFinalButtonText }}
            </a>
        </div>
    </section>
</div>
