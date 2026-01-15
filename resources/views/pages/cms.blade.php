<x-public-layout>
    <x-slot name="title">{{ $page->title }} - Cap Toi M'aime</x-slot>

    @php
        $content = $page->content ?? [];
        $hero = $content['hero'] ?? [];
        $sections = $content['content']['sections'] ?? [];
        $cta = $content['cta'] ?? [];
        $about = $content['about'] ?? [];
        $info = $content['info'] ?? [];
    @endphp

    {{-- Hero Section --}}
    @if(!empty($hero['title']))
    <section class="py-16 md:py-24 px-4" style="background-color: {{ $hero['background_color'] ?? '#7A1F2E' }}">
        <div class="max-w-4xl mx-auto text-center" style="color: {{ $hero['text_color'] ?? '#FFFFFF' }}">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                {{ $hero['title'] }}
            </h1>
            @if(!empty($hero['subtitle']))
            <p class="text-lg md:text-xl opacity-90">
                {{ $hero['subtitle'] }}
            </p>
            @endif
            @if(!empty($hero['button_text']))
            <div class="mt-8">
                <a href="{{ $hero['button_url'] ?? '#' }}" class="inline-block bg-white text-ctm-burgundy px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition">
                    {{ $hero['button_text'] }}
                </a>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- Content Sections --}}
    @if(!empty($sections))
    <section class="py-16 px-4 bg-white">
        <div class="max-w-4xl mx-auto">
            @foreach($sections as $section)
            <div class="mb-12 last:mb-0">
                @if(!empty($section['title']))
                <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $section['title'] }}</h2>
                @endif
                @if(!empty($section['content']))
                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! $section['content'] !!}
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- About Section --}}
    @if(!empty($about['title']) || !empty($about['content']))
    <section class="py-16 px-4 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            @if(!empty($about['title']))
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $about['title'] }}</h2>
            @endif
            @if(!empty($about['content']))
            <div class="prose prose-lg max-w-none text-gray-700">
                {!! $about['content'] !!}
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- Info Section --}}
    @if(!empty($info['email']) || !empty($info['address']))
    <section class="py-16 px-4 bg-white">
        <div class="max-w-4xl mx-auto">
            @if(!empty($info['title']))
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $info['title'] }}</h2>
            @endif
            <div class="grid md:grid-cols-2 gap-8">
                @if(!empty($info['email']))
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-ctm-burgundy/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">Email</div>
                        <a href="mailto:{{ $info['email'] }}" class="text-ctm-burgundy hover:underline">{{ $info['email'] }}</a>
                    </div>
                </div>
                @endif
                @if(!empty($info['address']))
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-ctm-burgundy/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">Adresse</div>
                        <div class="text-gray-600">{{ $info['address'] }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    @if(!empty($cta['title']))
    <section class="py-16 px-4" style="background-color: {{ $cta['background_color'] ?? '#1E8A9B' }}">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ $cta['title'] }}</h2>
            @if(!empty($cta['subtitle']))
            <p class="text-lg opacity-90 mb-8">{{ $cta['subtitle'] }}</p>
            @endif
            @if(!empty($cta['button_text']))
            <a href="{{ $cta['button_url'] ?? '#' }}" class="inline-block bg-white text-ctm-burgundy px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition">
                {{ $cta['button_text'] }}
            </a>
            @endif
        </div>
    </section>
    @endif

</x-public-layout>
