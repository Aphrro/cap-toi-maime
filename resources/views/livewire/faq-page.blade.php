<div>
    @php
        $hero = $content['hero'] ?? [];
        $badges = $content['badges_section'] ?? [];
        $faqSection = $content['faq_section'] ?? [];
        $cta = $content['cta_section'] ?? [];
    @endphp

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-ctm-burgundy to-ctm-burgundy-dark text-white py-16 md:py-24"
             style="background: linear-gradient(to bottom right, {{ $hero['background_color'] ?? '#7A1F2E' }}, {{ $hero['background_color_end'] ?? '#5A0F1E' }});">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $hero['text_color'] ?? '#FFFFFF' }};">
                        {{ $hero['title'] ?? 'Questions Frequentes' }}
                    </h1>
                    <p class="text-lg md:text-xl mb-8" style="color: {{ $hero['text_color'] ?? '#FFFFFF' }}; opacity: 0.9;">
                        {{ $hero['subtitle'] ?? 'Trouvez des reponses a vos questions sur la phobie scolaire, l\'annuaire et l\'adhesion.' }}
                    </p>
                </div>
                @if(!empty($badges['show']) && !empty($badges['items']))
                <div class="hidden md:flex justify-center">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8">
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($badges['items'] as $badge)
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    @if(($badge['icon'] ?? '') === 'question-mark-circle')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    @elseif(($badge['icon'] ?? '') === 'book-open')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    @elseif(($badge['icon'] ?? '') === 'chat-bubble-left-right')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                    </svg>
                                    @elseif(($badge['icon'] ?? '') === 'heart')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    @elseif(($badge['icon'] ?? '') === 'users')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-bold">{{ $badge['text'] ?? '' }}</div>
                                    @if(!empty($badge['subtitle']))
                                    <div class="text-white/80 text-sm">{{ $badge['subtitle'] }}</div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Category Filter --}}
    <section class="py-6 bg-white border-b" style="background-color: {{ $faqSection['filter_background_color'] ?? '#FFFFFF' }};">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center">
                @foreach($categories as $key => $label)
                    <button
                        wire:click="setCategory('{{ $key }}')"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ $activeCategory === $key ? 'bg-ctm-burgundy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ Accordion --}}
    <section id="faq-section" class="py-16" style="background-color: {{ $faqSection['background_color'] ?? '#F9FAFB' }};">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(!empty($faqSection['title']))
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $faqSection['title'] }}</h2>
                @if(!empty($faqSection['subtitle']))
                <p class="text-gray-600">{{ $faqSection['subtitle'] }}</p>
                @endif
            </div>
            @endif

            @if($faqs->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $faqSection['empty_title'] ?? 'Aucune question dans cette categorie' }}</h3>
                    <p class="text-gray-500">{{ $faqSection['empty_subtitle'] ?? 'Essayez une autre categorie ou contactez-nous directement.' }}</p>
                </div>
            @else
                <div class="space-y-4" x-data="{ openIndex: null }">
                    @foreach($faqs as $index => $faq)
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                            <button
                                @click="openIndex = openIndex === {{ $index }} ? null : {{ $index }}"
                                class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors"
                            >
                                <div class="flex items-center gap-3 pr-4">
                                    @if($faq->category !== 'general')
                                        <span class="flex-shrink-0 px-2 py-1 text-xs font-medium rounded-full {{ $faq->category === 'parents' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                            {{ $faq->category === 'parents' ? 'Parents' : 'Pros' }}
                                        </span>
                                    @endif
                                    <span class="font-semibold text-gray-900">{{ $faq->question }}</span>
                                </div>
                                <div class="w-8 h-8 bg-ctm-burgundy/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg
                                        class="w-4 h-4 text-ctm-burgundy transition-transform duration-200"
                                        :class="{ 'rotate-180': openIndex === {{ $index }} }"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>
                            <div
                                x-show="openIndex === {{ $index }}"
                                x-collapse
                                x-cloak
                            >
                                <div class="px-6 pb-5 text-gray-600 prose prose-sm max-w-none">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    @if(!empty($cta['show']))
    <section class="py-16" style="background-color: {{ $cta['background_color'] ?? '#FFFFFF' }};">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                {{ $cta['title'] ?? 'Vous n\'avez pas trouve votre reponse ?' }}
            </h2>
            <p class="text-gray-600 mb-8">
                {{ $cta['subtitle'] ?? 'Notre equipe est la pour vous aider. N\'hesitez pas a nous contacter.' }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $cta['button_url'] ?? route('contact') }}"
                   class="inline-flex items-center gap-2 text-white font-bold px-6 py-3 rounded-full transition-all hover:opacity-90"
                   style="background-color: {{ $cta['button_color'] ?? '#7A1F2E' }};">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ $cta['button_text'] ?? 'Nous contacter' }}
                </a>
                @if(!empty($cta['email']))
                <a href="mailto:{{ $cta['email'] }}" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium px-6 py-3 rounded-full transition-all">
                    {{ $cta['email'] }}
                </a>
                @endif
            </div>
        </div>
    </section>
    @endif
</div>
