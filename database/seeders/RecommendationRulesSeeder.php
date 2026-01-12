<?php

namespace Database\Seeders;

use App\Models\RecommendationRule;
use Illuminate\Database\Seeder;

class RecommendationRulesSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            // HOMEPAGE - New visitors
            [
                'name' => 'Bienvenue nouveau visiteur',
                'trigger_context' => 'homepage_new',
                'conditions' => ['pages_viewed' => ['<=', 1]],
                'recommendation_type' => 'suggestion',
                'recommendation_data' => [
                    'message' => 'Bienvenue sur Cap Toi M\'aime ! Commencez par notre questionnaire pour trouver le professionnel ideal.',
                    'icon' => 'info',
                    'actions' => [
                        ['label' => 'Commencer', 'action' => 'start_questionnaire'],
                        ['label' => 'Voir l\'annuaire', 'action' => 'browse_directory'],
                    ],
                ],
                'priority' => 90,
            ],

            // HOMEPAGE - Returning visitors
            [
                'name' => 'Bienvenue visiteur de retour',
                'trigger_context' => 'homepage_returning',
                'conditions' => ['previous_sessions' => ['>', 0]],
                'recommendation_type' => 'suggestion',
                'recommendation_data' => [
                    'message' => 'Content de vous revoir ! Souhaitez-vous reprendre votre recherche ?',
                    'icon' => 'info',
                    'actions' => [
                        ['label' => 'Voir l\'annuaire', 'action' => 'browse_directory'],
                        ['label' => 'Nouvelle recherche', 'action' => 'dismiss'],
                    ],
                ],
                'priority' => 85,
            ],

            // QUESTIONNAIRE - Step 1 help
            [
                'name' => 'Aide questionnaire etape 1',
                'trigger_context' => 'questionnaire_step_1_hints',
                'conditions' => ['time_on_page' => ['>', 30]],
                'recommendation_type' => 'hint',
                'recommendation_data' => [
                    'message' => 'Pas sur de votre choix ? La phobie scolaire se manifeste par une anxiete intense a l\'idee d\'aller a l\'ecole.',
                    'icon' => 'lightbulb',
                ],
                'priority' => 80,
            ],

            // QUESTIONNAIRE - Step 2 HPI suggestion
            [
                'name' => 'Suggestion HPI apres TDAH',
                'trigger_context' => 'questionnaire_step_2_hints',
                'conditions' => ['selected_particularities' => ['contains', 'tdah']],
                'recommendation_type' => 'hint',
                'recommendation_data' => [
                    'message' => 'Saviez-vous que TDAH et HPI sont souvent associes ? Vous pouvez selectionner les deux si pertinent.',
                    'icon' => 'lightbulb',
                    'actions' => [
                        ['label' => 'Selectionner HPI', 'action' => 'highlight_hpi'],
                    ],
                ],
                'priority' => 70,
            ],

            // SEARCH - No results
            [
                'name' => 'Aucun resultat - Elargir recherche',
                'trigger_context' => 'search_no_results',
                'conditions' => ['results_count' => ['=', 0]],
                'recommendation_type' => 'action',
                'recommendation_data' => [
                    'message' => 'Aucun resultat avec ces criteres. Essayez d\'elargir votre recherche ou d\'activer les consultations en visio.',
                    'icon' => 'info',
                    'actions' => [
                        ['label' => 'Activer visio', 'action' => 'enable_visio'],
                        ['label' => 'Reinitialiser', 'action' => 'clear_filters'],
                    ],
                ],
                'priority' => 95,
            ],

            // SEARCH - Few results
            [
                'name' => 'Peu de resultats - Suggerer questionnaire',
                'trigger_context' => 'search_few_results',
                'conditions' => [
                    'results_count' => ['<', 3],
                    'questionnaire_completed' => ['=', false],
                ],
                'recommendation_type' => 'suggestion',
                'recommendation_data' => [
                    'message' => 'Pour des recommandations plus personnalisees, essayez notre questionnaire guide.',
                    'icon' => 'lightbulb',
                    'actions' => [
                        ['label' => 'Questionnaire', 'action' => 'start_questionnaire'],
                    ],
                ],
                'priority' => 60,
            ],

            // SEARCH PAGE - Default help
            [
                'name' => 'Aide recherche annuaire',
                'trigger_context' => 'search_page',
                'conditions' => ['questionnaire_completed' => ['=', false]],
                'recommendation_type' => 'suggestion',
                'recommendation_data' => [
                    'message' => 'Utilisez les filtres pour affiner votre recherche par canton, specialite ou type de consultation.',
                    'icon' => 'info',
                ],
                'priority' => 40,
            ],

            // PROFESSIONAL DETAIL - Long viewing
            [
                'name' => 'Longue consultation profil - Suggerer contact',
                'trigger_context' => 'professional_detail',
                'conditions' => [
                    'time_on_page' => ['>', 60],
                    'scroll_depth' => ['>', 50],
                ],
                'recommendation_type' => 'action',
                'recommendation_data' => [
                    'message' => 'Ce professionnel semble correspondre a vos besoins. Pret a le contacter ?',
                    'icon' => 'info',
                    'actions' => [
                        ['label' => 'Voir coordonnees', 'action' => 'scroll_to_contact'],
                        ['label' => 'Voir similaires', 'action' => 'show_similar'],
                    ],
                ],
                'priority' => 75,
            ],

            // PROFESSIONAL DETAIL - Quick view hint
            [
                'name' => 'Info profil professionnel',
                'trigger_context' => 'professional_detail_hints',
                'conditions' => ['professionals_viewed' => ['<', 3]],
                'recommendation_type' => 'hint',
                'recommendation_data' => [
                    'message' => 'Consultez les specialites et les approches therapeutiques pour vous assurer que ce professionnel correspond a vos besoins.',
                    'icon' => 'lightbulb',
                ],
                'priority' => 50,
            ],

            // RESULTS PAGE - High match
            [
                'name' => 'Explication score eleve',
                'trigger_context' => 'results_page',
                'conditions' => ['questionnaire_completed' => ['=', true]],
                'recommendation_type' => 'suggestion',
                'recommendation_data' => [
                    'message' => 'Voici les professionnels les mieux adaptes a votre situation selon vos reponses au questionnaire.',
                    'icon' => 'info',
                    'actions' => [
                        ['label' => 'Voir le premier', 'action' => 'view_first_result'],
                    ],
                ],
                'priority' => 70,
            ],

            // GENERAL - Multiple page views without action
            [
                'name' => 'Beaucoup de navigation sans action',
                'trigger_context' => 'general',
                'conditions' => [
                    'pages_viewed' => ['>', 5],
                    'professionals_viewed' => ['=', 0],
                    'questionnaire_completed' => ['=', false],
                ],
                'recommendation_type' => 'suggestion',
                'recommendation_data' => [
                    'message' => 'Vous semblez chercher quelque chose de precis. Notre questionnaire peut vous aider a trouver le bon professionnel.',
                    'icon' => 'lightbulb',
                    'actions' => [
                        ['label' => 'Essayer', 'action' => 'start_questionnaire'],
                    ],
                ],
                'priority' => 55,
            ],

            // FAQ page - Contact suggestion
            [
                'name' => 'FAQ - Suggerer contact',
                'trigger_context' => 'faq_hints',
                'conditions' => ['scroll_depth' => ['>', 70]],
                'recommendation_type' => 'hint',
                'recommendation_data' => [
                    'message' => 'Vous n\'avez pas trouve votre reponse ? N\'hesitez pas a nous contacter directement.',
                    'icon' => 'info',
                    'actions' => [
                        ['label' => 'Nous contacter', 'action' => 'contact'],
                    ],
                ],
                'priority' => 45,
            ],
        ];

        foreach ($rules as $rule) {
            RecommendationRule::updateOrCreate(
                ['name' => $rule['name']],
                $rule
            );
        }

        $this->command->info('Recommendation rules seeded successfully!');
    }
}
