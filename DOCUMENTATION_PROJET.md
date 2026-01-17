# Documentation Complète - Cap Toi M'aime

## Table des matières

1. [Présentation du Projet](#1-présentation-du-projet)
2. [Stack Technique](#2-stack-technique)
3. [Architecture du Projet](#3-architecture-du-projet)
4. [Base de Données](#4-base-de-données)
5. [Modèles et Relations](#5-modèles-et-relations)
6. [Composants Livewire](#6-composants-livewire)
7. [Panel Admin Filament](#7-panel-admin-filament)
8. [Routes](#8-routes)
9. [Services](#9-services)
10. [Vues et Layouts](#10-vues-et-layouts)
11. [Fonctionnalités Implémentées](#11-fonctionnalités-implémentées)
12. [Configuration](#12-configuration)
13. [Déploiement](#13-déploiement)

---

## 1. Présentation du Projet

### Objectif
**Cap Toi M'aime** est une plateforme web suisse dédiée à l'accompagnement des familles confrontées à la phobie scolaire (refus scolaire anxieux). Elle propose un annuaire de professionnels spécialisés et un système de matching intelligent.

### Public cible
- **Parents/Familles** : Recherche de professionnels pour accompagner leurs enfants
- **Professionnels** : Psychologues, coachs, thérapeutes souhaitant être référencés
- **Association** : Gestion des membres et des événements

### Fonctionnalités principales
- Annuaire de professionnels avec recherche avancée
- Questionnaire guidé avec algorithme de matching
- Système de membres avec adhésion
- Panel d'administration complet
- Gestion d'événements (Speed Dating, conférences)
- Pages CMS dynamiques

---

## 2. Stack Technique

### Backend
| Technologie | Version | Usage |
|-------------|---------|-------|
| PHP | 8.2+ | Langage serveur |
| Laravel | 12.x | Framework principal |
| Livewire | 3.6+ | Composants réactifs |
| Filament | 3.x | Panel d'administration |
| MySQL | 8.x | Base de données |

### Frontend
| Technologie | Usage |
|-------------|-------|
| Tailwind CSS | Framework CSS utilitaire |
| Alpine.js | Interactivité JavaScript |
| Blade | Moteur de templates |
| Vite | Build des assets |

### Packages principaux
```json
{
  "laravel/framework": "^12.0",
  "livewire/livewire": "^3.6.4",
  "livewire/volt": "^1.7.0",
  "filament/filament": "^3.0",
  "spatie/laravel-permission": "^6.24",
  "spatie/laravel-medialibrary": "^11.17",
  "spatie/laravel-sluggable": "^3.7"
}
```

---

## 3. Architecture du Projet

### Structure des dossiers

```
cap-toi-maime/
├── app/
│   ├── Filament/           # Panel admin
│   │   ├── Pages/          # Pages custom admin
│   │   ├── Resources/      # CRUD resources (16)
│   │   └── Widgets/        # Widgets dashboard (7)
│   ├── Http/
│   │   ├── Controllers/    # Contrôleurs
│   │   └── Middleware/     # Middleware custom
│   ├── Livewire/           # Composants Livewire (11)
│   ├── Models/             # Modèles Eloquent (23)
│   ├── Providers/          # Service providers
│   └── Services/           # Services métier (3)
├── config/                 # Configuration
├── database/
│   ├── migrations/         # Migrations (45)
│   └── seeders/            # Seeders
├── resources/
│   └── views/
│       ├── components/     # Composants Blade (15)
│       ├── layouts/        # Layouts (4)
│       ├── livewire/       # Vues Livewire
│       ├── pages/          # Pages statiques
│       └── filament/       # Vues admin
├── routes/
│   ├── web.php             # Routes publiques
│   ├── auth.php            # Routes authentification
│   └── api.php             # Routes API
└── public/                 # Assets publics
```

---

## 4. Base de Données

### Schéma relationnel

```
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│     users       │────→│  professionals  │────→│    categories   │
├─────────────────┤     ├─────────────────┤     ├─────────────────┤
│ id              │     │ id              │     │ id              │
│ name            │     │ user_id (FK)    │     │ name            │
│ email           │     │ category_id     │     │ slug            │
│ user_type       │     │ city_id         │     │ icon            │
│ member_status   │     │ first_name      │     │ color           │
│ is_active       │     │ last_name       │     │ is_active       │
└─────────────────┘     │ bio             │     └─────────────────┘
                        │ validation_status│
                        └─────────────────┘
                               │
        ┌──────────────────────┼──────────────────────┐
        ▼                      ▼                      ▼
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│   specialties   │     │     cities      │     │    cantons      │
├─────────────────┤     ├─────────────────┤     ├─────────────────┤
│ id              │     │ id              │     │ id              │
│ name            │     │ canton_id (FK)  │     │ name            │
│ slug            │     │ name            │     │ code (VD, GE)   │
│ category_id     │     │ slug            │     │ is_active       │
│ icon            │     └─────────────────┘     └─────────────────┘
└─────────────────┘

Tables pivot:
- professional_specialty (professional_id, specialty_id)
- professional_language (professional_id, language_id)
- professional_reimbursement_type (professional_id, reimbursement_type_id)
- event_professional (event_id, professional_id)
```

### Tables principales (30+)

| Table | Description | Lignes clés |
|-------|-------------|-------------|
| `users` | Utilisateurs (parents, pros, admins) | user_type, member_status |
| `professionals` | Profils professionnels | validation_status, availability_status |
| `members` | Adhésions association | membership_start, membership_end |
| `categories` | Catégories (Psychologues, Coachs...) | name, icon, color |
| `specialties` | Spécialités détaillées | name, slug, category_id |
| `cantons` | Cantons suisses | name, code |
| `cities` | Villes par canton | name, canton_id |
| `events` | Événements | type, date, max_participants |
| `faqs` | Questions fréquentes | category, question, answer |
| `pages` | Pages CMS | slug, content (JSON) |
| `testimonials` | Témoignages | rating, is_approved |
| `settings` | Paramètres site | key, value, group |
| `contact_messages` | Messages contact | read_at |

---

## 5. Modèles et Relations

### User (Utilisateur)
```php
class User extends Authenticatable
{
    // Types
    const TYPE_PARENT = 'parent';
    const TYPE_PROFESSIONAL = 'professional';
    const TYPE_ADMIN = 'admin';

    // Relations
    public function professional(): HasOne
    public function parentProfile(): HasOne
    public function preferences(): HasOne

    // Méthodes
    public function isMember(): bool
    public function isProfessional(): bool
    public function isAdmin(): bool
    public function approveMembership(): void
}
```

### Professional (Professionnel)
```php
class Professional extends Model
{
    // Statuts de validation
    const VALIDATION_PENDING = 'pending';
    const VALIDATION_APPROVED = 'approved';
    const VALIDATION_REJECTED = 'rejected';

    // Relations
    public function user(): BelongsTo
    public function category(): BelongsTo
    public function city(): BelongsTo
    public function specialties(): BelongsToMany
    public function languages(): BelongsToMany
    public function reimbursementTypes(): BelongsToMany
    public function events(): BelongsToMany

    // Scopes
    public function scopeActive($query)
    public function scopeValidated($query)
    public function scopeInCanton($query, $canton)
}
```

### Autres modèles clés

| Modèle | Relations principales |
|--------|----------------------|
| Category | hasMany Specialty, hasMany Professional |
| Specialty | belongsTo Category, belongsToMany Professional |
| Canton | hasMany City |
| City | belongsTo Canton, hasMany Professional |
| Event | hasMany EventRegistration, belongsToMany Professional |
| Faq | Scopes: byCategory, forParents, forPros |
| Page | findBySlug(), content (array cast) |
| Setting | get(), set() avec cache |

---

## 6. Composants Livewire

### Pages publiques

#### HomePage
```php
// Affiche la page d'accueil avec:
// - Hero section
// - Catégories mises en avant
// - Call-to-action vers le questionnaire
```

#### ProfessionalSearch (Annuaire)
```php
class ProfessionalSearch extends Component
{
    // Filtres
    public string $search = '';
    public ?int $categoryId = null;
    public ?int $cantonId = null;
    public array $specialtyIds = [];
    public array $reimbursementIds = [];

    // Résultats paginés
    public function render()
    {
        $professionals = Professional::query()
            ->active()
            ->validated()
            ->when($this->search, fn($q) => $q->search($this->search))
            ->when($this->categoryId, fn($q) => $q->where('category_id', $this->categoryId))
            ->paginate(12);

        return view('livewire.professional-search', compact('professionals'));
    }
}
```

#### Questionnaire (5 étapes)
```php
class Questionnaire extends Component
{
    public int $step = 1;
    public array $answers = [];

    // Étape 1: Situation (phobie/refus/décrochage)
    // Étape 2: Particularités (HPI, TDAH, TSA, Dys)
    // Étape 3: Âge enfant, durée situation
    // Étape 4: Canton, modes de consultation
    // Étape 5: Priorités

    public function submit()
    {
        session(['questionnaire_answers' => $this->answers]);
        return redirect()->route('results');
    }
}
```

#### Results (Résultats matching)
```php
class Results extends Component
{
    public function render()
    {
        $matcher = new ProfessionalMatcher();
        $results = $matcher->fromQuestionnaire(
            session('questionnaire_answers')
        );

        return view('livewire.results', [
            'professionals' => $results['matches'],
            'recommendations' => $results['recommendations']
        ]);
    }
}
```

### Autres composants

| Composant | Description |
|-----------|-------------|
| ContactPage | Formulaire de contact avec validation |
| FaqPage | Affichage FAQ groupées par catégorie |
| EspacePro | Landing page pour professionnels |
| ProfessionalShow | Détail d'un professionnel |
| ProfessionalCard | Carte dans les résultats |

---

## 7. Panel Admin Filament

### Accès
- URL: `/admin`
- Authentification requise avec rôle `admin`

### Resources (CRUD complet)

#### ProfessionalResource
```php
// 6 onglets de formulaire:
// 1. Identité: photo, nom, prénom, email, téléphone
// 2. Localisation: adresse, ville, canton
// 3. Profession: catégorie, spécialités, langues
// 4. Présentation: bio, vidéo, modes consultation
// 5. FAQ personnelle: questions/réponses custom
// 6. Statut: validation, disponibilité, actif

// Actions disponibles:
// - Approuver (modal avec message)
// - Rejeter (modal avec motif)
// - Voir, Éditer, Supprimer
```

#### Autres resources

| Resource | Fonctionnalités |
|----------|-----------------|
| UserResource | Gestion utilisateurs, rôles |
| MemberResource | Adhésions, dates, statuts |
| EventResource | Événements, inscriptions |
| CategoryResource | Catégories + icônes |
| SpecialtyResource | Spécialités par catégorie |
| CantonResource | Cantons suisses |
| CityResource | Villes par canton |
| FaqResource | Questions fréquentes |
| PageResource | Pages CMS |
| TestimonialResource | Témoignages (modération) |
| ContactMessageResource | Messages (lecture seule) |
| SettingResource | Paramètres système |

### Widgets Dashboard

```php
// StatsOverview - 4 cartes statistiques
[
    'Professionnels en attente' => Professional::pending()->count(),
    'Membres en attente' => Member::pending()->count(),
    'Membres actifs' => Member::active()->count(),
    'Messages non lus' => ContactMessage::unread()->count(),
]

// PendingProfessionals - Tableau des 5 derniers
// PendingMembers - Membres à approuver
// ExpiringMembers - Adhésions expirant bientôt
// UpcomingEvents - Prochains événements
// QuickActions - Actions rapides
```

### Page GlobalSettings
```php
// Paramètres du site éditables:
// - Identité: nom, logo, favicon
// - Couleurs: primaire, secondaire, accent
// - Navigation: liens, CTA
// - Footer: colonnes, réseaux sociaux, copyright
```

---

## 8. Routes

### Routes publiques (`routes/web.php`)

```php
// Pages principales
Route::get('/', HomePage::class)->name('home');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/faq', FaqPage::class)->name('faq');
Route::get('/espace-pro', EspacePro::class)->name('espace-pro');
Route::get('/temoignages', fn() => view('pages.temoignages'))->name('temoignages');

// Pages légales
Route::view('/conditions-utilisation', 'pages.legal.conditions');
Route::view('/politique-confidentialite', 'pages.legal.confidentialite');
Route::view('/charte-ethique', 'pages.legal.charte-ethique');

// Accès membres
Route::view('/acces-membre', 'pages.member-gate')->name('member.gate');
Route::view('/adhesion-en-attente', 'pages.member-pending')->name('member.pending');
```

### Routes protégées (membres)

```php
Route::middleware(['member'])->group(function () {
    Route::get('/annuaire', ProfessionalSearch::class)->name('annuaire');
    Route::get('/professionnel/{professional:slug}', ProfessionalShow::class);
    Route::get('/questionnaire', Questionnaire::class)->name('questionnaire');
    Route::get('/resultats', Results::class)->name('results');
});
```

### Routes authentification (`routes/auth.php`)

```php
// Inscription
Route::get('/register', RegisterPage::class);
Route::get('/register/parent', RegisterParent::class);
Route::get('/register/professionnel', RegisterProfessional::class);

// Connexion
Route::get('/login', LoginPage::class);
Route::get('/forgot-password', ForgotPassword::class);
Route::get('/reset-password/{token}', ResetPassword::class);

// Vérification email
Route::get('/verify-email', EmailVerification::class);
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class);
```

---

## 9. Services

### ProfessionalMatcher
```php
class ProfessionalMatcher
{
    // Algorithme de matching pondéré
    private const WEIGHTS = [
        'specialties' => 35,
        'category' => 20,
        'location' => 15,
        'availability' => 10,
        'rating' => 10,
        'verified' => 5,
        'language' => 5,
    ];

    public function match(array $criteria): array
    {
        return Professional::query()
            ->active()
            ->validated()
            ->get()
            ->map(fn($pro) => [
                'professional' => $pro,
                'score' => $this->calculateScore($pro, $criteria),
                'details' => $this->getMatchDetails($pro, $criteria),
            ])
            ->sortByDesc('score')
            ->values()
            ->toArray();
    }

    public function fromQuestionnaire(array $answers): array
    {
        $criteria = $this->mapAnswersToCriteria($answers);
        return $this->match($criteria);
    }
}
```

### ProfileCompletenessService
```php
class ProfileCompletenessService
{
    // Calcul du % de complétion profil
    private const FIELD_WEIGHTS = [
        'first_name' => 10,
        'last_name' => 10,
        'email' => 10,
        'phone' => 10,
        'address' => 5,
        'city_id' => 5,
        'category_id' => 10,
        'bio' => 15,
        'specialties' => 10,
        'languages' => 5,
        'avatar' => 10,
    ];

    public function calculate(Professional $pro): array
    {
        return [
            'percentage' => $this->getPercentage($pro),
            'missing_fields' => $this->getMissingFields($pro),
            'is_complete' => $this->isComplete($pro),
        ];
    }
}
```

---

## 10. Vues et Layouts

### Layouts principaux

#### `layouts/public.blade.php`
```blade
<!DOCTYPE html>
<html>
<head>
    <!-- Meta, fonts, vite -->
</head>
<body>
    <!-- Navigation sticky -->
    <nav class="sticky top-0 z-50 bg-white">
        <!-- Logo -->
        <!-- Menu desktop -->
        <!-- Menu mobile (Alpine.js) -->
    </nav>

    <!-- Contenu page -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-ctm-black">
        <!-- Colonnes: Description, Navigation, Légal, Contact -->
        <!-- Réseaux sociaux -->
        <!-- Copyright -->
    </footer>
</body>
</html>
```

### Composants Blade réutilisables

| Composant | Usage |
|-----------|-------|
| `<x-primary-button>` | Bouton principal (burgundy) |
| `<x-secondary-button>` | Bouton secondaire |
| `<x-text-input>` | Champ texte stylé |
| `<x-input-label>` | Label de formulaire |
| `<x-input-error>` | Message d'erreur |
| `<x-modal>` | Modal Alpine.js |
| `<x-dropdown>` | Menu déroulant |

### Couleurs personnalisées (Tailwind)

```javascript
// tailwind.config.js
colors: {
    'ctm-burgundy': {
        DEFAULT: '#7A1F2E',
        dark: '#5D1722',
        light: '#9A3040',
    },
    'ctm-teal': {
        DEFAULT: '#007A8C',
        dark: '#005F6B',
        light: '#2B6B75',
    },
    'ctm-black': '#0A1F2E',
    'ctm-cream': '#F5F5F5',
}
```

---

## 11. Fonctionnalités Implémentées

### Système de membres

```
┌─────────────┐     ┌──────────────┐     ┌─────────────┐
│  Inscription │────→│   En attente │────→│   Approuvé  │
└─────────────┘     └──────────────┘     └─────────────┘
                           │
                           ▼
                    ┌──────────────┐
                    │    Rejeté    │
                    └──────────────┘
```

- Inscription parent ou professionnel
- Validation manuelle par admin
- Accès conditionnel à l'annuaire
- Gestion des adhésions (dates, renouvellement)

### Validation des professionnels

- Soumission du profil
- Vérification admin (documents, diplômes)
- Approbation/Rejet avec message
- Profil visible uniquement si approuvé

### Questionnaire intelligent

1. **Situation** : Type de problématique
2. **Particularités** : Neuro-atypies associées
3. **Contexte** : Âge, durée
4. **Localisation** : Canton, mode consultation
5. **Priorités** : Ce qui compte le plus

→ Algorithme de matching avec scores pondérés

### Recherche avancée

- Recherche textuelle (nom, spécialités)
- Filtres : catégorie, canton, spécialités
- Filtres : modes remboursement, langues
- Tri : nom, localisation, vérifié
- Pagination avec query string persistant

### Gestion d'événements

- Types : Speed Dating, conférences, ateliers
- Inscriptions membres et professionnels
- Limite de participants
- Statuts : brouillon, publié, passé

---

## 12. Configuration

### Variables d'environnement clés

```env
APP_NAME="Cap Toi M'aime"
APP_ENV=production
APP_URL=https://cap-toi-maime.ch

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=captoimaime
DB_USERNAME=forge
DB_PASSWORD=***

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_FROM_ADDRESS=hello@captoimaime.ch

FILESYSTEM_DISK=public
```

### Configuration FAQ (`config/faq.php`)

```php
return [
    'items' => [
        [
            'category' => 'general',
            'question' => 'Qu\'est-ce que le refus scolaire anxieux ?',
            'answer' => '...',
        ],
        // ... 47 items
    ],
];
```

---

## 13. Déploiement

### Serveur de production

- **Hébergeur** : Laravel Forge
- **Serveur** : forge@49.12.227.161
- **URL** : https://cap-toi-maime-klosj3gz.on-forge.com

### Structure Forge

```
/home/forge/cap-toi-maime-klosj3gz.on-forge.com/
├── current -> releases/XXXXXX    # Symlink version active
├── releases/                      # Versions déployées
├── storage/                       # Storage partagé
├── .env                          # Variables d'environnement
└── auth.json                     # Credentials packages privés
```

### Commandes de déploiement

```bash
# Connexion SSH
ssh forge@49.12.227.161

# Mise à jour du code
cd /home/forge/cap-toi-maime-klosj3gz.on-forge.com/current
git pull origin main

# Clear caches
php artisan optimize:clear
php artisan view:clear

# Migrations (si nécessaire)
php artisan migrate --force
```

---

## Annexes

### A. Statistiques du projet

| Métrique | Valeur |
|----------|--------|
| Modèles Eloquent | 23 |
| Migrations | 45 |
| Resources Filament | 16 |
| Widgets Filament | 7 |
| Composants Livewire | 11 |
| Vues Blade | 51 |
| Routes web | 25+ |
| Services | 3 |
| Tables BDD | 30+ |

### B. Commandes utiles

```bash
# Développement local
php artisan serve
npm run dev

# Base de données
php artisan migrate:fresh --seed
php artisan db:seed --class=NavbarSettingSeeder

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Filament
php artisan filament:optimize
php artisan make:filament-resource ModelName

# Livewire
php artisan make:livewire ComponentName
```

### C. URLs importantes

| URL | Description |
|-----|-------------|
| `/` | Page d'accueil |
| `/annuaire` | Annuaire (membres) |
| `/questionnaire` | Questionnaire guidé |
| `/admin` | Panel administration |
| `/admin/professionals` | Gestion professionnels |
| `/admin/global-settings` | Paramètres globaux |

---

*Document généré le 17 janvier 2026*
*Version du projet : commit 25239ef*
