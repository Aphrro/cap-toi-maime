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
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts.guest')] class extends Component
{
    use WithFileUploads;

    public int $step = 1;
    public int $totalSteps = 6;

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

    // Step 5: Credentials
    public array $diplomas = [['title' => '', 'institution' => '', 'year' => '']];
    public ?string $professional_number = '';
    public ?string $professional_number_type = null;
    public ?int $years_experience = null;
    public ?string $insurance_company = '';
    public ?string $insurance_number = '';

    // Step 6: Bio & Documents
    public string $bio = '';
    public string $school_phobia_training = '';
    public $avatar = null;
    public $credential_document = null;
    public bool $accepts_terms = false;
    public bool $accepts_ethics = false;

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function toggleLanguage(string $code)
    {
        if (in_array($code, $this->languages)) {
            $this->languages = array_values(array_diff($this->languages, [$code]));
        } else {
            $this->languages[] = $code;
        }
    }

    public function addDiploma()
    {
        $this->diplomas[] = ['title' => '', 'institution' => '', 'year' => ''];
    }

    public function removeDiploma(int $index)
    {
        if (count($this->diplomas) > 1) {
            unset($this->diplomas[$index]);
            $this->diplomas = array_values($this->diplomas);
        }
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
        } elseif ($this->step === 5) {
            $this->validate([
                'diplomas' => ['required', 'array', 'min:1'],
                'diplomas.*.title' => ['required', 'string', 'max:255'],
                'diplomas.*.institution' => ['required', 'string', 'max:255'],
                'diplomas.*.year' => ['required', 'numeric', 'integer', 'min:1950', 'max:' . date('Y')],
                'professional_number_type' => ['nullable', Rule::in(array_keys(Professional::PROFESSIONAL_NUMBER_TYPES))],
                'professional_number' => ['nullable', 'string', 'max:50'],
                'years_experience' => ['required', 'integer', 'min:0', 'max:60'],
                'insurance_company' => ['nullable', 'string', 'max:255'],
                'insurance_number' => ['nullable', 'string', 'max:100'],
            ]);
        }
    }

    public function register()
    {
        // Validate final step
        $this->validate([
            'bio' => ['required', 'string', 'min:100', 'max:2000'],
            'school_phobia_training' => ['nullable', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'credential_document' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'accepts_terms' => ['accepted'],
            'accepts_ethics' => ['accepted'],
        ], [
            'accepts_terms.accepted' => 'Vous devez accepter les conditions d\'utilisation.',
            'accepts_ethics.accepted' => 'Vous devez accepter la charte ethique.',
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

            // Assign rôle
            $user->assignRole('professional');

            // Handle credential document upload
            $credentialDocuments = [];
            if ($this->credential_document) {
                $path = $this->credential_document->store('credentials', 'private');
                $credentialDocuments[] = [
                    'path' => $path,
                    'name' => $this->credential_document->getClientOriginalName(),
                    'uploaded_at' => now()->toISOString(),
                ];
            }

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
                'diplomas' => $this->diplomas,
                'professional_number' => $this->professional_number ?: null,
                'professional_number_type' => $this->professional_number_type,
                'years_experience' => $this->years_experience,
                'insurance_company' => $this->insurance_company ?: null,
                'insurance_number' => $this->insurance_number ?: null,
                'school_phobia_training' => $this->school_phobia_training ?: null,
                'credential_documents' => $credentialDocuments,
                'accepts_terms' => $this->accepts_terms,
                'accepts_ethics' => $this->accepts_ethics,
                'is_active' => false,
                'is_verified' => false,
                'validation_status' => 'pending',
            ]);

            // Attach spécialties
            $professional->specialties()->sync($this->specialty_ids);

            // Upload avatar
            if ($this->avatar) {
                $professional->addMedia($this->avatar->getRealPath())
                    ->usingFileName($this->avatar->getClientOriginalName())
                    ->toMediaCollection('avatar');
            }

            event(new Registered($user));
            Auth::login($user);
        });

        session()->flash('success', 'Votre profil a été créé avec succes. Il sera visible dans l\'annuaire après validation par notre équipe.');
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
            'professionalNumberTypes' => Professional::PROFESSIONAL_NUMBER_TYPES,
        ];
    }
}; ?>

<div>
    <!-- Progress bar -->
    <div class="mb-8">
        <div class="flex justify-center items-center mb-2">
            @for ($i = 1; $i <= $totalSteps; $i++)
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs sm:text-sm font-medium flex-shrink-0
                    {{ $step >= $i ? 'bg-cap-900 text-white' : 'bg-gray-200 text-gray-600' }}">
                    {{ $i }}
                </div>
                @if ($i < $totalSteps)
                    <div class="w-4 sm:w-8 h-1 {{ $step > $i ? 'bg-cap-900' : 'bg-gray-200' }}"></div>
                @endif
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
            @elseif ($step === 5)
                Diplomes
            @else
                Finalisation
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
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Votre identité</h3>

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
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Coordonnées</h3>

                <div>
                    <x-input-label for="phone" value="Téléphone" />
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
                            <option value="">Sélectionnéz...</option>
                            @foreach ($cantons as $canton)
                                <option value="{{ $canton->id }}">{{ $canton->name }} ({{ $canton->code }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('canton_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="city_id" value="Ville" />
                        <select wire:model="city_id" id="city_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required {{ !$canton_id ? 'disabled' : '' }}>
                            <option value="">Sélectionnéz...</option>
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
                    <x-input-label for="category_id" value="Catégorie professionnelle" />
                    <select wire:model="category_id" id="category_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required>
                        <option value="">Sélectionnéz...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Spécialités" />
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
                            <button
                                type="button"
                                wire:click="toggleLanguage('{{ $code }}')"
                                class="px-3 py-1 border rounded-full cursor-pointer text-sm transition-colors
                                    {{ in_array($code, $languages) ? 'bg-cap-900 text-white border-cap-900' : 'bg-white text-gray-700 border-gray-300 hover:border-cap-900' }}"
                            >
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('languages')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="consultation_type" value="Type de consultation" />
                    <select wire:model="consultation_type" id="consultation_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required>
                        <option value="">Sélectionnéz...</option>
                        @foreach ($consultationTypes as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('consultation_type')" class="mt-2" />
                </div>
            </div>
        @endif

        <!-- Step 5: Credentials -->
        @if ($step === 5)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Diplomes et qualifications</h3>

                <!-- Diplomas -->
                <div>
                    <x-input-label value="Diplomes et formations" />
                    <div class="space-y-3 mt-2">
                        @foreach ($diplomas as $index => $diploma)
                            <div class="p-3 border rounded-lg bg-gray-50">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                    <div>
                                        <input wire:model="diplomas.{{ $index }}.title" type="text" placeholder="Diplome/Titre" class="w-full text-sm rounded-md border-gray-300" required />
                                    </div>
                                    <div>
                                        <input wire:model="diplomas.{{ $index }}.institution" type="text" placeholder="Institution" class="w-full text-sm rounded-md border-gray-300" required />
                                    </div>
                                    <div class="flex gap-2">
                                        <input wire:model="diplomas.{{ $index }}.year" type="number" placeholder="Annee" min="1950" max="{{ date('Y') }}" class="w-full text-sm rounded-md border-gray-300" required />
                                        @if (count($diplomas) > 1)
                                            <button type="button" wire:click="removeDiploma({{ $index }})" class="px-2 text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" wire:click="addDiploma" class="mt-2 text-sm text-cap-900 hover:underline flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Ajouter un diplôme
                    </button>
                    <x-input-error :messages="$errors->get('diplomas')" class="mt-2" />
                    <x-input-error :messages="$errors->get('diplomas.*.title')" class="mt-2" />
                </div>

                <!-- Professional Number -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="professional_number_type" value="Type de numéro professionnel" />
                        <select wire:model="professional_number_type" id="professional_number_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900 text-sm">
                            <option value="">Aucun / Non applicable</option>
                            @foreach ($professionalNumberTypes as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('professional_number_type')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="professional_number" value="Numéro" />
                        <x-text-input wire:model="professional_number" id="professional_number" type="text" class="block mt-1 w-full" placeholder="Ex: 7601000000000" />
                        <x-input-error :messages="$errors->get('professional_number')" class="mt-2" />
                    </div>
                </div>

                <!-- Expérience -->
                <div>
                    <x-input-label for="years_experience" value="Annees d'expérience" />
                    <x-text-input wire:model="years_experience" id="years_experience" type="number" min="0" max="60" class="block mt-1 w-32" required />
                    <x-input-error :messages="$errors->get('years_experience')" class="mt-2" />
                </div>

                <!-- Insurance -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="insurance_company" value="Assurance RC (optionnel)" />
                        <x-text-input wire:model="insurance_company" id="insurance_company" type="text" class="block mt-1 w-full" placeholder="Nom de l'assurance" />
                        <x-input-error :messages="$errors->get('insurance_company')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="insurance_number" value="N° police" />
                        <x-text-input wire:model="insurance_number" id="insurance_number" type="text" class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('insurance_number')" class="mt-2" />
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 6: Bio & Finalization -->
        @if ($step === 6)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Finalisation de votre profil</h3>

                <div>
                    <x-input-label for="bio" value="Biographie professionnelle (min. 100 caracteres)" />
                    <textarea wire:model.live="bio" id="bio" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" required placeholder="Presentez-vous, votre parcours, votre approche..."></textarea>
                    <div class="mt-1 text-sm {{ strlen($bio) >= 100 ? 'text-green-600' : 'text-gray-500' }}">
                        {{ strlen($bio) }}/2000 caracteres
                        @if(strlen($bio) < 100)
                            <span class="text-amber-600">(minimum 100)</span>
                        @endif
                    </div>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="school_phobia_training" value="Formation specifique phobie scolaire (optionnel)" />
                    <textarea wire:model="school_phobia_training" id="school_phobia_training" rows="2" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-cap-900 focus:ring-cap-900" placeholder="Décrivez vos formations specifiques liees à la phobie scolaire..."></textarea>
                    <x-input-error :messages="$errors->get('school_phobia_training')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label value="Photo de profil (optionnel)" />
                        <div class="mt-2 flex items-center space-x-4">
                            @if ($avatar)
                                <img src="{{ $avatar->temporaryUrl() }}" class="w-16 h-16 rounded-full object-cover">
                            @else
                                <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                            <label class="cursor-pointer px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <input type="file" wire:model="avatar" accept="image/*" class="sr-only">
                                Photo
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label value="Document justificatif (diplôme, attestation)" />
                        <div class="mt-2">
                            <label class="cursor-pointer px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                <input type="file" wire:model="credential_document" accept=".pdf,.jpg,.jpeg,.png" class="sr-only">
                                Telecharger
                            </label>
                            @if ($credential_document)
                                <span class="ml-2 text-sm text-green-600">{{ $credential_document->getClientOriginalName() }}</span>
                            @endif
                        </div>
                        <p class="mt-1 text-xs text-gray-500">PDF, JPG ou PNG (max 5Mo)</p>
                        <x-input-error :messages="$errors->get('credential_document')" class="mt-2" />
                    </div>
                </div>

                <!-- Terms -->
                <div class="p-4 bg-gray-50 border rounded-lg space-y-3">
                    <label class="flex items-start">
                        <input type="checkbox" wire:model="accepts_terms" class="mt-1 rounded border-gray-300 text-cap-900 focus:ring-cap-900">
                        <span class="ml-2 text-sm text-gray-700">
                            J'accepte les <a href="{{ route('conditions') }}" target="_blank" class="text-cap-900 underline hover:text-cap-700">conditions d'utilisation</a> et la <a href="{{ route('confidentialite') }}" target="_blank" class="text-cap-900 underline hover:text-cap-700">politique de confidentialite</a>
                        </span>
                    </label>
                    <x-input-error :messages="$errors->get('accepts_terms')" class="mt-1" />

                    <label class="flex items-start">
                        <input type="checkbox" wire:model="accepts_ethics" class="mt-1 rounded border-gray-300 text-cap-900 focus:ring-cap-900">
                        <span class="ml-2 text-sm text-gray-700">
                            Je m'engage à respecter la <a href="{{ route('charte-ethique') }}" target="_blank" class="text-cap-900 underline hover:text-cap-700">charte ethique</a> de Cap Toi M'aime et a accompagnér les familles avec bienveillance
                        </span>
                    </label>
                    <x-input-error :messages="$errors->get('accepts_ethics')" class="mt-1" />
                </div>

                <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-amber-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-amber-800">
                            Votre profil sera examine par notre équipe avant d'être visible dans l'annuaire. Vous recevrez un email de confirmation une fois valide.
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
                <a href="{{ route('espace-pro') }}" class="px-4 py-2 text-gray-600 hover:text-gray-900" wire:navigate>
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
        Déjà inscrit ?
        <a href="{{ route('login') }}" class="text-cap-900 hover:underline font-medium" wire:navigate>Se connecter</a>
    </p>
</div>
