<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'accueil',
                'title' => 'Accueil',
                'content' => [
                    'hero' => [
                        'title' => 'Trouvez des thérapeutes disponibles, proches de chez vous et formés au refus scolaire anxieux.',
                        'subtitle' => 'Un annuaire de thérapeutes tops et dispos, qui connaissent vraiment la phobie scolaire, et que l\'équipe Cap Toi M\'aime connaît et recommande.',
                        'cta_text' => 'Commencez maintenant',
                        'cta_link' => '/questionnaire',
                    ],
                    'cta_final' => [
                        'title' => 'Prêts à trouver le professionnel qui vous convient à vous et à votre enfant ?',
                        'button_text' => 'Commencez maintenant',
                        'button_link' => '/questionnaire',
                    ],
                ],
                'meta' => [
                    'title' => 'L\'annuaire Cap Toi M\'aime - Thérapeutes refus scolaire anxieux',
                    'description' => 'Trouvez des thérapeutes formés au refus scolaire anxieux en Suisse romande. Annuaire réservé aux membres de l\'association Cap Toi M\'aime.',
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'a-propos',
                'title' => 'À propos',
                'content' => [
                    'hero' => [
                        'title' => 'Pourquoi cet annuaire est né ?',
                    ],
                    'intro' => [
                        'text' => '<p>À force d\'échanger avec des familles, nous avons fait le constat suivant :</p><p>Trouver un professionnel de santé disponible rapidement pour accompagner son enfant peut devenir un véritable parcours du combattant.</p><p>Les délais d\'attente s\'allongent, les listes d\'attente se multiplient, et les parents se retrouvent souvent démunis face à l\'urgence de certaines situations.</p><p>Notre réponse : un annuaire associatif, indépendant et qualifié, pensé pour les parents de jeunes en phobie / refus scolaire anxieux (RSA) en Genève et Suisse romande.</p>',
                    ],
                    'what_it_is' => [
                        'points' => [
                            ['point' => 'Un outil réservé aux membres de Cap Toi M\'aime : un avantage concret de l\'adhésion, au service des familles.'],
                            ['point' => 'Une sélection de professionnels connus de l\'association, qui sont sensibilisés et/ou formés à la thématique du refus scolaire anxieux.'],
                            ['point' => 'Des fiches claires : spécialités, modalités de remboursement (LAMal/LCA/ASCA/RME).'],
                        ],
                    ],
                    'our_plus' => [
                        'points' => [
                            ['point' => 'Un repérage rapide de la disponibilité : code simple déclaré par les professionnels et mis à jour régulièrement (ex. Vert = prend de nouveaux patients / Orange = RDV sous 2–4 semaines / Gris = liste d\'attente).'],
                            ['point' => 'Quand c\'est possible, une présentation vidéo du praticien pour « mettre un visage sur un nom » et comprendre son approche avant de réserver.'],
                        ],
                    ],
                    'why_built' => [
                        'text' => 'Notre but est de réduire l\'errance thérapeutique, rassurer les parents et faciliter un premier pas utile. Nous avons aussi conçu l\'outil pour qu\'il reste léger à maintenir : informations standardisées, auto-déclarées par les pros, et revues périodiquement par l\'association.',
                    ],
                    'disclaimer' => [
                        'text' => 'Cet annuaire est informatif : il ne remplace pas un avis médical et n\'engage pas une garantie de résultat clinique. Chaque famille reste libre de son choix ; l\'association met à disposition des informations fiables et actualisées pour faciliter l\'orientation.',
                    ],
                ],
                'meta' => [
                    'title' => 'À propos - L\'annuaire Cap Toi M\'aime',
                    'description' => 'Découvrez pourquoi l\'annuaire Cap Toi M\'aime a été créé pour aider les familles à trouver des thérapeutes formés au refus scolaire anxieux.',
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact',
                'content' => [
                    'hero' => [
                        'title' => 'Contactez-nous',
                        'subtitle' => 'Une question ? Nous sommes là pour vous aider.',
                    ],
                    'info' => [
                        'note' => 'Nous centralisons toutes les demandes via le formulaire ci-dessous pour vous répondre au plus vite.',
                        'website_url' => 'https://www.captoimaime.ch',
                        'website_text' => 'Visitez le site de l\'association Cap Toi M\'aime',
                    ],
                    'form' => [
                        'success_message' => 'Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.',
                    ],
                ],
                'meta' => [
                    'title' => 'Contact - L\'annuaire Cap Toi M\'aime',
                    'description' => 'Contactez l\'équipe Cap Toi M\'aime pour toute question sur l\'annuaire des thérapeutes.',
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'faq',
                'title' => 'Questions Fréquentes',
                'content' => [
                    'hero' => [
                        'title' => 'Questions Fréquentes',
                    ],
                    'body' => '<p>Retrouvez toutes les réponses à vos questions sur l\'annuaire et l\'adhésion.</p>',
                ],
                'meta' => [
                    'title' => 'FAQ - L\'annuaire Cap Toi M\'aime',
                    'description' => 'Questions fréquentes sur Cap Toi M\'aime et le refus scolaire anxieux.',
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'espace-pro',
                'title' => 'Espace Professionnel',
                'content' => [
                    'hero' => [
                        'title' => 'Espace Professionnel',
                        'subtitle' => 'Rejoignez l\'annuaire Cap Toi M\'aime',
                    ],
                    'main' => [
                        'text' => '<p>Vous êtes professionnel de santé et souhaitez accompagner des familles confrontées au refus scolaire anxieux ?</p><p>Rejoignez notre réseau de professionnels vérifiés et aidez les familles à trouver le soutien dont elles ont besoin.</p>',
                    ],
                    'steps' => [
                        ['title' => 'Inscription', 'description' => 'Remplissez le formulaire en ~10 minutes'],
                        ['title' => 'Vérification', 'description' => 'Nous vérifions vos diplômes sous 48h'],
                        ['title' => 'Publication', 'description' => 'Votre profil est visible aux familles membres'],
                    ],
                ],
                'meta' => [
                    'title' => 'Espace Pro - L\'annuaire Cap Toi M\'aime',
                    'description' => 'Professionnels de santé : rejoignez l\'annuaire Cap Toi M\'aime et aidez les familles face au refus scolaire anxieux.',
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'conditions-utilisation',
                'title' => 'Conditions d\'utilisation',
                'content' => [
                    'body' => '<h2>Conditions générales d\'utilisation</h2><p>Contenu à compléter...</p>',
                ],
                'meta' => [
                    'title' => 'Conditions d\'utilisation - L\'annuaire Cap Toi M\'aime',
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'politique-confidentialite',
                'title' => 'Politique de confidentialité',
                'content' => [
                    'body' => '<h2>Politique de confidentialité</h2><p>Contenu à compléter...</p>',
                ],
                'meta' => [
                    'title' => 'Politique de confidentialité - L\'annuaire Cap Toi M\'aime',
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'charte-ethique',
                'title' => 'Charte éthique',
                'content' => [
                    'body' => '<h2>Charte éthique</h2><p>Contenu à compléter...</p>',
                ],
                'meta' => [
                    'title' => 'Charte éthique - L\'annuaire Cap Toi M\'aime',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}
