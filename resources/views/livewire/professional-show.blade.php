<div>
    <!-- Hero Header -->
    <section class="bg-ctm-burgundy py-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-12"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <a href="{{ route('annuaire') }}" class="inline-flex items-center text-ctm-cream hover:text-white transition-colors mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Retour à l'annuaire
            </a>

            <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
                <!-- Photo -->
                <div class="flex-shrink-0 mb-4 md:mb-0">
                    @if($professional->profile_photo)
                        <img
                            src="{{ Storage::url($professional->profile_photo) }}"
                            alt="{{ $professional->full_name }}"
                            class="w-24 h-24 rounded-2xl object-cover border-4 border-white/20"
                        >
                    @elseif($professional->getFirstMediaUrl('avatar'))
                        <img
                            src="{{ $professional->getFirstMediaUrl('avatar') }}"
                            alt="{{ $professional->full_name }}"
                            class="w-24 h-24 rounded-2xl object-cover border-4 border-white/20"
                        >
                    @else
                        <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border-4 border-white/20">
                            <span class="text-3xl font-bold text-white">{{ substr($professional->first_name, 0, 1) }}{{ substr($professional->last_name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <div class="flex items-center flex-wrap gap-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $professional->full_name }}</h1>
                        @if($professional->is_vérifiéd)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500 text-white">
                                Vérifié
                            </span>
                        @endif
                    </div>
                    <p class="text-lg text-ctm-cream mt-1">{{ $professional->category->name }}</p>
                    @if($professional->city)
                        <div class="flex items-center mt-2 text-white/80">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $professional->city->name }}, {{ $professional->city->canton->name }}
                        </div>
                    @endif

                    <!-- Availability Badge -->
                    @php $badge = $professional->availability_badge; @endphp
                    <div class="mt-3">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm
                            {{ $badge['color'] === 'green' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $badge['color'] === 'orange' ? 'bg-orange-100 text-orange-800' : '' }}
                            {{ $badge['color'] === 'gray' ? 'bg-gray-100 text-gray-800' : '' }}
                        ">
                            <span class="w-3 h-3 rounded-full
                                {{ $badge['color'] === 'green' ? 'bg-green-500' : '' }}
                                {{ $badge['color'] === 'orange' ? 'bg-orange-500' : '' }}
                                {{ $badge['color'] === 'gray' ? 'bg-gray-400' : '' }}
                            "></span>
                            {{ $badge['label'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="bg-ctm-cream py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 lg:p-8 space-y-8">

                    <!-- Video Presentation -->
                    @if($professional->video_url)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <span class="mr-2">&#x1F3A5;</span>
                                Presentation video
                            </h2>
                            <div class="aspect-video rounded-xl overflow-hidden bg-gray-100">
                                <iframe
                                    src="{{ $professional->video_embed_url }}"
                                    class="w-full h-full"
                                    allowfullscréén
                                ></iframe>
                            </div>
                        </div>
                    @endif

                    <!-- Qui suis-je ? -->
                    @if($professional->who_am_i)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <span class="mr-2">&#x1F464;</span>
                                Qui suis-je ?
                            </h2>
                            <div class="prose text-gray-600">
                                {!! nl2br(e($professional->who_am_i)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Mon approché -->
                    @if($professional->my_approach)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <span class="mr-2">&#x1F4A1;</span>
                                Mon approché
                            </h2>
                            <div class="prose text-gray-600">
                                {!! nl2br(e($professional->my_approach)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Bio (fallback if no who_am_i) -->
                    @if($professional->bio && !$professional->who_am_i)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                À propos
                            </h2>
                            <p class="text-gray-600 whitespace-pre-line leading-relaxed">{{ $professional->bio }}</p>
                        </div>
                    @endif

                    <!-- Spécialties -->
                    @if($professional->specialties && count($professional->specialties) > 0)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <span class="mr-2">&#x1F3AF;</span>
                                Spécialités
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($professional->specialties as $specialty)
                                    <span class="px-4 py-2 bg-ctm-burgundy/10 text-ctm-burgundy rounded-xl text-sm font-medium">
                                        {{ $specialty->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Reimbursements -->
                    @if($professional->reimbursements && count($professional->reimbursements) > 0)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <span class="mr-2">&#x1F4B3;</span>
                                Remboursements acceptes
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($professional->reimbursements_list as $reimbursement)
                                    <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-xl text-sm font-medium">
                                        {{ $reimbursement }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Languages -->
                    @if($professional->languages && count($professional->languages) > 0)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                                Langues
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($professional->languages as $language)
                                    <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium">
                                        {{ App\Models\Professional::LANGUAGES[$language] ?? $language }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Consultation Modes -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-ctm-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Modes de consultation
                        </h2>
                        <div class="flex flex-wrap gap-3">
                            @if($professional->mode_cabinet)
                                <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-xl text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                                    </svg>
                                    En cabinet
                                </span>
                            @endif
                            @if($professional->mode_visio)
                                <span class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-xl text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    En visio
                                </span>
                            @endif
                            @if($professional->mode_domicile)
                                <span class="inline-flex items-center px-4 py-2 bg-purple-100 text-purple-800 rounded-xl text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    A domicile
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="border-t border-gray-200 pt-8" id="contact-section">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="mr-2">&#x1F4DE;</span>
                            Contact
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($professional->phone)
                                <a href="tel:{{ $professional->phone }}" class="flex items-center p-4 bg-ctm-cream rounded-xl hover:bg-ctm-teal/10 transition-colors group">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 group-hover:bg-ctm-teal/30 transition-colors">
                                        <span class="text-2xl">&#x1F4F1;</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Téléphone</div>
                                        <div class="text-ctm-teal font-medium">{{ $professional->phone }}</div>
                                    </div>
                                </a>
                            @endif
                            @if($professional->email)
                                <a href="mailto:{{ $professional->email }}" class="flex items-center p-4 bg-ctm-cream rounded-xl hover:bg-ctm-teal/10 transition-colors group">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 group-hover:bg-ctm-teal/30 transition-colors">
                                        <span class="text-2xl">&#x2709;&#xFE0F;</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Email</div>
                                        <div class="text-ctm-teal font-medium">{{ $professional->email }}</div>
                                    </div>
                                </a>
                            @endif
                            @if($professional->website)
                                <a href="{{ $professional->website }}" target="_blank" rel="noopener noreferrer" class="flex items-center p-4 bg-ctm-cream rounded-xl hover:bg-ctm-teal/10 transition-colors group">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 group-hover:bg-ctm-teal/30 transition-colors">
                                        <span class="text-2xl">&#x1F310;</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Site web</div>
                                        <div class="text-ctm-teal font-medium truncate">{{ $professional->website }}</div>
                                    </div>
                                </a>
                            @endif
                            @if($professional->address)
                                <div class="flex items-start p-4 bg-ctm-cream rounded-xl">
                                    <div class="w-12 h-12 bg-ctm-teal/20 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <span class="text-2xl">&#x1F4CD;</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Adresse</div>
                                        <div class="text-gray-900">
                                            {{ $professional->address }}
                                            @if($professional->city)
                                                <br>{{ $professional->city->postal_code }} {{ $professional->city->name }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Personal FAQ -->
                    @if($professional->faq_availability || $professional->faq_pricing || $professional->faq_cancellation)
                        <div class="border-t border-gray-200 pt-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <span class="mr-2">&#x2753;</span>
                                Questions fréquentes
                            </h2>
                            <div class="space-y-3">
                                @if($professional->faq_availability)
                                    <details class="bg-gray-50 rounded-xl p-4 group">
                                        <summary class="font-medium cursor-pointer flex items-center justify-between">
                                            Disponibilites & modalités pratiques
                                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </summary>
                                        <p class="mt-3 text-gray-600">{!! nl2br(e($professional->faq_availability)) !!}</p>
                                    </details>
                                @endif

                                @if($professional->faq_pricing)
                                    <details class="bg-gray-50 rounded-xl p-4 group">
                                        <summary class="font-medium cursor-pointer flex items-center justify-between">
                                            Tarifs, facturation & remboursement
                                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </summary>
                                        <p class="mt-3 text-gray-600">{!! nl2br(e($professional->faq_pricing)) !!}</p>
                                    </details>
                                @endif

                                @if($professional->faq_cancellation)
                                    <details class="bg-gray-50 rounded-xl p-4 group">
                                        <summary class="font-medium cursor-pointer flex items-center justify-between">
                                            Politique d'annulation, retards & contact
                                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </summary>
                                        <p class="mt-3 text-gray-600">{!! nl2br(e($professional->faq_cancellation)) !!}</p>
                                    </details>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- CTA -->
                    <div class="mt-8 pt-8 border-t border-gray-200 text-center">
                        <a href="{{ route('annuaire') }}" class="inline-flex items-center bg-ctm-burgundy hover:bg-ctm-burgundy-dark text-white font-semibold py-3.5 px-8 rounded-xl transition-all duration-200 shadow-md hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Voir d'autrès professionnels
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
