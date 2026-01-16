<div>
    @php
        $hero = $content['hero'] ?? [];
        $form = $content['form_section'] ?? [];
        $info = $content['info_section'] ?? [];
        $cta = $content['cta_section'] ?? [];
    @endphp

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-ctm-burgundy to-ctm-burgundy-dark text-white py-16 md:py-24" style="background: linear-gradient(to bottom right, {{ $hero['background_color'] ?? '#7A1F2E' }}, {{ $hero['background_color_end'] ?? '#5a1622' }});">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $hero['text_color'] ?? '#FFFFFF' }}">
                        {{ $hero['title'] ?? 'Contactez-nous' }}
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 mb-8">
                        {{ $hero['subtitle'] ?? 'Une question sur l\'adhesion, l\'annuaire ou l\'association ? Notre equipe est a votre ecoute.' }}
                    </p>
                </div>
                <div class="hidden md:flex justify-center">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8">
                        <div class="grid grid-cols-1 gap-6">
                            @if(!empty($info['email']))
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $info['email_label'] ?? 'Email' }}</div>
                                    <div class="text-white/80 text-sm">{{ $info['email'] }}</div>
                                </div>
                            </div>
                            @endif
                            @if(!empty($info['hours']))
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $info['hours_label'] ?? 'Delai de reponse' }}</div>
                                    <div class="text-white/80 text-sm">{{ $info['hours'] }}</div>
                                </div>
                            </div>
                            @endif
                            @if(!empty($info['location']))
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $info['location'] }}</div>
                                    <div class="text-white/80 text-sm">{{ $info['location_subtitle'] ?? 'Association locale' }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Cards (Mobile) --}}
    <section class="py-8 bg-white md:hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4">
                @if(!empty($info['email']))
                <div class="bg-gray-50 rounded-xl p-4 flex items-center gap-4">
                    <div class="w-10 h-10 bg-ctm-burgundy/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">{{ $info['email_label'] ?? 'Email' }}</div>
                        <div class="text-gray-600 text-sm">{{ $info['email'] }}</div>
                    </div>
                </div>
                @endif
                @if(!empty($info['hours']))
                <div class="bg-gray-50 rounded-xl p-4 flex items-center gap-4">
                    <div class="w-10 h-10 bg-ctm-burgundy/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">{{ $info['hours_label'] ?? 'Delai de reponse' }}</div>
                        <div class="text-gray-600 text-sm">{{ $info['hours'] }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Contact Form --}}
    @if(!empty($form['show'] ?? true))
    <section class="py-16 bg-gray-50" style="background-color: {{ $form['background_color'] ?? '#F9FAFB' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-12">
                {{-- Left Column - Form --}}
                <div class="md:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $form['title'] ?? 'Envoyez-nous un message' }}</h2>

                        @if($success)
                            <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-green-800 mb-1">{{ $form['success_title'] ?? 'Message envoye !' }}</h3>
                                        <p class="text-green-700 text-sm">{{ $form['success_message'] ?? 'Merci pour votre message. Nous vous repondrons dans les plus brefs delais.' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form wire:submit="submit" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-gray-700 font-medium mb-2">{{ $form['name_label'] ?? 'Votre nom' }} *</label>
                                    <input
                                        type="text"
                                        id="name"
                                        wire:model="name"
                                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy transition @error('name') border-red-500 @enderror"
                                        placeholder="{{ $form['name_placeholder'] ?? 'Jean Dupont' }}"
                                    >
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-gray-700 font-medium mb-2">{{ $form['email_label'] ?? 'Votre email' }} *</label>
                                    <input
                                        type="email"
                                        id="email"
                                        wire:model="email"
                                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy transition @error('email') border-red-500 @enderror"
                                        placeholder="{{ $form['email_placeholder'] ?? 'jean@exemple.ch' }}"
                                    >
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block text-gray-700 font-medium mb-2">{{ $form['subject_label'] ?? 'Sujet' }} *</label>
                                <select
                                    id="subject"
                                    wire:model="subject"
                                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy transition @error('subject') border-red-500 @enderror"
                                >
                                    <option value="">{{ $form['subject_placeholder'] ?? 'Selectionnez un sujet...' }}</option>
                                    @foreach($form['subjects'] ?? [
                                        ['value' => 'adhesion', 'label' => 'Question sur l\'adhesion'],
                                        ['value' => 'annuaire', 'label' => 'Question sur l\'annuaire'],
                                        ['value' => 'professionnel', 'label' => 'Je suis professionnel'],
                                        ['value' => 'autre', 'label' => 'Autre']
                                    ] as $subjectOption)
                                    <option value="{{ $subjectOption['value'] }}">{{ $subjectOption['label'] }}</option>
                                    @endforeach
                                </select>
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="message" class="block text-gray-700 font-medium mb-2">{{ $form['message_label'] ?? 'Votre message' }} *</label>
                                <textarea
                                    id="message"
                                    wire:model="message"
                                    rows="5"
                                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy transition resize-none @error('message') border-red-500 @enderror"
                                    placeholder="{{ $form['message_placeholder'] ?? 'Decrivez votre demande...' }}"
                                ></textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-75 cursor-wait"
                                class="w-full bg-ctm-burgundy text-white py-4 rounded-xl font-bold uppercase hover:bg-ctm-burgundy-dark transition-all hover:shadow-lg flex items-center justify-center gap-2"
                                style="background-color: {{ $form['button_color'] ?? '#7A1F2E' }}"
                            >
                                <span wire:loading.remove>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <span wire:loading>
                                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                                <span wire:loading.remove>{{ $form['button_text'] ?? 'Envoyer le message' }}</span>
                                <span wire:loading>{{ $form['button_loading_text'] ?? 'Envoi en cours...' }}</span>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Right Column - Info --}}
                <div class="space-y-6">
                    {{-- Useful Links --}}
                    @if(!empty($info['links']))
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 mb-4">{{ $info['links_title'] ?? 'Liens utiles' }}</h3>
                        <div class="space-y-3">
                            @foreach($info['links'] as $link)
                            <a href="{{ $link['url'] }}" class="flex items-center gap-3 text-gray-600 hover:text-ctm-burgundy transition">
                                <div class="w-8 h-8 bg-ctm-burgundy/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-ctm-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if(($link['icon'] ?? '') === 'question-mark-circle')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @elseif(($link['icon'] ?? '') === 'information-circle')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @elseif(($link['icon'] ?? '') === 'briefcase')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        @endif
                                    </svg>
                                </div>
                                <span>{{ $link['label'] }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Main Site Link --}}
                    @if(!empty($info['website']))
                    <div class="bg-ctm-burgundy/5 rounded-2xl p-6 border border-ctm-burgundy/10">
                        <h3 class="font-bold text-gray-900 mb-2">{{ $info['website_title'] ?? 'Site principal' }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $info['website_description'] ?? 'Decouvrez l\'association Cap Toi M\'aime et toutes nos actions.' }}</p>
                        <a
                            href="https://{{ str_replace(['http://', 'https://'], '', $info['website']) }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex items-center gap-2 text-ctm-burgundy font-medium hover:underline"
                        >
                            {{ $info['website'] }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    @if(!empty($cta['show']))
    <section class="py-16 text-white" style="background-color: {{ $cta['background_color'] ?? '#7A1F2E' }}">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ $cta['title'] ?? 'Vous etes professionnel ?' }}</h2>
            <p class="text-white/80 mb-8 text-lg">{{ $cta['subtitle'] ?? 'Rejoignez notre annuaire et aidez les familles a vous trouver.' }}</p>
            <a href="{{ $cta['button_url'] ?? '/espace-professionnels' }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 font-bold uppercase px-8 py-4 rounded-full transition-all hover:shadow-xl text-lg" style="color: {{ $cta['background_color'] ?? '#7A1F2E' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                {{ $cta['button_text'] ?? 'Espace professionnels' }}
            </a>
        </div>
    </section>
    @endif
</div>
