<div>
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-ctm-burgundy to-ctm-burgundy-dark text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-center">
                {{ $heroTitle }}
            </h1>
        </div>
    </section>

    {{-- Contenu principal --}}
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-4xl">

            {{-- Introduction --}}
            @if($introText)
                <div class="prose prose-lg max-w-none mb-12 text-gray-700">
                    {!! $introText !!}
                </div>
            @endif

            {{-- Ce que c'est --}}
            @if(count($whatItIsPoints) > 0)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        Ce que c'est (et ce que ce n'est pas)
                    </h2>
                    <ul class="space-y-4">
                        @foreach($whatItIsPoints as $item)
                            <li class="flex items-start">
                                <span class="text-ctm-teal mr-3 mt-1 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                <span class="text-gray-700">{{ $item['point'] ?? $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Notre plus --}}
            @if(count($ourPlusPoints) > 0)
                <div class="mb-12 bg-ctm-teal/10 rounded-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        Notre "plus" pour vous faire gagner du temps
                    </h2>
                    <ul class="space-y-4">
                        @foreach($ourPlusPoints as $item)
                            <li class="flex items-start">
                                <span class="text-ctm-teal mr-3 mt-1 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </span>
                                <span class="text-gray-700">{{ $item['point'] ?? $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Pourquoi construit ainsi --}}
            @if($whyBuiltText)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">
                        Pourquoi nous l'avons construit ainsi ?
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! $whyBuiltText !!}
                    </div>
                </div>
            @endif

            {{-- Disclaimer --}}
            @if($disclaimerText)
                <div class="bg-amber-50 border-l-4 border-amber-400 p-6 rounded-r-lg">
                    <h3 class="text-lg font-semibold text-amber-800 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Limites et rappel important
                    </h3>
                    <div class="text-amber-700">
                        {!! $disclaimerText !!}
                    </div>
                </div>
            @endif

        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-12 bg-ctm-burgundy/5">
        <div class="max-w-2xl mx-auto text-center px-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Besoin de trouver un professionnel ?
            </h2>
            <a
                href="{{ route('questionnaire') }}"
                class="inline-block bg-ctm-burgundy text-white px-8 py-4 rounded-lg font-medium hover:bg-ctm-burgundy-dark transition"
            >
                Faire le questionnaire
            </a>
        </div>
    </section>
</div>
