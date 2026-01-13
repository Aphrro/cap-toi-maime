<?php

use App\Models\User;
use App\Models\ParentProfile;
use App\Models\Child;
use App\Models\Canton;
use App\Models\City;
use App\Rules\SwissPhoneNumber;
use App\Rules\SwissPostalCode;
use App\Rules\ValidChildAge;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public int $step = 1;
    public int $totalSteps = 3;

    // Step 1: Account
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    // Step 2: Personal info
    public string $first_name = '';
    public string $last_name = '';
    public string $phone = '';
    public string $address = '';
    public string $postal_code = '';
    public ?int $canton_id = null;
    public ?int $city_id = null;

    // Step 3: Children
    public array $children = [
        ['first_name' => '', 'age' => '', 'problématique' => '', 'description' => '']
    ];

    public function mount()
    {
        //
    }

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
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'phone' => ['nullable', new SwissPhoneNumber],
                'address' => ['nullable', 'string', 'max:255'],
                'postal_code' => ['nullable', new SwissPostalCode],
                'canton_id' => ['required', 'exists:cantons,id'],
            ]);
        }
    }

    public function addChild()
    {
        $this->children[] = ['first_name' => '', 'age' => '', 'problématique' => '', 'description' => ''];
    }

    public function removeChild($index)
    {
        if (count($this->children) > 1) {
            unset($this->children[$index]);
            $this->children = array_values($this->children);
        }
    }

    public function register()
    {
        // Validate children
        $this->validate([
            'children' => ['required', 'array', 'min:1'],
            'children.*.first_name' => ['required', 'string', 'max:100'],
            'children.*.age' => ['required', 'integer', new ValidChildAge],
            'children.*.problématique' => ['required', 'string', 'in:' . implode(',', array_keys(Child::PROBLEMATIQUES))],
            'children.*.description' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () {
            // Create user
            $user = User::create([
                'name' => "{$this->first_name} {$this->last_name}",
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone' => $this->phone ?: null,
                'user_type' => 'parent',
                'is_active' => true,
            ]);

            // Assign rôle
            $user->assignRole('parent');

            // Create parent profile
            $parentProfile = ParentProfile::create([
                'user_id' => $user->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'address' => $this->address ?: null,
                'postal_code' => $this->postal_code ?: null,
                'city_id' => $this->city_id,
            ]);

            // Create children
            foreach ($this->children as $childData) {
                Child::create([
                    'parent_id' => $parentProfile->id,
                    'first_name' => $childData['first_name'],
                    'age' => (int) $childData['age'],
                    'problématique' => $childData['problématique'],
                    'description' => $childData['description'] ?: null,
                ]);
            }

            event(new Registered($user));
            Auth::login($user);
        });

        $this->redirect(route('annuaire'), navigate: true);
    }

    public function with(): array
    {
        return [
            'cantons' => Canton::orderBy('name')->get(),
            'cities' => $this->canton_id ? City::where('canton_id', $this->canton_id)->orderBy('name')->get() : collect(),
            'problématiques' => Child::PROBLEMATIQUES,
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
                        <div class="w-12 sm:w-24 h-1 mx-2 {{ $step > $i ? 'bg-cap-900' : 'bg-gray-200' }}"></div>
                    @endif
                </div>
            @endfor
        </div>
        <div class="text-center text-sm text-gray-600">
            @if ($step === 1)
                Compte
            @elseif ($step === 2)
                Informations personnelles
            @else
                Enfant(s)
            @endif
        </div>
    </div>

    <form wire:submit="register">
        <!-- Step 1: Account -->
        @if ($step === 1)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Creer votre compte</h3>

                <div>
                    <x-input-label for="email" value="Email" />
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

        <!-- Step 2: Personal Info -->
        @if ($step === 2)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vos informations</h3>

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

                <div>
                    <x-input-label for="phone" value="Téléphone (optionnel)" />
                    <x-text-input wire:model="phone" id="phone" type="tel" class="block mt-1 w-full" placeholder="+41 79 123 45 67" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="address" value="Adresse (optionnel)" />
                    <x-text-input wire:model="address" id="address" type="text" class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="postal_code" value="Code postal (optionnel)" />
                        <x-text-input wire:model="postal_code" id="postal_code" type="text" class="block mt-1 w-full" placeholder="1200" />
                        <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="canton_id" value="Canton" />
                        <select wire:model.live="canton_id" id="canton_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900">
                            <option value="">Sélectionnéz...</option>
                            @foreach ($cantons as $canton)
                                <option value="{{ $canton->id }}">{{ $canton->name }} ({{ $canton->code }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('canton_id')" class="mt-2" />
                    </div>
                </div>

                @if ($canton_id && $cities->isNotEmpty())
                    <div>
                        <x-input-label for="city_id" value="Ville (optionnel)" />
                        <select wire:model="city_id" id="city_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900">
                            <option value="">Sélectionnéz...</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        @endif

        <!-- Step 3: Children -->
        @if ($step === 3)
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Votre/vos enfant(s)</h3>

                @foreach ($children as $index => $child)
                    <div class="p-4 bg-gray-50 rounded-lg relative">
                        @if (count($children) > 1)
                            <button type="button" wire:click="removeChild({{ $index }})" class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        @endif

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label value="Prenom de l'enfant" />
                                <x-text-input wire:model="children.{{ $index }}.first_name" type="text" class="block mt-1 w-full" required />
                                <x-input-error :messages="$errors->get('children.'.$index.'.first_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label value="Age" />
                                <x-text-input wire:model="children.{{ $index }}.age" type="number" min="0" max="25" class="block mt-1 w-full" required />
                                <x-input-error :messages="$errors->get('children.'.$index.'.age')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label value="Problematique principale" />
                            <select wire:model="children.{{ $index }}.problématique" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required>
                                <option value="">Sélectionnéz...</option>
                                @foreach ($problématiques as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('children.'.$index.'.problématique')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label value="Description (optionnel)" />
                            <textarea wire:model="children.{{ $index }}.description" rows="2" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" placeholder="Décrivez brievement la situation..."></textarea>
                            <x-input-error :messages="$errors->get('children.'.$index.'.description')" class="mt-2" />
                        </div>
                    </div>
                @endforeach

                <button type="button" wire:click="addChild" class="flex items-center text-cap-900 hover:text-cap-700 text-sm font-medium">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Ajouter un autre enfant
                </button>
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
                    Creer mon compte
                </button>
            @endif
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Déjà inscrit ?
        <a href="{{ route('login') }}" class="text-cap-900 hover:underline font-medium" wire:navigate>Se connecter</a>
    </p>
</div>
