<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Specialty;
use App\Models\SpecialtySynonym;

class TaxonomySeeder extends Seeder
{
    public function run(): void
    {
        $taxonomy = [
            // ═══════════════════════════════════════════════════════════
            // 1. PSYCHOLOGIE & PSYCHOTHERAPIE
            // ═══════════════════════════════════════════════════════════
            'psychologie' => [
                'name' => 'Psychologie & Psychotherapie',
                'description' => 'Accompagnement psychologique, therapies, gestion des emotions',
                'icon' => 'brain',
                'color' => '#722F37',
                'specialties' => [
                    'phobie_scolaire' => [
                        'name' => 'Phobie scolaire',
                        'description' => 'Refus scolaire anxieux, peur intense de l\'ecole',
                        'synonyms' => ['refus_scolaire_anxieux', 'peur_ecole'],
                    ],
                    'refus_scolaire' => [
                        'name' => 'Refus scolaire',
                        'description' => 'Opposition a l\'ecole, perte de sens',
                        'synonyms' => ['opposition_scolaire'],
                    ],
                    'decrochage_scolaire' => [
                        'name' => 'Decrochage scolaire',
                        'description' => 'Absences repetees, descolarisation progressive',
                        'synonyms' => ['absenteisme', 'descolarisation'],
                    ],
                    'anxiete_enfant' => [
                        'name' => 'Anxiete enfant/adolescent',
                        'description' => 'Troubles anxieux, crises d\'angoisse, anxiete sociale',
                        'synonyms' => ['anxiete', 'angoisse', 'anxiete_sociale'],
                    ],
                    'harcelement_scolaire' => [
                        'name' => 'Harcelement scolaire',
                        'description' => 'Accompagnement des victimes de harcelement',
                        'synonyms' => ['bullying', 'cyberharcelement'],
                    ],
                    'estime_de_soi' => [
                        'name' => 'Estime de soi',
                        'description' => 'Confiance en soi, affirmation de soi',
                        'synonyms' => ['confiance_en_soi', 'affirmation_soi'],
                    ],
                    'regulation_emotionnelle' => [
                        'name' => 'Regulation emotionnelle',
                        'description' => 'Gestion des emotions, intelligence emotionnelle',
                        'synonyms' => ['gestion_emotions', 'emotions'],
                    ],
                    'hypersensibilite' => [
                        'name' => 'Hypersensibilite',
                        'description' => 'Accompagnement des personnes hypersensibles',
                        'synonyms' => ['hsp', 'haute_sensibilite'],
                    ],
                    'burn_out_scolaire' => [
                        'name' => 'Burn-out scolaire',
                        'description' => 'Epuisement lie a la surcharge scolaire',
                        'synonyms' => ['epuisement_scolaire', 'surmenage'],
                    ],
                    'gestion_stress' => [
                        'name' => 'Gestion du stress',
                        'description' => 'Techniques de gestion du stress et de l\'anxiete',
                        'synonyms' => ['stress', 'relaxation'],
                    ],
                    'troubles_du_comportement' => [
                        'name' => 'Troubles du comportement',
                        'description' => 'Opposition, agressivite, difficultes comportementales',
                        'synonyms' => ['comportement', 'opposition'],
                    ],
                    'traumatisme' => [
                        'name' => 'Traumatisme',
                        'description' => 'Accompagnement post-traumatique, EMDR',
                        'synonyms' => ['trauma', 'emdr', 'ptsd'],
                    ],
                    'deuil_separation' => [
                        'name' => 'Deuil & separation',
                        'description' => 'Accompagnement lors de deuil ou separation parentale',
                        'synonyms' => ['deuil', 'divorce', 'separation'],
                    ],
                ],
            ],

            // ═══════════════════════════════════════════════════════════
            // 2. PSYCHIATRIE ENFANT/ADOLESCENT
            // ═══════════════════════════════════════════════════════════
            'psychiatrie' => [
                'name' => 'Psychiatrie enfant/adolescent',
                'description' => 'Diagnostic et suivi medical des troubles psychiatriques',
                'icon' => 'stethoscope',
                'color' => '#4F46E5',
                'specialties' => [
                    'evaluation_psychiatrique' => [
                        'name' => 'Evaluation psychiatrique',
                        'description' => 'Bilan psychiatrique complet',
                    ],
                    'suivi_medicamenteux' => [
                        'name' => 'Suivi medicamenteux',
                        'description' => 'Prescription et suivi de traitements',
                    ],
                    'troubles_anxieux' => [
                        'name' => 'Troubles anxieux',
                        'description' => 'Diagnostic et traitement des troubles anxieux',
                    ],
                    'troubles_depressifs' => [
                        'name' => 'Troubles depressifs',
                        'description' => 'Depression chez l\'enfant et l\'adolescent',
                        'synonyms' => ['depression', 'deprime'],
                    ],
                    'troubles_humeur' => [
                        'name' => 'Troubles de l\'humeur',
                        'description' => 'Bipolarite, dysregulation emotionnelle',
                    ],
                ],
            ],

            // ═══════════════════════════════════════════════════════════
            // 3. NEUROPSYCHOLOGIE & BILANS
            // ═══════════════════════════════════════════════════════════
            'neuropsy' => [
                'name' => 'Neuropsychologie & Bilans',
                'description' => 'Bilans neuropsychologiques, diagnostics HPI/TDAH/TSA/DYS',
                'icon' => 'scan',
                'color' => '#3B82F6',
                'specialties' => [
                    'bilan_neuropsychologique' => [
                        'name' => 'Bilan neuropsychologique',
                        'description' => 'Evaluation complete des fonctions cognitives',
                        'synonyms' => ['bilan_cognitif', 'evaluation_cognitive'],
                    ],
                    'bilan_tdah' => [
                        'name' => 'Bilan TDAH',
                        'description' => 'Diagnostic du trouble de l\'attention',
                        'synonyms' => ['tdah', 'adhd', 'hyperactivite', 'attention'],
                    ],
                    'bilan_tsa' => [
                        'name' => 'Bilan TSA',
                        'description' => 'Diagnostic du trouble du spectre autistique',
                        'synonyms' => ['tsa', 'autisme', 'asperger', 'spectre_autistique'],
                    ],
                    'bilan_hpi' => [
                        'name' => 'Bilan HPI',
                        'description' => 'Diagnostic du haut potentiel intellectuel',
                        'synonyms' => ['hpi', 'surdoue', 'haut_potentiel', 'precoce', 'qi'],
                    ],
                    'troubles_dys' => [
                        'name' => 'Troubles DYS',
                        'description' => 'Dyslexie, dysorthographie, dyscalculie, dyspraxie',
                        'synonyms' => ['dys', 'dyslexie', 'dysorthographie', 'dyscalculie', 'dyspraxie', 'dysgraphie'],
                    ],
                    'bilan_memoire' => [
                        'name' => 'Bilan memoire',
                        'description' => 'Evaluation des capacites mnesiques',
                        'synonyms' => ['memoire', 'troubles_memoire'],
                    ],
                    'fonctions_executives' => [
                        'name' => 'Fonctions executives',
                        'description' => 'Planification, organisation, flexibilite mentale',
                        'synonyms' => ['fonctions_cognitives', 'planification'],
                    ],
                ],
            ],

            // ═══════════════════════════════════════════════════════════
            // 4. SOUTIEN SCOLAIRE & ORIENTATION
            // ═══════════════════════════════════════════════════════════
            'scolaire' => [
                'name' => 'Soutien scolaire & Orientation',
                'description' => 'Coaching, methodologie, orientation, retour a l\'ecole',
                'icon' => 'graduation-cap',
                'color' => '#10B981',
                'specialties' => [
                    'coaching_scolaire' => [
                        'name' => 'Coaching scolaire',
                        'description' => 'Accompagnement personnalise vers la reussite',
                        'synonyms' => ['coach', 'accompagnement_scolaire'],
                    ],
                    'motivation' => [
                        'name' => 'Motivation scolaire',
                        'description' => 'Remotivation, sens de l\'ecole',
                        'synonyms' => ['remotivation', 'sens_ecole'],
                    ],
                    'organisation' => [
                        'name' => 'Organisation & methode',
                        'description' => 'Methodologie de travail, gestion du temps',
                        'synonyms' => ['methode_travail', 'gestion_temps', 'organisation_scolaire'],
                    ],
                    'orientation_scolaire' => [
                        'name' => 'Orientation scolaire',
                        'description' => 'Aide au choix d\'orientation, projet professionnel',
                        'synonyms' => ['orientation', 'projet_professionnel'],
                    ],
                    'reintegration_scolaire' => [
                        'name' => 'Reintegration scolaire',
                        'description' => 'Accompagnement au retour progressif a l\'ecole',
                        'synonyms' => ['retour_ecole', 'rescolarisation'],
                    ],
                    'coordination_ecole_famille' => [
                        'name' => 'Coordination ecole-famille',
                        'description' => 'Liaison entre la famille et l\'etablissement',
                        'synonyms' => ['liaison_ecole', 'mediation_scolaire'],
                    ],
                ],
            ],

            // ═══════════════════════════════════════════════════════════
            // 5. THERAPIES FAMILIALES & PARENTALITE
            // ═══════════════════════════════════════════════════════════
            'famille' => [
                'name' => 'Therapies familiales & Parentalite',
                'description' => 'Accompagnement de la famille, mediation, guidance parentale',
                'icon' => 'users',
                'color' => '#F59E0B',
                'specialties' => [
                    'therapie_familiale' => [
                        'name' => 'Therapie familiale',
                        'description' => 'Accompagnement de la famille dans son ensemble',
                        'synonyms' => ['famille', 'systeme_familial'],
                    ],
                    'therapie_systemique' => [
                        'name' => 'Therapie systemique',
                        'description' => 'Approche systemique des relations familiales',
                        'synonyms' => ['systemique'],
                    ],
                    'mediation_familiale' => [
                        'name' => 'Mediation familiale',
                        'description' => 'Resolution de conflits familiaux',
                        'synonyms' => ['mediation', 'conflits_familiaux'],
                    ],
                    'guidance_parentale' => [
                        'name' => 'Guidance parentale',
                        'description' => 'Accompagnement des parents, education positive',
                        'synonyms' => ['coaching_parental', 'aide_parents'],
                    ],
                    'communication_familiale' => [
                        'name' => 'Communication familiale',
                        'description' => 'Ameliorer la communication parent-enfant',
                        'synonyms' => ['communication', 'dialogue'],
                    ],
                ],
            ],

            // ═══════════════════════════════════════════════════════════
            // 6. PARAMEDICAL & DEVELOPPEMENT
            // ═══════════════════════════════════════════════════════════
            'paramedical' => [
                'name' => 'Paramedical & Developpement',
                'description' => 'Orthophonie, ergotherapie, psychomotricite',
                'icon' => 'hand',
                'color' => '#EC4899',
                'specialties' => [
                    'orthophonie' => [
                        'name' => 'Orthophonie / Logopedie',
                        'description' => 'Troubles du langage, communication',
                        'synonyms' => ['logopediste', 'langage', 'parole'],
                    ],
                    'ergotherapie' => [
                        'name' => 'Ergotherapie',
                        'description' => 'Autonomie fonctionnelle, adaptation',
                        'synonyms' => ['ergotherapeute', 'autonomie'],
                    ],
                    'psychomotricite' => [
                        'name' => 'Psychomotricite',
                        'description' => 'Developpement psychomoteur, coordination',
                        'synonyms' => ['psychomotricien', 'motricite'],
                    ],
                    'integration_sensorielle' => [
                        'name' => 'Integration sensorielle',
                        'description' => 'Troubles sensoriels, hypersensibilite sensorielle',
                        'synonyms' => ['sensoriel', 'sensorialite'],
                    ],
                ],
            ],

            // ═══════════════════════════════════════════════════════════
            // 7. MEDECINE & COORDINATION
            // ═══════════════════════════════════════════════════════════
            'medical' => [
                'name' => 'Medecine & Coordination',
                'description' => 'Pediatrie, coordination des soins',
                'icon' => 'heart-pulse',
                'color' => '#EF4444',
                'specialties' => [
                    'pediatrie_developpement' => [
                        'name' => 'Pediatrie du developpement',
                        'description' => 'Suivi medical specialise du developpement',
                        'synonyms' => ['pediatre', 'medecin_enfant'],
                    ],
                    'coordination_soins' => [
                        'name' => 'Coordination des soins',
                        'description' => 'Orchestration du parcours de soins',
                        'synonyms' => ['parcours_soins', 'coordination'],
                    ],
                ],
            ],

            // ═══════════════════════════════════════════════════════════
            // 8. APPROCHES COMPLEMENTAIRES
            // ═══════════════════════════════════════════════════════════
            'complementaire' => [
                'name' => 'Approches complementaires',
                'description' => 'Sophrologie, hypnose, art-therapie, relaxation',
                'icon' => 'sparkles',
                'color' => '#8B5CF6',
                'specialties' => [
                    'sophrologie' => [
                        'name' => 'Sophrologie',
                        'description' => 'Relaxation, gestion du stress par la sophrologie',
                        'synonyms' => ['sophrologue', 'relaxation_sophrologie'],
                    ],
                    'hypnose' => [
                        'name' => 'Hypnose therapeutique',
                        'description' => 'Hypnose pour enfants et adolescents',
                        'synonyms' => ['hypnotherapie', 'hypnotherapeute'],
                    ],
                    'art_therapie' => [
                        'name' => 'Art-therapie',
                        'description' => 'Expression creative, liberation emotionnelle',
                        'synonyms' => ['art_therapeute', 'therapie_art'],
                    ],
                    'musicotherapie' => [
                        'name' => 'Musicotherapie',
                        'description' => 'Therapie par la musique',
                        'synonyms' => ['musique_therapie'],
                    ],
                    'relaxation' => [
                        'name' => 'Relaxation & respiration',
                        'description' => 'Techniques de relaxation, coherence cardiaque',
                        'synonyms' => ['coherence_cardiaque', 'respiration'],
                    ],
                ],
            ],

            // ═══════════════════════════════════════════════════════════
            // 9. SOCIAL & EDUCATIF
            // ═══════════════════════════════════════════════════════════
            'social' => [
                'name' => 'Social & Educatif',
                'description' => 'Educateurs specialises, accompagnement social',
                'icon' => 'shield',
                'color' => '#6B7280',
                'specialties' => [
                    'educateur_specialise' => [
                        'name' => 'Educateur specialise',
                        'description' => 'Accompagnement educatif specialise',
                        'synonyms' => ['educateur', 'education_specialisee'],
                    ],
                    'accompagnement_tsa' => [
                        'name' => 'Accompagnement TSA',
                        'description' => 'Accompagnement specifique pour l\'autisme',
                        'synonyms' => ['aide_tsa', 'soutien_autisme'],
                    ],
                    'accompagnement_tdah' => [
                        'name' => 'Accompagnement TDAH',
                        'description' => 'Accompagnement specifique pour le TDAH',
                        'synonyms' => ['aide_tdah', 'soutien_tdah'],
                    ],
                    'aide_sociale' => [
                        'name' => 'Aide sociale',
                        'description' => 'Accompagnement social des familles',
                        'synonyms' => ['assistant_social', 'travailleur_social'],
                    ],
                ],
            ],
        ];

        // Insertion des donnees
        $categoryOrder = 1;
        foreach ($taxonomy as $categorySlug => $categoryData) {
            $category = Category::updateOrCreate(
                ['slug' => $categorySlug],
                [
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'icon' => $categoryData['icon'],
                    'color' => $categoryData['color'],
                    'order' => $categoryOrder++,
                    'is_active' => true,
                ]
            );

            $specialtyOrder = 1;
            foreach ($categoryData['specialties'] as $specialtySlug => $specialtyData) {
                $specialty = Specialty::updateOrCreate(
                    ['slug' => $specialtySlug],
                    [
                        'category_id' => $category->id,
                        'name' => $specialtyData['name'],
                        'description' => $specialtyData['description'] ?? null,
                        'sort_order' => $specialtyOrder++,
                        'is_active' => true,
                    ]
                );

                // Ajouter les synonymes
                if (!empty($specialtyData['synonyms'])) {
                    foreach ($specialtyData['synonyms'] as $synonym) {
                        SpecialtySynonym::updateOrCreate(
                            ['synonym' => $synonym],
                            ['specialty_id' => $specialty->id]
                        );
                    }
                }
            }
        }

        $this->command->info('Taxonomie importee : ' . Category::count() . ' categories, ' . Specialty::count() . ' specialites');
    }
}
