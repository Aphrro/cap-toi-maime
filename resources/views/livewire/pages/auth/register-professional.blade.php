<?php

use App\Models\User;
use App\Models\Professional;
use App\Models\Category;
use App\Models\Canton;
use App\Models\City;
use App\Models\Specialty;
use App\Rules\SwissPhoneNumber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts.guest')] class extends Component
{
    use WithFileUploads;

    public int $step = 1;
    public int $totalSteps = 5;

    // Step 1: Account
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    // Step 2: Identity
    public string $first_name = '';
    public string $last_name = '';
    public ?string $title = '';

    // Step 3: Contact
    public string $phone = '';
    public ?string $website = '';
    public string $address = '';
    public ?int $canton_id = null;
    public ?int $city_id = null;

    // Step 4: Professional info
    public ?int $category_id = null;
    public array $specialty_ids = [];
    public array $languages = [];
    public ?string $consultation_type = null;

    // Step 5: Bio
    public string $bio = '';
    public $avatar = null;

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email', 'unique:professionals,email'],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'title' => ['nullable', 'string', 'max:50'],
            ]);
        } elseif ($this->step === 3) {
            $this->validate([
                'phone' => ['required', new SwissPhoneNumber],
                'website' => ['nullable', 'url'],
                'address' => ['required', 'string', 'max:255'],
                'canton_id' => ['required', 'exists:cantons,id'],
                'city_id' => ['required', 'exists:cities,id'],
            ]);
        } elseif ($this->step === 4) {
            $this->validate([
                'category_id' => ['required', 'exists:categories,id'],
                'specialty_ids' => ['required', 'array', 'min:1'],
                'specialty_ids.*' => ['exists:specialties,id'],
                'languages' => ['required', 'array', 'min:1'],
                'languages.*' => [Rule::in(array_keys(Professional::LANGUAGES))],
                'consultation_type' => ['required', Rule::in(array_keys(Professional::CONSULTATION_TYPES))],
            ]);
        }
    }

    public function register()
    {
        // Validate bio
        $this->validate([
            'bio' => ['required', 'string', 'min:100', 'max:2000'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        DB::transaction(function () {
            // Create user
            $user = User::create([
                'name' => "{$this->first_name} {$this->last_name}",
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone' => $this->phone,
                'user_type' => 'professional',
                'is_active' => true,
            ]);

            // Assign role
            $user->assignRole('professional');

            // Create professional profile
            $professional = Professional::create([
                'user_id' => $user->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'title' => $this->title ?: null,
                'email' => $this->email,
                'phone' => $this->phone,
                'website' => $this->website ?: null,
                'address' => $this->address,
                'city_id' => $this->city_id,
                'category_id' => $this->category_id,
                'languages' => $this->languages,
                'consultation_type' => $this->consultation_type,
                'bio' => $this->bio,
                'is_active' => false, // Will be activated after validation
                'is_verified' => false,
                'validation_status' => 'pending',
            ]);

            // Attach specialties
            $professional->specialtiesRelation()->sync($this->specialty_ids);

            // Upload avatar
            if ($this->avatar) {
                $professional->addMedia($this->avatar->getRealPath())
                    ->usingFileName($this->avatar->getClientOriginalName())
                    ->toMediaCollection('avatar');
            }

            event(new Registered($user));
            Auth::login($user);
        });

        session()->flash('success', 'Votre profil a ete cree avec succes. Il sera visible dans l\'annuaire apres validation par notre equipe.');
        $this->redirect(route('dashboard'), navigate: true);
    }

    public function with(): array
    {
        return [
            'cantons' => Canton::orderBy('name')->get(),
            'cities' => $this->canton_id ? City::where('canton_id', $this->canton_id)->orderBy('name')->get() : collect(),
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
            'specialties' => Specialty::where('is_active', true)->orderBy('name')->get(),
            'availableLanguages' => Professional::LANGUAGES,
            'consultationTypes' => Professional::CONSULTATION_TYPES,
        ];
    }
}; ?>

<div>
    <!-- Progress bar -->
    <div class="mb-8">
        <div class="flex justify-between mb-2">
            @for ($i = 1; $i <= $totalSteps; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium
                        {{ $step >= $i ? 'bg-cap-900 text-white' : 'bg-gray-200 text-gray-600' }}">
                        {{ $i }}
                    </div>
                    @if ($i < $totalSteps)
                        <div class="w-8 sm:w-16 h-1 mx-1 {{ $step > $i ? 'bg-cap-900' : 'bg-gray-200' }}"></div>
                    @endif
                </div>
            @endfor
        </div>
        <div class="text-center text-sm text-gray-600">
            @if ($step === 1)
                Compte
            @elseif ($step === 2)
                Identite
            @elseif ($step === 3)
                Contact
            @elseif ($step === 4)
                Profession
            @else
                Bio
            @endif
        </div>
    </div>

    <form wire:submit="register">
        <!-- Step 1: Account -->
        @if ($step === 1)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Creer votre compte professionnel</h3>

                <div>
                    <x-input-label for="email" value="Email professionnel" />
                    <x-text-input wire:model="email" id="email" type="email" class="block mt-1 w-full" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" value="Mot de passe" />
                    <x-text-input wire:model="password" id="password" type="password" class="block mt-1 w-full" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
                    <x-text-input wire:model="password_confirmation" id="password_confirmation" type="password" class="block mt-1 w-full" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        @endif

        <!-- Step 2: Identity -->
        @if ($step === 2)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Votre identite</h3>

                <div>
                    <x-input-label for="title" value="Titre (Dr., Prof., etc.)" />
                    <x-text-input wire:model="title" id="title" type="text" class="block mt-1 w-full" placeholder="Dr." />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="first_name" value="Prenom" />
                        <x-text-input wire:model="first_name" id="first_name" type="text" class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="last_name" value="Nom" />
                        <x-text-input wire:model="last_name" id="last_name" type="text" class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 3: Contact -->
        @if ($step === 3)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Coordonnees</h3>

                <div>
                    <x-input-label for="phone" value="Telephone" />
                    <x-text-input wire:model="phone" id="phone" type="tel" class="block mt-1 w-full" placeholder="+41 22 123 45 67" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="website" value="Site web (optionnel)" />
                    <x-text-input wire:model="website" id="website" type="url" class="block mt-1 w-full" placeholder="https://..." />
                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="address" value="Adresse du cabinet" />
                    <x-text-input wire:model="address" id="address" type="text" class="block mt-1 w-full" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="canton_id" value="Canton" />
                        <select wire:model.live="canton_id" id="canton_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required>
                            <option value="">Selectionnez...</option>
                            @foreach ($cantons as $canton)
                                <option value="{{ $canton->id }}">{{ $canton->name }} ({{ $canton->code }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('canton_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="city_id" value="Ville" />
                        <select wire:model="city_id" id="city_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required {{ !$canton_id ? 'disabled' : '' }}>
                            <option value="">Selectionnez...</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 4: Professional -->
        @if ($step === 4)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations professionnelles</h3>

                <div>
                    <x-input-label for="category_id" value="Categorie professionnelle" />
                    <select wire:model="category_id" id="category_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required>
                        <option value="">Selectionnez...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Specialites" />
                    <div class="mt-2 grid grid-cols-2 gap-2 max-h-48 overflow-y-auto p-2 border rounded-md">
                        @foreach ($specialties as $specialty)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="specialty_ids" value="{{ $specialty->id }}" class="rounded border-gray-300 text-cap-900 focus:ring-cap-900">
                                <span class="ml-2 text-sm text-gray-700">{{ $specialty->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('specialty_ids')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Langues parlees" />
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($availableLanguages as $code => $label)
                            <label class="flex items-center px-3 py-1 border rounded-full cursor-pointer
                                {{ in_array($code, $languages) ? 'bg-cap-900 text-white border-cap-900' : 'bg-white text-gray-700 border-gray-300 hover:border-cap-900' }}">
                                <input type="checkbox" wire:model="languages" value="{{ $code }}" class="sr-only">
                                <span class="text-sm">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('languages')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="consultation_type" value="Type de consultation" />
                    <select wire:model="consultation_type" id="consultation_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required>
                        <option value="">Selectionnez...</option>
                        @foreach ($consultationTypes as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('consultation_type')" class="mt-2" />
                </div>
            </div>
        @endif

        <!-- Step 5: Bio -->
        @if ($step === 5)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Votre presentation</h3>

                <div>
                    <x-input-label for="bio" value="Biographie (min. 100 caracteres)" />
                    <textarea wire:model="bio" id="bio" rows="6" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required placeholder="Presentez-vous, votre parcours, votre approche..."></textarea>
                    <div class="mt-1 text-sm text-gray-500">{{ strlen($bio) }}/2000 caracteres</div>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Photo de profil (optionnel)" />
                    <div class="mt-2 flex items-center space-x-4">
                        @if ($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                        <label class="cursor-pointer px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <input type="file" wire:model="avatar" accept="image/*" class="sr-only">
                            Choisir une photo
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                </div>

                <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-amber-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-amber-800">
                            Votre profil sera examine par notre equipe avant d'etre visible dans l'annuaire. Vous recevrez un email de confirmation une fois valide.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Navigation buttons -->
        <div class="flex justify-between mt-8">
            @if ($step > 1)
                <button type="button" wire:click="previousStep" class="px-4 py-2 text-gray-600 hover:text-gray-900">
                    Retour
                </button>
            @else
                <a href="{{ route('register') }}" class="px-4 py-2 text-gray-600 hover:text-gray-900" wire:navigate>
                    Retour
                </a>
            @endif

            @if ($step < $totalSteps)
                <button type="button" wire:click="nextStep" class="px-6 py-2 bg-cap-900 text-white rounded-lg hover:bg-cap-800 transition-colors">
                    Continuer
                </button>
            @else
                <button type="submit" class="px-6 py-2 bg-cap-900 text-white rounded-lg hover:bg-cap-800 transition-colors">
                    Soumettre mon profil
                </button>
            @endif
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Deja inscrit ?
        <a href="{{ route('login') }}" class="text-cap-900 hover:underline font-medium" wire:navigate>Se connecter</a>
    </p>
</div>
