<div>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('annuaire') }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                    &larr; Retour a l'annuaire
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    <!-- Header -->
                    <div class="flex flex-col md:flex-row md:items-start md:space-x-6">
                        <div class="flex-shrink-0 mb-4 md:mb-0">
                            <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                <span class="text-3xl text-gray-500 dark:text-gray-400">{{ substr($professional->first_name, 0, 1) }}{{ substr($professional->last_name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center flex-wrap gap-2">
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $professional->full_name }}</h1>
                                @if($professional->is_verified)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Verifie
                                    </span>
                                @endif
                                @if($professional->is_featured)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Premium
                                    </span>
                                @endif
                            </div>
                            <p class="text-lg text-indigo-600 dark:text-indigo-400 mt-1">{{ $professional->category->name }}</p>
                            @if($professional->city)
                                <p class="text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $professional->city->name }}, {{ $professional->city->canton->name }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Bio -->
                    @if($professional->bio)
                        <div class="mt-8">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">A propos</h2>
                            <p class="text-gray-600 dark:text-gray-300 whitespace-pre-line">{{ $professional->bio }}</p>
                        </div>
                    @endif

                    <!-- Specialties -->
                    @if($professional->specialties && count($professional->specialties) > 0)
                        <div class="mt-8">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Specialites</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($professional->specialties as $specialty)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                        {{ $specialty }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Languages -->
                    @if($professional->languages && count($professional->languages) > 0)
                        <div class="mt-8">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Langues</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($professional->languages as $language)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        {{ $language }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Consultation type -->
                    @if($professional->consultation_type)
                        <div class="mt-8">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Type de consultation</h2>
                            <p class="text-gray-600 dark:text-gray-300">{{ $professional->consultation_type }}</p>
                        </div>
                    @endif

                    <!-- Contact -->
                    <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-8">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Contact</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($professional->email)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="mt-1">
                                        <a href="mailto:{{ $professional->email }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400">
                                            {{ $professional->email }}
                                        </a>
                                    </dd>
                                </div>
                            @endif
                            @if($professional->phone)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Telephone</dt>
                                    <dd class="mt-1">
                                        <a href="tel:{{ $professional->phone }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400">
                                            {{ $professional->phone }}
                                        </a>
                                    </dd>
                                </div>
                            @endif
                            @if($professional->website)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Site web</dt>
                                    <dd class="mt-1">
                                        <a href="{{ $professional->website }}" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400">
                                            {{ $professional->website }}
                                        </a>
                                    </dd>
                                </div>
                            @endif
                            @if($professional->address)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Adresse</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-white">
                                        {{ $professional->address }}
                                        @if($professional->city)
                                            <br>{{ $professional->city->postal_code }} {{ $professional->city->name }}
                                        @endif
                                    </dd>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
