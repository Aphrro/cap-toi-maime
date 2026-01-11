<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
    <div class="p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <span class="text-2xl text-gray-500 dark:text-gray-400">{{ substr($professional->first_name, 0, 1) }}{{ substr($professional->last_name, 0, 1) }}</span>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center space-x-2">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">
                        {{ $professional->full_name }}
                    </h3>
                    @if($professional->is_verified)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                            Verifie
                        </span>
                    @endif
                    @if($professional->is_featured)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                            Premium
                        </span>
                    @endif
                </div>
                <p class="text-sm text-indigo-600 dark:text-indigo-400">{{ $professional->category->name }}</p>
                @if($professional->city)
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $professional->city->name }} ({{ $professional->city->canton->code }})
                    </p>
                @endif
                @if($professional->specialties && count($professional->specialties) > 0)
                    <div class="mt-2 flex flex-wrap gap-1">
                        @foreach(array_slice($professional->specialties, 0, 3) as $specialty)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                {{ $specialty }}
                            </span>
                        @endforeach
                        @if(count($professional->specialties) > 3)
                            <span class="text-xs text-gray-500 dark:text-gray-400">+{{ count($professional->specialties) - 3 }}</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('professional.show', $professional) }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Voir le profil
            </a>
        </div>
    </div>
</div>
