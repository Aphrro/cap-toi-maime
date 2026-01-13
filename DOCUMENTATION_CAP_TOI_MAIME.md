# Documentation Cap Toi M'aime

## Vue d'ensemble

**Cap Toi M'aime** est une plateforme web Laravel 12 conçue pour connecter les parents d'enfants confrontés à des difficultés scolaires (phobie scolaire, anxiété, TDAH, dyslexie, harcèlement, etc.) avec des professionnels spécialisés (psychologues, coachs, thérapeutes, neuropsychologues) en Suisse romande.

### Technologies utilisées

| Composant | Technologie |
|-----------|-------------|
| Backend | Laravel 12 |
| Frontend réactif | Livewire 3 |
| Administration | Filament 3 |
| CSS | Tailwind CSS 3 |
| Base de données | SQLite |
| Tracking comportemental | JavaScript (SmartTracker) |
| Packages | Spatie (sluggable, media-library, permissions) |

---

## 1. Architecture du projet

```
┌─────────────────────────────────────────────────────────────┐
│                    FRONTEND (Alpine.js)                      │
│  ┌─────────────┐  ┌─────────────┐  ┌──────────────────────┐ │
│  │ SmartTracker│  │ Assistant   │  │ Composants Livewire  │ │
│  │ (tracking)  │  │ Widget      │  │ (questionnaire, etc) │ │
│  └──────┬──────┘  └──────┬──────┘  └──────────┬───────────┘ │
└─────────┼────────────────┼────────────────────┼─────────────┘
          │                │                    │
          ▼                ▼                    ▼
┌─────────────────────────────────────────────────────────────┐
│                    BACKEND (Laravel 12)                      │
│  ┌─────────────────┐  ┌─────────────────────────────────┐   │
│  │ TrackingService │  │ Services métier                 │   │
│  │ BehaviorAnalyzer│  │ - ProfessionalMatcher           │   │
│  │ NavigationHelper│  │ - RecommendationEngine          │   │
│  └────────┬────────┘  └─────────────────────────────────┘   │
│           │                                                  │
│           ▼                                                  │
│  ┌─────────────────────────────────────────────────────┐    │
│  │              BASE DE DONNEES (SQLite)                │    │
│  │  users | professionals | user_sessions | user_events │    │
│  └─────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────┘
```

---

## 2. Pages publiques

### Navigation principale

| Route | Composant | Description |
|-------|-----------|-------------|
| `/` | HomePage | Page d'accueil avec professionnels vedettes |
| `/questionnaire` | Questionnaire | Questionnaire guidé en 5 étapes |
| `/resultats` | Results | Résultats personnalisés avec scoring |
| `/annuaire` | ProfessionalSearch | Annuaire avec filtres avancés |
| `/professionnel/{slug}` | ProfessionalShow | Page détail d'un professionnel |
| `/a-propos` | Static | Présentation de l'association |
| `/contact` | Static | Formulaire de contact |
| `/faq` | Static | Questions fréquentes |
| `/temoignages` | Static | Témoignages approuvés |
| `/espace-pro` | EspacePro | Espace pour les professionnels |

### Pages légales

- `/conditions-utilisation` - Conditions d'utilisation
- `/politique-confidentialite` - Politique de confidentialité
- `/charte-ethique` - Charte éthique

---

## 3. Questionnaire intelligent

### Les 5 étapes

1. **Situation** - Type de problématique (phobie scolaire, refus scolaire, décrochage, autre)
2. **Particularités** - HPI, TDAH, TSA, troubles Dys, harcèlement, etc.
3. **Enfant** - Âge et durée du problème
4. **Préférences** - Canton, modes de consultation (cabinet/visio/domicile), langue
5. **Priorités** - Ce qui compte le plus pour la famille

### Fonctionnement

```
Utilisateur remplit questionnaire
        ↓
Données sauvegardées dans UserSession.questionnaire_data
        ↓
Redirection vers /resultats
        ↓
ProfessionalMatcher.match() calcule les scores
        ↓
Affichage des professionnels triés par pertinence
```

---

## 4. Algorithme de matching

### Système de scoring (100 points max)

| Critère | Points | Description |
|---------|--------|-------------|
| Spécialités | 35 | Correspondance avec les besoins |
| Catégorie | 20 | Type de professionnel adapté |
| Localisation | 15 | Proximité géographique |
| Disponibilité | 10 | Modes de consultation souhaités |
| Note/Avis | 10 | Réputation du professionnel |
| Vérifié | 5 | Badge de vérification |
| Langue | 5 | Langue de consultation |

### Bonus et malus

- **+8 points** : Spécialité phobie/refus/décrochage scolaire
- **+8 points** : Spécialiste neuro-atypiques (HPI, TDAH, TSA)
- **-5 points** : Profil incomplet

### Filtres bloquants

- Langue non parlée = exclu
- Mode de consultation non disponible = exclu

---

## 5. Système d'assistant intelligent

### Composants

1. **SmartTracker** (JavaScript) - Collecte les données comportementales
2. **BehaviorAnalyzer** (PHP) - Analyse le comportement en temps réel
3. **AssistantWidget** (Livewire) - Affiche l'aide proactive

### Détection comportementale

| Signal | Déclencheur |
|--------|-------------|
| Frustration | Clics rapides répétés (rage clicks) |
| Confusion | Scroll erratique, changements de direction fréquents |
| Intention de sortie | Souris vers le haut de l'écran |
| Inactivité | Aucune action depuis 60+ secondes |
| Engagement faible | Peu de scroll, temps court sur page |

### Intentions utilisateur détectées

- `browsing` - Navigation exploratoire
- `searching` - Recherche active
- `comparing` - Comparaison de professionnels
- `deciding` - Prise de décision
- `confused` - Utilisateur perdu
- `ready_to_contact` - Prêt à contacter
- `leaving` - Sur le point de partir

### Interventions proactives

| Situation | Message |
|-----------|---------|
| Utilisateur frustré | "Vous semblez rencontrer des difficultés. Comment puis-je vous aider ?" |
| Recherche sans résultats | "Aucun résultat. Essayez d'élargir vos critères ou notre questionnaire." |
| Intention de sortie | "Avant de partir, essayez notre questionnaire gratuit !" |
| Utilisateur inactif | "Besoin d'aide pour trouver un professionnel ?" |
| Longue consultation d'un profil | "Ce professionnel semble correspondre. Prêt à le contacter ?" |

---

## 6. Tracking et analytics

### Événements suivis

| Catégorie | Événements |
|-----------|------------|
| Navigation | page_view, scroll, exit_intent |
| Interaction | click, hover_cta, form_start, form_abandon |
| Recherche | search, filter_applied, no_results |
| Questionnaire | step_completed, questionnaire_completed |
| Professional | card_viewed, profile_viewed, contact_initiated |
| Assistant | suggestion_shown, suggestion_clicked, suggestion_dismissed |

### Métriques de session

- Pages vues
- Professionnels consultés
- Profondeur de scroll
- Temps sur page
- Niveau d'engagement (low/medium/high)
- Signaux de frustration

---

## 7. Modèles de données

### Entités principales

```
User (utilisateur)
├── ParentProfile (profil parent)
│   └── Child (enfant)
├── Professional (professionnel)
│   ├── Category (catégorie)
│   ├── Specialty (spécialités) [many-to-many]
│   └── City → Canton (localisation)
├── UserSession (session de tracking)
│   └── UserEvent (événements)
└── UserPreference (préférences)

RecommendationRule (règles de recommandation)
Testimonial (témoignages)
```

### Statuts des professionnels

| Champ | Valeurs | Description |
|-------|---------|-------------|
| validation_status | pending, approved, rejected | Processus de validation |
| is_active | true/false | Activé/désactivé |
| is_verified | true/false | Badge vérifié |
| is_featured | true/false | Mis en avant |

---

## 8. Administration (Filament)

### Accès

URL: `/admin`

### Ressources disponibles

| Ressource | Actions |
|-----------|---------|
| Professionals | Voir, approuver, rejeter, modifier, supprimer |
| Users | Gérer les comptes, suspendre |
| Categories | Créer, modifier les catégories |
| Specialties | Gérer les spécialités |
| Cantons | Gérer les cantons suisses |
| Cities | Gérer les villes |
| Testimonials | Approuver/rejeter les témoignages |

### Workflow de validation

1. Professionnel s'inscrit → statut `pending`
2. Admin examine le profil
3. **Approuver** → statut `approved`, visible sur l'annuaire
4. **Rejeter** → statut `rejected` avec raison, notification au professionnel

---

## 9. Services métier

### TrackingService (215 lignes)
- Création/récupération des sessions
- Enregistrement des événements
- Cookie visitor_id (1 an)

### BehaviorAnalyzer (614 lignes)
- Analyse en temps réel
- Détection d'intention
- Calcul d'engagement
- Détection de frustration

### ProfessionalMatcher (322 lignes)
- Algorithme de matching
- Scoring multicritères
- Suggestions de fallback

### RecommendationEngine (305 lignes)
- Évaluation des règles
- Suggestions contextuelles
- Next best action

### NavigationHelper (251 lignes)
- Breadcrumbs intelligents
- Suggestions de navigation
- Actions rapides

---

## 10. API

### Tracking (`/api/track/`)

| Endpoint | Méthode | Description |
|----------|---------|-------------|
| `/track/` | POST | Enregistrer un événement |
| `/track/session` | GET | Obtenir/créer session |
| `/track/questionnaire` | POST | Mettre à jour questionnaire |
| `/track/questionnaire/complete` | POST | Terminer questionnaire |

### Assistant (`/api/assistant/`)

| Endpoint | Méthode | Description |
|----------|---------|-------------|
| `/assistant/suggestions` | GET | Obtenir suggestions |
| `/assistant/hints` | GET | Obtenir hints contextuels |
| `/assistant/navigation` | GET | Obtenir suggestions navigation |
| `/assistant/suggestion/click` | POST | Tracker clic suggestion |
| `/assistant/suggestion/dismiss` | POST | Tracker dismiss |

### Rate limiting

- Tracking: 120 requêtes/minute
- Assistant: 60 requêtes/minute

---

## 11. Parcours utilisateur types

### Parcours 1: Parent cherchant un professionnel

```
1. Visite page d'accueil
2. Démarre le questionnaire (5 étapes)
3. Obtient des recommandations personnalisées
4. Consulte les profils des professionnels
5. Contacte un professionnel
6. (Optionnel) Sauvegarde ses favoris
```

### Parcours 2: Inscription d'un professionnel

```
1. Visite /espace-pro
2. Crée un compte professionnel
3. Remplit son profil complet
4. Télécharge ses justificatifs
5. Soumet pour validation
6. Attend approbation admin
7. Profil visible sur l'annuaire
```

### Parcours 3: Administration

```
1. Connexion /admin
2. Consulte les professionnels en attente
3. Examine chaque profil
4. Approuve ou rejette avec feedback
5. Gère les témoignages
6. Consulte les statistiques
```

---

## 12. Spécificités suisses

- **Cantons** : Tous les cantons romands (VD, GE, VS, NE, FR, JU, BE)
- **Numéros professionnels** : RCC, GLN, ZSR, K-Nummer
- **Assurances** : RCC (Registre des codes créanciers)
- **Langues** : Français, Allemand, Anglais, Italien
- **Codes postaux** : Validation format suisse (4 chiffres)
- **Téléphones** : Validation format suisse (+41, 0)

---

## 13. Fichiers clés

### Backend

```
app/
├── Livewire/
│   ├── HomePage.php
│   ├── Questionnaire.php
│   ├── Results.php
│   ├── ProfessionalSearch.php
│   ├── ProfessionalShow.php
│   └── AssistantWidget.php
├── Services/
│   ├── TrackingService.php
│   ├── BehaviorAnalyzer.php
│   ├── ProfessionalMatcher.php
│   ├── RecommendationEngine.php
│   └── NavigationHelper.php
├── Models/
│   ├── User.php
│   ├── Professional.php
│   ├── UserSession.php
│   └── ...
└── Filament/Resources/
    ├── ProfessionalResource.php
    └── ...
```

### Frontend

```
resources/
├── js/
│   ├── app.js
│   └── tracking.js (SmartTracker)
├── css/
│   └── app.css
└── views/
    ├── layouts/public.blade.php
    ├── livewire/
    │   ├── home-page.blade.php
    │   ├── questionnaire.blade.php
    │   └── assistant-widget.blade.php
    └── pages/
        ├── about.blade.php
        ├── faq.blade.php
        └── ...
```

---

## 14. Déploiement

### Serveur

- **Hébergement** : Laravel Forge
- **IP** : 49.12.227.161
- **Domaine** : cap-toi-maime-klosj3gz.on-forge.com
- **Git** : GitHub (Aphrro/cap-toi-maime)

### Commandes de déploiement

```bash
# Connexion SSH
ssh forge@49.12.227.161

# Déploiement manuel
cd /home/forge/cap-toi-maime-klosj3gz.on-forge.com/current
git fetch origin main
git reset --hard origin/main
npm run build
php artisan optimize:clear
```

---

## 15. Statistiques du projet

| Métrique | Valeur |
|----------|--------|
| Modèles | 14 |
| Composants Livewire | 9 |
| Services (lignes) | ~1,950 |
| Ressources Filament | 7 |
| Migrations | 23 |
| Endpoints API | 8 |

---

## 16. Fonctionnalités à venir (suggestions)

1. **Dashboard analytics** - Visualisation des données de tracking
2. **Notifications email** - Alertes aux professionnels/parents
3. **Système de messagerie** - Communication in-app
4. **Avis vérifiés** - Parents peuvent noter les professionnels
5. **Géolocalisation** - Recherche par proximité
6. **PWA** - Application mobile progressive

---

## 17. Contact et support

- **Email** : contact@captoimaime.ch
- **Région** : Suisse romande
- **Repository** : github.com/Aphrro/cap-toi-maime

---

*Document généré le 13 janvier 2026*
