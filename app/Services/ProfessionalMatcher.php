<?php

namespace App\Services;

use App\Models\Professional;
use App\Models\Specialty;
use Illuminate\Support\Collection;

class ProfessionalMatcher
{
    /**
     * Configuration des poids pour le scoring
     */
    private const WEIGHTS = [
        'specialties' => 35,      // Match exact specialites
        'category' => 20,         // Categorie correspondante
        'location' => 15,         // Distance / canton
        'availability' => 10,     // Mode de consultation
        'rating' => 10,           // Note moyenne
        'verified' => 5,          // Badge verifie
        'language' => 5,          // Langue parlee
    ];

    /**
     * Bonus/Malus
     */
    private const BONUS_SITUATION_CORE = 8;    // Specialite coeur (phobie/refus/decrochage)
    private const BONUS_NEURO = 8;              // Neuro-atypie correspondante
    private const MALUS_INCOMPLETE = -5;        // Profil incomplet

    /**
     * Specialites "coeur" de la plateforme
     */
    private const CORE_SPECIALTIES = [
        'phobie_scolaire',
        'refus_scolaire',
        'decrochage_scolaire',
    ];

    /**
     * Recherche et scoring des professionnels
     */
    public function match(array $criteria): Collection
    {
        // 1. Query de base avec filtres bloquants
        $query = Professional::query()
            ->where('is_active', true)
            ->where('validation_status', 'approved')
            ->with(['specialties:id,slug,category_id', 'city.canton', 'category']);

        // 2. Filtres bloquants
        $query = $this->applyBlockingFilters($query, $criteria);

        // 3. Recuperer les resultats
        $professionals = $query->get();

        // 4. Calculer les scores
        $scored = $professionals->map(function ($pro) use ($criteria) {
            $pro->match_score = $this->calculateScore($pro, $criteria);
            $pro->match_details = $this->getMatchDetails($pro, $criteria);
            return $pro;
        });

        // 5. Trier par score decroissant
        $sorted = $scored->sortByDesc('match_score')->values();

        // 6. Ajouter suggestion fallback si peu de resultats
        if ($sorted->count() < 3 && !empty($criteria['mode']) && $criteria['mode'] === 'cabinet') {
            $sorted->put('fallback_suggestion', 'visio');
        }

        return $sorted;
    }

    /**
     * Applique les filtres bloquants (exclusifs)
     */
    private function applyBlockingFilters($query, array $criteria)
    {
        // Filtre langue
        if (!empty($criteria['language'])) {
            $query->whereJsonContains('languages', strtoupper($criteria['language']));
        }

        // Filtre mode de consultation
        if (!empty($criteria['mode'])) {
            switch ($criteria['mode']) {
                case 'visio':
                    $query->where('mode_visio', true);
                    break;
                case 'cabinet':
                    $query->where('mode_cabinet', true);
                    break;
                case 'domicile':
                    $query->where('mode_domicile', true);
                    break;
                // 'either' = pas de filtre
            }
        }

        // Filtre canton
        if (!empty($criteria['canton'])) {
            $query->whereHas('city.canton', function ($q) use ($criteria) {
                $q->where('code', $criteria['canton']);
            });
        }

        return $query;
    }

    /**
     * Calcule le score de matching (0-100+)
     */
    private function calculateScore(Professional $pro, array $criteria): float
    {
        $score = 0.0;
        $proSpecSlugs = $pro->specialties->pluck('slug')->toArray();

        // ═══════════════════════════════════════════════════════════
        // 1. SCORE SPECIALITES (35%)
        // ═══════════════════════════════════════════════════════════
        if (!empty($criteria['specialty_slugs'])) {
            $wanted = collect($criteria['specialty_slugs']);
            $matches = $wanted->intersect($proSpecSlugs);
            $ratio = $wanted->isEmpty() ? 0 : $matches->count() / $wanted->count();
            $score += self::WEIGHTS['specialties'] * $ratio;
        }

        // ═══════════════════════════════════════════════════════════
        // 2. SCORE CATEGORIE (20%)
        // ═══════════════════════════════════════════════════════════
        if (!empty($criteria['category_slugs'])) {
            $wantedCats = collect($criteria['category_slugs']);
            $proCatSlug = $pro->category?->slug;
            if ($proCatSlug && $wantedCats->contains($proCatSlug)) {
                $score += self::WEIGHTS['category'];
            }
        }

        // ═══════════════════════════════════════════════════════════
        // 3. SCORE LOCALISATION (15%)
        // ═══════════════════════════════════════════════════════════
        if (!empty($criteria['canton'])) {
            $proCanton = $pro->city?->canton?->code;
            if ($proCanton === $criteria['canton']) {
                $score += self::WEIGHTS['location'];
            } elseif ($pro->mode_visio) {
                // Bonus partiel si visio disponible
                $score += self::WEIGHTS['location'] * 0.5;
            }
        } else {
            // Pas de filtre canton = score plein
            $score += self::WEIGHTS['location'];
        }

        // ═══════════════════════════════════════════════════════════
        // 4. SCORE DISPONIBILITE (10%)
        // ═══════════════════════════════════════════════════════════
        if (!empty($criteria['mode'])) {
            $modeMatch = match($criteria['mode']) {
                'visio' => $pro->mode_visio,
                'cabinet' => $pro->mode_cabinet,
                'domicile' => $pro->mode_domicile,
                default => true,
            };
            $score += self::WEIGHTS['availability'] * ($modeMatch ? 1 : 0);
        } else {
            $score += self::WEIGHTS['availability'];
        }

        // ═══════════════════════════════════════════════════════════
        // 5. SCORE NOTE (10%)
        // ═══════════════════════════════════════════════════════════
        if ($pro->reviews_count >= 3 && $pro->rating) {
            $score += self::WEIGHTS['rating'] * min($pro->rating / 5, 1);
        } else {
            // Note neutre si pas assez d'avis
            $score += self::WEIGHTS['rating'] * 0.5;
        }

        // ═══════════════════════════════════════════════════════════
        // 6. SCORE VERIFIE (5%)
        // ═══════════════════════════════════════════════════════════
        if ($pro->is_verified) {
            $score += self::WEIGHTS['verified'];
        }

        // ═══════════════════════════════════════════════════════════
        // 7. SCORE LANGUE (5%)
        // ═══════════════════════════════════════════════════════════
        if (!empty($criteria['language'])) {
            $languages = is_array($pro->languages) ? $pro->languages : json_decode($pro->languages, true) ?? [];
            if (in_array(strtoupper($criteria['language']), array_map('strtoupper', $languages))) {
                $score += self::WEIGHTS['language'];
            }
        } else {
            $score += self::WEIGHTS['language'];
        }

        // ═══════════════════════════════════════════════════════════
        // BONUS : Situation coeur
        // ═══════════════════════════════════════════════════════════
        if (!empty($criteria['situation_slug'])) {
            if (in_array($criteria['situation_slug'], $proSpecSlugs)) {
                $score += self::BONUS_SITUATION_CORE;
            }
        }

        // ═══════════════════════════════════════════════════════════
        // BONUS : Neuro-atypie
        // ═══════════════════════════════════════════════════════════
        if (!empty($criteria['neuro_slugs'])) {
            $neuroWanted = collect($criteria['neuro_slugs']);
            if ($neuroWanted->intersect($proSpecSlugs)->isNotEmpty()) {
                $score += self::BONUS_NEURO;
            }
        }

        // ═══════════════════════════════════════════════════════════
        // MALUS : Profil incomplet
        // ═══════════════════════════════════════════════════════════
        if (empty($pro->bio) || empty($pro->phone) || empty($pro->email)) {
            $score += self::MALUS_INCOMPLETE;
        }

        return max($score, 0);
    }

    /**
     * Details du matching pour l'affichage
     */
    private function getMatchDetails(Professional $pro, array $criteria): array
    {
        $proSpecSlugs = $pro->specialties->pluck('slug')->toArray();
        $matchedSpecs = [];

        if (!empty($criteria['specialty_slugs'])) {
            $matchedSpecs = array_intersect($criteria['specialty_slugs'], $proSpecSlugs);
        }

        return [
            'matched_specialties' => array_values($matchedSpecs),
            'is_core_match' => !empty($criteria['situation_slug']) && in_array($criteria['situation_slug'], $proSpecSlugs),
            'has_neuro_match' => !empty($criteria['neuro_slugs']) && !empty(array_intersect($criteria['neuro_slugs'], $proSpecSlugs)),
        ];
    }

    /**
     * Exemple d'utilisation depuis le questionnaire
     */
    public static function fromQuestionnaire(array $answers): array
    {
        $criteria = [
            'language' => $answers['language'] ?? 'FR',
            'canton' => $answers['canton'] ?? null,
            'mode' => $answers['consultation_mode'] ?? 'either',
            'specialty_slugs' => [],
            'category_slugs' => [],
            'situation_slug' => null,
            'neuro_slugs' => [],
        ];

        // Mapper la situation
        if (!empty($answers['situation'])) {
            $situationMap = [
                'phobie' => 'phobie_scolaire',
                'refus' => 'refus_scolaire',
                'decrochage' => 'decrochage_scolaire',
            ];
            $criteria['situation_slug'] = $situationMap[$answers['situation']] ?? null;
            if ($criteria['situation_slug']) {
                $criteria['specialty_slugs'][] = $criteria['situation_slug'];
            }
        }

        // Mapper les particularites
        if (!empty($answers['particularities'])) {
            $neuroMap = [
                'hpi' => 'bilan_hpi',
                'tdah' => 'bilan_tdah',
                'tsa' => 'bilan_tsa',
                'dys' => 'troubles_dys',
            ];
            foreach ($answers['particularities'] as $p) {
                if (isset($neuroMap[$p])) {
                    $criteria['neuro_slugs'][] = $neuroMap[$p];
                    $criteria['specialty_slugs'][] = $neuroMap[$p];
                }
                // Autres particularites
                if ($p === 'anxiete') $criteria['specialty_slugs'][] = 'anxiete_enfant';
                if ($p === 'harcelement') $criteria['specialty_slugs'][] = 'harcelement_scolaire';
                if ($p === 'hypersensibilite') $criteria['specialty_slugs'][] = 'hypersensibilite';
            }
        }

        return $criteria;
    }

    /**
     * Recherche simple par texte (nom, specialite, ville)
     */
    public function search(string $query, ?int $limit = 20): Collection
    {
        return Professional::query()
            ->where('is_active', true)
            ->where('validation_status', 'approved')
            ->where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%")
                  ->orWhere('bio', 'like', "%{$query}%")
                  ->orWhereHas('specialties', function ($sq) use ($query) {
                      $sq->where('name', 'like', "%{$query}%");
                  })
                  ->orWhereHas('city', function ($cq) use ($query) {
                      $cq->where('name', 'like', "%{$query}%");
                  });
            })
            ->with(['specialties', 'city.canton', 'category'])
            ->limit($limit)
            ->get();
    }
}
