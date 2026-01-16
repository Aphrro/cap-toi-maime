# PLAN DE REFONTE - CAP TOI M'AIME

## Date: 16 janvier 2026

---

# PARTIE 1: ÉTAT DES LIEUX

## 1.1 Ce qui EXISTE et FONCTIONNE

### Backend / Base de données
| Element | Status | Notes |
|---------|--------|-------|
| 23 Models | OK | Professional, Category, Specialty, Canton, City, User, etc. |
| 43 Migrations | OK | Tables bien structurées |
| Spatie Permissions | OK | Rôles admin/member configurés |
| Spatie MediaLibrary | OK | Upload d'images fonctionnel |

### Filament Admin (17 Resources)
| Resource | Status | Notes |
|----------|--------|-------|
| ProfessionalResource | OK | CRUD complet avec validation |
| CategoryResource | OK | Gestion des catégories |
| SpecialtyResource | OK | Gestion des spécialités |
| CantonResource | OK | Cantons suisses |
| CityResource | OK | Villes par canton |
| UserResource | OK | Gestion utilisateurs |
| MemberResource | OK | Gestion membres |
| EventResource | OK | Gestion événements |
| FaqResource | OK | Gestion FAQ |
| TestimonialResource | OK | Témoignages |
| PageResource | PROBLEME | Tabs CMS créés mais pas connectés au frontend |
| LanguageResource | OK | Langues |
| ProfessionResource | OK | Professions |
| ReimbursementTypeResource | OK | Types remboursement |
| SettingResource | OK | Paramètres |
| ContactMessageResource | OK | Messages contact |

### Livewire Components (11)
| Composant | Status | Notes |
|-----------|--------|-------|
| HomePage | OK | Page d'accueil fonctionnelle |
| Questionnaire | OK | 5 étapes, fonctionne |
| Results | OK | Affiche résultats avec scoring |
| ProfessionalSearch | OK | Annuaire avec filtres |
| ProfessionalShow | OK | Fiche pro détaillée |
| ContactPage | OK | Formulaire contact |
| FaqPage | OK | Page FAQ |
| EspacePro | OK | Page espace pro |
| ProfessionalCard | OK | Composant carte pro |

### Routes
| Route | Status | Accès |
|-------|--------|-------|
| `/` | OK | Public |
| `/contact` | OK | Public |
| `/faq` | OK | Public |
| `/espace-pro` | OK | Public |
| `/temoignages` | OK | Public |
| `/annuaire` | OK | Membres seulement |
| `/questionnaire` | OK | Membres seulement |
| `/resultats` | OK | Membres seulement |
| `/professionnel/{slug}` | OK | Membres seulement |
| `/admin` | OK | Admins seulement |

---

## 1.2 Ce qui MANQUE ou est INCOMPLET

### Pages publiques manquantes
| Page | Status | Priorité |
|------|--------|----------|
| `/a-propos` | MANQUANT | Haute |
| Pages légales (conditions, confidentialité, charte) | Templates vides | Moyenne |

### CMS / Contenu éditable
| Element | Status | Problème |
|---------|--------|----------|
| PageResource tabs | EXISTE | Les tabs existent mais le frontend ne lit pas le contenu |
| home-page.blade.php | HARDCODÉ | Contenu en dur, pas dynamique |
| Autres pages | HARDCODÉ | Pas connectées au CMS |

### Fonctionnalités manquantes
| Fonctionnalité | Status | Dans les specs |
|----------------|--------|----------------|
| Dashboard Analytics | MANQUANT | Oui |
| Système de notifications email | PARTIEL | Oui |
| Tracking comportemental complet | PARTIEL | Oui (SmartTracker) |
| Assistant Widget | MANQUANT | Oui |

---

## 1.3 Architecture actuelle

```
/Users/kry8/cap-toi-maime/
├── app/
│   ├── Filament/Resources/ (17 resources)
│   ├── Livewire/ (11 components)
│   ├── Models/ (23 models)
│   └── Services/ (quelques services)
├── database/
│   ├── migrations/ (43 migrations)
│   └── seeders/
├── resources/views/
│   ├── layouts/public.blade.php
│   ├── livewire/ (templates Livewire)
│   └── pages/ (pages statiques)
└── routes/web.php
```

---

# PARTIE 2: DECISION ARCHITECTURALE

## Option A: Site STATIQUE avec Admin pour données seulement
**Description**: Le frontend reste en templates Blade hardcodés. L'admin gère uniquement les données (pros, catégories, etc.) pas le contenu des pages.

**Avantages**:
- Simple à maintenir
- Rapide à implémenter
- Pas de complexité CMS

**Inconvénients**:
- Marine ne peut pas modifier les textes sans développeur
- Moins flexible

---

## Option B: Site DYNAMIQUE avec CMS complet
**Description**: Tout le contenu est éditable depuis l'admin. Chaque page lit son contenu depuis le modèle Page.

**Avantages**:
- Marine peut tout modifier seule
- Flexibilité totale
- Correspond aux specs initiales

**Inconvénients**:
- Plus complexe à implémenter correctement
- Risque de casser le site si mal fait (comme précédemment)

---

## Option C: HYBRIDE (Recommandée)
**Description**: Les données dynamiques (pros, catégories) restent comme maintenant. Pour les pages CMS, on utilise une structure simple avec sections éditables spécifiques.

**Avantages**:
- Équilibre entre simplicité et flexibilité
- Ce qui fonctionne reste intact
- Ajout progressif du CMS

**Structure**:
```
Pages statiques (Livewire existants):
├── HomePage → garde la structure, ajoute quelques champs éditables (titre hero, CTA)
├── ContactPage → garde tel quel
├── FaqPage → FAQ depuis BDD (déjà fait)
└── EspacePro → garde tel quel

Nouvelles pages CMS:
├── AboutPage → nouvelle page, contenu 100% depuis Page model
└── Pages légales → contenu depuis Page model
```

---

# PARTIE 3: PLAN D'EXECUTION DETAILLE

## Phase 1: Nettoyage et Stabilisation (Priorité CRITIQUE)

### 1.1 Supprimer le code problématique
- [ ] Simplifier PageResource.php (garder seulement SEO + contenu basique)
- [ ] Nettoyer les routes orphelines
- [ ] Vérifier que tout fonctionne en production

### 1.2 Corriger les petits bugs
- [ ] Vérifier toutes les pages publiques
- [ ] Tester le parcours utilisateur complet
- [ ] Vérifier l'admin Filament

---

## Phase 2: Page À Propos (Priorité HAUTE)

### 2.1 Créer AboutPage Livewire
```php
// app/Livewire/AboutPage.php
class AboutPage extends Component
{
    public function render()
    {
        $page = Page::findBySlug('a-propos');
        return view('livewire.about-page', [
            'content' => $page?->content ?? []
        ])->layout('layouts.public');
    }
}
```

### 2.2 Créer le template
```
resources/views/livewire/about-page.blade.php
├── Hero section (titre, sous-titre)
├── Notre mission (texte + image)
├── Nos valeurs (3 cartes)
├── L'équipe (photos + bios)
└── CTA final
```

### 2.3 Ajouter la route
```php
Route::get('/a-propos', AboutPage::class)->name('about');
```

### 2.4 Configurer PageResource pour a-propos
- Tabs: Hero, Mission, Valeurs, Equipe, CTA
- Seeder avec contenu par défaut

---

## Phase 3: Homepage partiellement éditable (Priorité MOYENNE)

### 3.1 Ce qui reste statique
- Structure HTML/CSS
- Affichage des catégories (depuis Category model)
- Affichage des spécialités (depuis Specialty model)
- Professionnels mis en avant (depuis Professional model)

### 3.2 Ce qui devient éditable
- Titre du hero
- Sous-titre du hero
- Texte CTA final
- Couleurs (optionnel)

### 3.3 Modification HomePage.php
```php
public function render()
{
    $page = Page::findBySlug('accueil');
    return view('livewire.home-page', [
        'heroContent' => $page?->content['hero'] ?? [],
        'ctaContent' => $page?->content['cta'] ?? [],
        'categories' => Category::active()->ordered()->limit(6)->get(),
        'specialties' => Specialty::active()->whereIn('slug', [...])->get(),
        'featuredPros' => Professional::where('is_featured', true)->...->get(),
    ])->layout('layouts.public');
}
```

---

## Phase 4: Pages légales (Priorité BASSE)

### 4.1 Templates simples
- conditions-utilisation
- politique-confidentialite
- charte-ethique

### 4.2 Contenu depuis Page model
Chaque page = 1 entrée dans pages table avec content JSON contenant le texte légal.

---

## Phase 5: Dashboard Analytics Admin (Priorité BASSE)

### 5.1 Widgets Filament
- StatsOverview (pros en attente, membres actifs, vues)
- PendingProfessionals (tableau des pros à valider)
- RecentActivity (dernières actions)

---

# PARTIE 4: STRUCTURE DES FICHIERS A CREER/MODIFIER

## Fichiers à CREER
```
app/Livewire/AboutPage.php
resources/views/livewire/about-page.blade.php
database/seeders/AboutPageSeeder.php
```

## Fichiers à MODIFIER
```
routes/web.php (ajouter route /a-propos)
app/Filament/Resources/PageResource.php (simplifier les tabs)
app/Livewire/HomePage.php (ajouter lecture partielle CMS)
resources/views/livewire/home-page.blade.php (utiliser variables CMS)
database/seeders/PageSeeder.php (ajouter contenu a-propos)
```

## Fichiers à NE PAS TOUCHER
```
app/Livewire/Questionnaire.php
app/Livewire/Results.php
app/Livewire/ProfessionalSearch.php
app/Livewire/ProfessionalShow.php
(tout ce qui fonctionne actuellement)
```

---

# PARTIE 5: VERIFICATION AVANT CHAQUE DEPLOIEMENT

## Checklist
- [ ] `php artisan route:list` - pas d'erreurs
- [ ] `php artisan config:cache` - pas d'erreurs
- [ ] Tester homepage locale
- [ ] Tester admin locale
- [ ] Commit avec message clair
- [ ] Push vers GitHub
- [ ] SSH sur serveur et déployer
- [ ] Vérifier site en production

---

# RESUME EXECUTIF

**Situation actuelle**: Site fonctionnel mais CMS mal implémenté (j'ai modifié le frontend alors qu'il fallait seulement l'admin).

**Solution recommandée**: Approche HYBRIDE
1. Garder ce qui fonctionne (Livewire components, structure actuelle)
2. Ajouter une page À Propos avec CMS
3. Rendre partiellement éditable la homepage (seulement hero + CTA)
4. Simplifier PageResource pour éviter la confusion

**Prochaine étape**: Votre validation de ce plan avant d'implémenter.
