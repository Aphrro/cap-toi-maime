# SPÉCIFICATIONS TECHNIQUES COMPLÈTES
## Cap Toi M'aime - L'Annuaire
### Version 3.0 - Document de référence pour Claude Code

**Date**: 16 janvier 2026  
**Auteur**: Kry8  
**Pour**: Claude Code  
**Client**: Marine - Association Cap Toi M'aime

---

# ⚠️ RÈGLES ABSOLUES - LIRE EN PREMIER

## PHILOSOPHIE : CONSTRUIRE SUR L'EXISTANT

Le projet a déjà une base solide. **NE PAS REPARTIR DE ZÉRO.**

Tu dois :
1. **Auditer** ce qui existe
2. **Préserver** ce qui fonctionne
3. **Enrichir** avec les nouvelles fonctionnalités
4. **Corriger** uniquement ce qui est cassé (PageResource)

## Ce que tu NE DOIS JAMAIS faire

1. ❌ **NE JAMAIS supprimer de fichiers existants**
2. ❌ **NE JAMAIS modifier les Livewire components** sans validation explicite
3. ❌ **NE JAMAIS modifier les migrations existantes** - créer de NOUVELLES migrations
4. ❌ **NE JAMAIS modifier le layout public** (`layouts/public.blade.php`)
5. ❌ **NE JAMAIS écraser une Resource Filament** - modifier uniquement
6. ❌ **NE JAMAIS déployer** sans test local complet

## Ce que tu DOIS faire

1. ✅ **Toujours commencer par l'audit** (Phase 0)
2. ✅ **Toujours créer un backup** avant modification
3. ✅ **Toujours tester** avec `php artisan serve` + `php artisan route:list`
4. ✅ **Toujours commiter** après chaque phase avec message clair
5. ✅ **Toujours demander validation** après chaque phase majeure

---

# PHASE 0 : AUDIT DU PROJET (OBLIGATOIRE)

## 0.1 Commandes d'audit à exécuter EN PREMIER

```bash
# 1. Vérifier la structure du projet
ls -la /Users/kry8/cap-toi-maime/

# 2. Lister les Models existants
ls -la app/Models/

# 3. Lister les Resources Filament existantes
ls -la app/Filament/Resources/

# 4. Lister les Widgets existants
ls -la app/Filament/Widgets/ 2>/dev/null || echo "Pas de widgets"

# 5. Lister les Livewire components
ls -la app/Livewire/

# 6. Lister les migrations
ls -la database/migrations/

# 7. Vérifier les routes
php artisan route:list --compact

# 8. Vérifier que le projet compile
php artisan config:cache
php artisan route:clear
```

## 0.2 Inventaire attendu (basé sur PLAN_REFONTE_SITE.md)

### Models existants (23 attendus)
```
Professional, Category, Specialty, Canton, City, User, Member, 
Event, Faq, Testimonial, Page, Language, Profession, 
ReimbursementType, Setting, ContactMessage, + autres
```

### Resources Filament existantes (17 attendues)
```
ProfessionalResource ✅
CategoryResource ✅
SpecialtyResource ✅
CantonResource ✅
CityResource ✅
UserResource ✅
MemberResource ✅
EventResource ✅
FaqResource ✅
TestimonialResource ✅
PageResource ⚠️ (à refaire - tabs CMS non connectés)
LanguageResource ✅
ProfessionResource ✅
ReimbursementTypeResource ✅
SettingResource ✅
ContactMessageResource ✅
```

### Livewire Components existants (11 attendus)
```
HomePage ✅
Questionnaire ✅
Results ✅
ProfessionalSearch ✅
ProfessionalShow ✅
ContactPage ✅
FaqPage ✅
EspacePro ✅
ProfessionalCard ✅
+ autres
```

### Routes existantes
```
/ (Accueil) - Public ✅
/contact - Public ✅
/faq - Public ✅
/espace-pro - Public ✅
/temoignages - Public ✅
/annuaire - Membres ✅
/questionnaire - Membres ✅
/resultats - Membres ✅
/professionnel/{slug} - Membres ✅
/admin - Admins ✅
```

## 0.3 Rapport d'audit à produire

Après les commandes, produis un rapport :

```markdown
## RAPPORT D'AUDIT - Cap Toi M'aime

### Models trouvés : X/23
[Liste]

### Resources Filament trouvées : X/17
[Liste]

### Livewire Components trouvés : X/11
[Liste]

### Widgets existants : X
[Liste ou "Aucun"]

### Routes fonctionnelles : ✅/❌

### Problèmes détectés :
- [Liste des problèmes]

### Prêt pour Phase 1 : OUI/NON
```

---

# PARTIE 1 : CONTEXTE ET VISION

## 1.1 Qu'est-ce que Cap Toi M'aime ?

Association suisse qui accompagne les familles d'enfants en **refus scolaire anxieux** (phobie scolaire). L'annuaire permet aux membres de trouver des thérapeutes qualifiés.

## 1.2 Branding

| Élément | Valeur |
|---------|--------|
| Nom officiel | **L'annuaire Cap Toi M'aime** |
| ~~ProSanté~~ | ❌ NE PAS UTILISER - ancien nom |
| Email principal | hello@captoimaime.ch |
| Site association | www.captoimaime.ch |

## 1.3 Utilisateurs du système

| Rôle | Description | Accès |
|------|-------------|-------|
| **Super Admin** | Marine + Kry8 | Tout |
| **Membre** | Parent adhérent | Annuaire, questionnaire, fiches pros |
| **Professionnel** | Thérapeute référencé | Sa fiche (lecture) |
| **Visiteur** | Non connecté | Page d'accueil uniquement |

## 1.4 Logique d'accès

```
PAGES PUBLIQUES (SEO, tout le monde)
├── / (Accueil)
├── /a-propos
├── /contact
├── /faq
├── /espace-pro
└── /evenements

PAGES MEMBRES UNIQUEMENT
├── /annuaire
├── /questionnaire
├── /resultats
└── /professionnel/{slug}

ADMIN
└── /admin
```

**Message pour non-membres sur l'annuaire :**
> "Les fonctionnalités de cet annuaire sont réservées aux membres de l'association Cap Toi M'aime. Si cela vous intéresse, vous pouvez prendre votre adhésion sur le lien suivant : [lien]. Nous étudions votre demande sous 48h et après validation, vous recevrez un email avec vos codes d'accès."

---

# PARTIE 2 : CE QU'IL FAUT CRÉER/MODIFIER

## 2.1 Fichiers à CRÉER (nouveaux)

### Widgets Filament (dossier app/Filament/Widgets/)
```
StatsOverview.php - Widget stats (4 cartes)
PendingProfessionals.php - Tableau des pros en attente
PendingMembers.php - Tableau des membres en attente
UpcomingEvents.php - Liste des prochains événements
QuickActions.php - Boutons d'actions rapides
```

### Templates Blade pour widgets (dossier resources/views/filament/widgets/)
```
upcoming-events.blade.php
quick-actions.blade.php
```

### Migrations (dossier database/migrations/)
```
2026_01_16_000001_add_fields_to_professionals_table.php
2026_01_16_000002_add_fields_to_events_table.php
2026_01_16_000003_create_event_professional_table.php
2026_01_16_000004_update_members_table.php
```

## 2.2 Fichiers à MODIFIER (existants)

### Models à enrichir
```
app/Models/Professional.php - Ajouter fillable, casts, accessors
app/Models/Event.php - Ajouter relation professionals()
app/Models/Member.php - Vérifier les champs
```

### Resources Filament à modifier
```
app/Filament/Resources/ProfessionalResource.php - Enrichir le formulaire
app/Filament/Resources/EventResource.php - Ajouter type Speed Dating
app/Filament/Resources/PageResource.php - REFONTE COMPLÈTE du CMS
app/Filament/Resources/MemberResource.php - Ajouter validation
+ Toutes les Resources : ajouter getNavigationGroup()
```

### Provider à modifier
```
app/Providers/Filament/AdminPanelProvider.php - Navigation groups + widgets
```

## 2.3 Fichiers à NE PAS TOUCHER

```
❌ app/Livewire/* (tous les composants)
❌ resources/views/livewire/* (tous les templates)
❌ resources/views/layouts/public.blade.php
❌ database/migrations/* (fichiers existants)
❌ routes/web.php (sauf ajout de nouvelles routes)
```

---

# PARTIE 3 : STRUCTURE DU DASHBOARD

## 3.1 Navigation Filament

```
SIDEBAR ADMIN
│
├── 🏠 Dashboard
│   ├── StatsOverview
│   ├── PendingProfessionals
│   ├── PendingMembers
│   ├── UpcomingEvents
│   └── QuickActions
│
├── 📋 ANNUAIRE
│   ├── Professionnels ⭐
│   ├── Catégories
│   ├── Spécialités
│   ├── Professions
│   └── Types de remboursement
│
├── 👥 MEMBRES
│   └── Membres ⭐
│
├── 🗓️ ÉVÉNEMENTS
│   └── Événements ⭐
│
├── 📍 LOCALISATION
│   ├── Cantons
│   └── Villes
│
├── 📄 CONTENU
│   ├── Pages (CMS) ⭐
│   ├── FAQ
│   └── Témoignages
│
├── 📧 MESSAGES
│   └── Messages de contact
│
└── ⚙️ PARAMÈTRES
    ├── Paramètres généraux
    ├── Langues
    └── Utilisateurs
```

## 3.2 Configuration des Navigation Groups

**Ajouter à chaque Resource existante :**

```php
// Dans ProfessionalResource, CategoryResource, SpecialtyResource, 
// ProfessionResource, ReimbursementTypeResource
public static function getNavigationGroup(): ?string
{
    return 'Annuaire';
}

// Dans MemberResource
public static function getNavigationGroup(): ?string
{
    return 'Membres';
}

// Dans EventResource
public static function getNavigationGroup(): ?string
{
    return 'Événements';
}

// Dans CantonResource, CityResource
public static function getNavigationGroup(): ?string
{
    return 'Localisation';
}

// Dans PageResource, FaqResource, TestimonialResource
public static function getNavigationGroup(): ?string
{
    return 'Contenu';
}

// Dans ContactMessageResource
public static function getNavigationGroup(): ?string
{
    return 'Messages';
}

// Dans SettingResource, LanguageResource, UserResource
public static function getNavigationGroup(): ?string
{
    return 'Paramètres';
}
```

---

# PARTIE 4 : WIDGETS DU DASHBOARD

## 4.1 StatsOverview.php

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Professional;
use App\Models\Member;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        return [
            Stat::make('Pros en attente', Professional::where('status', 'pending')->count())
                ->description('À valider')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            
            Stat::make('Membres en attente', Member::where('status', 'pending')->count())
                ->description('Adhésions à valider')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning'),
            
            Stat::make('Membres actifs', Member::where('status', 'active')->count())
                ->description('Adhésions valides')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            
            Stat::make('Messages non lus', ContactMessage::where('is_read', false)->count())
                ->description('À traiter')
                ->descriptionIcon('heroicon-m-envelope')
                ->color(ContactMessage::where('is_read', false)->count() > 0 ? 'danger' : 'gray'),
        ];
    }
}
```

## 4.2 PendingProfessionals.php

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Professional;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class PendingProfessionals extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = '🔔 Professionnels en attente de validation';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Professional::query()
                    ->where('status', 'pending')
                    ->with(['profession', 'city', 'canton'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo')
                    ->circular()
                    ->label('')
                    ->defaultImageUrl(fn (Professional $record) => 
                        'https://ui-avatars.com/api/?name=' . urlencode($record->full_name ?? 'Pro') . '&background=random'
                    ),
                
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom')
                    ->description(fn (Professional $record) => $record->email),
                
                Tables\Columns\TextColumn::make('profession.name')
                    ->label('Profession')
                    ->badge()
                    ->color('gray'),
                
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Ville')
                    ->description(fn (Professional $record) => $record->canton?->name),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscrit le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Professional $record) => route('filament.admin.resources.professionals.edit', $record)),
                
                Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approuver ce professionnel ?')
                    ->action(function (Professional $record) {
                        $record->update(['status' => 'approved']);
                        Notification::make()
                            ->title('Professionnel approuvé ✅')
                            ->success()
                            ->send();
                    }),
                
                Action::make('reject')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Professional $record) {
                        $record->update(['status' => 'rejected']);
                        Notification::make()
                            ->title('Professionnel refusé')
                            ->warning()
                            ->send();
                    }),
            ])
            ->emptyStateHeading('Aucun professionnel en attente 🎉')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
```

## 4.3 PendingMembers.php

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Carbon\Carbon;

class PendingMembers extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = '👥 Adhésions en attente';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Member::query()
                    ->where('status', 'pending')
                    ->with('user')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nom')
                    ->description(fn (Member $record) => $record->user?->email),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Demande le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Valider')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Member $record) {
                        $record->update([
                            'status' => 'active',
                            'starts_at' => Carbon::now(),
                            'expires_at' => Carbon::now()->addYear(),
                        ]);
                        Notification::make()
                            ->title('Adhésion validée ✅')
                            ->success()
                            ->send();
                    }),
                
                Action::make('reject')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Member $record) {
                        $record->update(['status' => 'cancelled']);
                    }),
            ])
            ->emptyStateHeading('Aucune adhésion en attente')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
```

## 4.4 UpcomingEvents.php

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\Widget;
use Carbon\Carbon;

class UpcomingEvents extends Widget
{
    protected static ?int $sort = 4;
    protected static string $view = 'filament.widgets.upcoming-events';
    protected int | string | array $columnSpan = 1;

    public function getEvents()
    {
        return Event::query()
            ->where('start_date', '>=', Carbon::now())
            ->where('is_published', true)
            ->orderBy('start_date')
            ->limit(3)
            ->get();
    }
}
```

**Template** `resources/views/filament/widgets/upcoming-events.blade.php` :

```blade
<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            🗓️ Prochains événements
        </x-slot>

        <div class="space-y-3">
            @forelse($this->getEvents() as $event)
                <a href="{{ route('filament.admin.resources.events.edit', $event) }}" 
                   class="block p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 transition">
                    <p class="font-medium text-gray-900 dark:text-white">{{ $event->title }}</p>
                    <p class="text-sm text-gray-500">{{ $event->start_date->format('d/m/Y à H:i') }}</p>
                </a>
            @empty
                <p class="text-sm text-gray-500 text-center py-4">Aucun événement à venir</p>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
```

## 4.5 QuickActions.php

```php
<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected static ?int $sort = 5;
    protected static string $view = 'filament.widgets.quick-actions';
    protected int | string | array $columnSpan = 1;
}
```

**Template** `resources/views/filament/widgets/quick-actions.blade.php` :

```blade
<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            ⚡ Actions rapides
        </x-slot>

        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('filament.admin.resources.professionals.create') }}" 
               class="flex flex-col items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 transition">
                <x-heroicon-o-user-plus class="w-6 h-6 text-blue-500 mb-2"/>
                <span class="text-xs font-medium text-center">Ajouter pro</span>
            </a>

            <a href="{{ route('filament.admin.resources.events.create') }}" 
               class="flex flex-col items-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 transition">
                <x-heroicon-o-calendar-days class="w-6 h-6 text-green-500 mb-2"/>
                <span class="text-xs font-medium text-center">Créer événement</span>
            </a>

            <a href="{{ route('filament.admin.resources.pages.index') }}" 
               class="flex flex-col items-center p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg hover:bg-amber-100 transition">
                <x-heroicon-o-document-text class="w-6 h-6 text-amber-500 mb-2"/>
                <span class="text-xs font-medium text-center">Gérer pages</span>
            </a>

            <a href="{{ route('filament.admin.resources.faqs.create') }}" 
               class="flex flex-col items-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 transition">
                <x-heroicon-o-question-mark-circle class="w-6 h-6 text-purple-500 mb-2"/>
                <span class="text-xs font-medium text-center">Ajouter FAQ</span>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
```

---

# PARTIE 5 : MIGRATIONS À CRÉER

## 5.1 Migration Professional

**Fichier** : `database/migrations/2026_01_16_000001_add_fields_to_professionals_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            if (!Schema::hasColumn('professionals', 'profile_photo')) {
                $table->string('profile_photo')->nullable();
            }
            if (!Schema::hasColumn('professionals', 'video_url')) {
                $table->string('video_url')->nullable();
            }
            if (!Schema::hasColumn('professionals', 'video_type')) {
                $table->string('video_type')->nullable();
            }
            if (!Schema::hasColumn('professionals', 'who_am_i')) {
                $table->text('who_am_i')->nullable();
            }
            if (!Schema::hasColumn('professionals', 'my_approach')) {
                $table->text('my_approach')->nullable();
            }
            if (!Schema::hasColumn('professionals', 'availability_status')) {
                $table->string('availability_status')->default('available');
            }
            if (!Schema::hasColumn('professionals', 'personal_faq')) {
                $table->json('personal_faq')->nullable();
            }
            if (!Schema::hasColumn('professionals', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $columns = ['profile_photo', 'video_url', 'video_type', 'who_am_i', 
                       'my_approach', 'availability_status', 'personal_faq', 'rejection_reason'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('professionals', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
```

## 5.2 Migration Events

**Fichier** : `database/migrations/2026_01_16_000002_add_fields_to_events_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'event_type')) {
                $table->string('event_type')->default('general');
            }
            if (!Schema::hasColumn('events', 'max_participants')) {
                $table->integer('max_participants')->nullable();
            }
            if (!Schema::hasColumn('events', 'registration_required')) {
                $table->boolean('registration_required')->default(false);
            }
            if (!Schema::hasColumn('events', 'registration_url')) {
                $table->string('registration_url')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $columns = ['event_type', 'max_participants', 'registration_required', 'registration_url'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('events', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
```

## 5.3 Migration Event-Professional pivot

**Fichier** : `database/migrations/2026_01_16_000003_create_event_professional_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('event_professional')) {
            Schema::create('event_professional', function (Blueprint $table) {
                $table->id();
                $table->foreignId('event_id')->constrained()->cascadeOnDelete();
                $table->foreignId('professional_id')->constrained()->cascadeOnDelete();
                $table->string('status')->default('registered');
                $table->timestamps();
                $table->unique(['event_id', 'professional_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('event_professional');
    }
};
```

## 5.4 Migration Members

**Fichier** : `database/migrations/2026_01_16_000004_update_members_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (!Schema::hasColumn('members', 'starts_at')) {
                $table->date('starts_at')->nullable();
            }
            if (!Schema::hasColumn('members', 'expires_at')) {
                $table->date('expires_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (Schema::hasColumn('members', 'starts_at')) {
                $table->dropColumn('starts_at');
            }
            if (Schema::hasColumn('members', 'expires_at')) {
                $table->dropColumn('expires_at');
            }
        });
    }
};
```

---

# PARTIE 6 : MODIFICATIONS DES MODELS

## 6.1 Model Professional

**Ajouter au fichier existant** `app/Models/Professional.php` :

```php
// Dans $fillable, ajouter :
'profile_photo',
'video_url',
'video_type',
'who_am_i',
'my_approach',
'availability_status',
'personal_faq',
'rejection_reason',

// Dans $casts, ajouter :
'personal_faq' => 'array',

// Ajouter accessor si pas existant :
public function getFullNameAttribute(): string
{
    return trim($this->first_name . ' ' . $this->last_name);
}
```

## 6.2 Model Event

**Ajouter au fichier existant** `app/Models/Event.php` :

```php
// Dans $fillable, ajouter :
'event_type',
'max_participants',
'registration_required',
'registration_url',

// Dans $casts, ajouter :
'registration_required' => 'boolean',
'start_date' => 'datetime',
'end_date' => 'datetime',

// Ajouter relation :
public function professionals()
{
    return $this->belongsToMany(Professional::class, 'event_professional')
        ->withPivot('status')
        ->withTimestamps();
}
```

---

# PARTIE 7 : ADMINPANELPROVIDER

**Modifier** `app/Providers/Filament/AdminPanelProvider.php` :

```php
// Dans la méthode panel(), ajouter :

->navigationGroups([
    \Filament\Navigation\NavigationGroup::make()
        ->label('Annuaire')
        ->icon('heroicon-o-book-open'),
    \Filament\Navigation\NavigationGroup::make()
        ->label('Membres')
        ->icon('heroicon-o-users'),
    \Filament\Navigation\NavigationGroup::make()
        ->label('Événements')
        ->icon('heroicon-o-calendar-days'),
    \Filament\Navigation\NavigationGroup::make()
        ->label('Localisation')
        ->icon('heroicon-o-map-pin')
        ->collapsed(),
    \Filament\Navigation\NavigationGroup::make()
        ->label('Contenu')
        ->icon('heroicon-o-document-text'),
    \Filament\Navigation\NavigationGroup::make()
        ->label('Messages')
        ->icon('heroicon-o-envelope')
        ->collapsed(),
    \Filament\Navigation\NavigationGroup::make()
        ->label('Paramètres')
        ->icon('heroicon-o-cog-6-tooth')
        ->collapsed(),
])

->widgets([
    \App\Filament\Widgets\StatsOverview::class,
    \App\Filament\Widgets\PendingProfessionals::class,
    \App\Filament\Widgets\PendingMembers::class,
    \App\Filament\Widgets\UpcomingEvents::class,
    \App\Filament\Widgets\QuickActions::class,
])
```

---

# PARTIE 8 : CHECKLIST D'EXÉCUTION

## Phase 0 : Audit (OBLIGATOIRE)
```
[ ] Exécuter les commandes d'audit
[ ] Produire le rapport d'audit
[ ] Confirmer que le projet compile
[ ] Identifier les problèmes éventuels
```

## Phase 1 : Dashboard
```
[ ] Créer dossier app/Filament/Widgets/ si inexistant
[ ] Créer les 5 fichiers widgets
[ ] Créer dossier resources/views/filament/widgets/
[ ] Créer les 2 templates Blade
[ ] Modifier AdminPanelProvider.php
[ ] Tester : php artisan serve → /admin
[ ] Commit : "feat(dashboard): add admin widgets"
```

## Phase 2 : Migrations
```
[ ] Créer les 4 fichiers de migration
[ ] Exécuter : php artisan migrate
[ ] Vérifier en BDD que les colonnes existent
[ ] Commit : "feat(db): add new fields for professionals and events"
```

## Phase 3 : Models
```
[ ] Modifier Professional.php (fillable, casts)
[ ] Modifier Event.php (fillable, casts, relation)
[ ] Tester que le site fonctionne toujours
[ ] Commit : "feat(models): update Professional and Event models"
```

## Phase 4 : Navigation Groups
```
[ ] Ajouter getNavigationGroup() à chaque Resource
[ ] Tester la navigation dans /admin
[ ] Commit : "feat(admin): organize navigation groups"
```

## Phase 5 : Test complet
```
[ ] php artisan route:list (pas d'erreurs)
[ ] php artisan serve → tester toutes les pages publiques
[ ] Tester /admin → dashboard visible
[ ] Tester création/édition d'un professionnel
[ ] Commit final : "feat(admin): complete dashboard implementation"
```

---

# COMMANDES UTILES

```bash
# Vérifier que tout compile
php artisan route:list
php artisan config:cache

# Lancer le serveur
php artisan serve

# Exécuter les migrations
php artisan migrate

# Rollback si problème
php artisan migrate:rollback

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Créer un widget Filament
php artisan make:filament-widget NomDuWidget
```

---

# RÉSUMÉ POUR CLAUDE CODE

```
1. COMMENCE PAR L'AUDIT (Phase 0)
2. NE SUPPRIME RIEN
3. CRÉE LES NOUVEAUX FICHIERS
4. MODIFIE L'EXISTANT AVEC PRÉCAUTION
5. TESTE APRÈS CHAQUE ÉTAPE
6. COMMITE RÉGULIÈREMENT
```

**Chemin du projet** : `/Users/kry8/cap-toi-maime/`

---

**FIN DU DOCUMENT - VERSION 3.0**
