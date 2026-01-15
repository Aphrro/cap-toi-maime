<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            // =============================================
            // PAGE ACCUEIL
            // =============================================
            [
                'slug' => 'accueil',
                'title' => 'Accueil',
                'content' => [
                    'hero' => [
                        'title' => 'Trouvez le bon professionnel pour votre enfant',
                        'subtitle' => 'Cap Toi M\'aime vous accompagne dans la recherche de professionnels spécialisés dans le refus scolaire anxieux en Suisse romande.',
                        'button_text' => 'Commencer le questionnaire',
                        'button_url' => '/questionnaire',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                        'background_image' => null,
                    ],
                    'search' => [
                        'title' => 'Recherche rapide',
                        'placeholder' => 'Rechercher un professionnel...',
                        'show_filters' => true,
                        'show_canton_filter' => true,
                        'show_specialty_filter' => true,
                    ],
                    'sections' => [
                        'professions' => [
                            'title' => 'Nos professionnels',
                            'subtitle' => 'Des experts qualifiés pour accompagner votre enfant',
                            'show_count' => true,
                        ],
                        'specialties' => [
                            'title' => 'Spécialités',
                            'subtitle' => 'Trouvez le spécialiste adapté à votre situation',
                            'show_icons' => true,
                        ],
                        'stats' => [
                            'show' => true,
                            'items' => [
                                ['value' => '50+', 'label' => 'Professionnels vérifiés'],
                                ['value' => '7', 'label' => 'Cantons couverts'],
                                ['value' => '100%', 'label' => 'Gratuit pour les familles'],
                            ],
                        ],
                    ],
                    'features' => [
                        'title' => 'Pourquoi choisir Cap Toi M\'aime ?',
                        'items' => [
                            [
                                'icon' => 'shield-check',
                                'title' => 'Professionnels vérifiés',
                                'description' => 'Chaque professionnel est vérifié par notre équipe avant d\'être référencé.',
                            ],
                            [
                                'icon' => 'heart',
                                'title' => 'Accompagnement humain',
                                'description' => 'Une association créée par des parents, pour des parents.',
                            ],
                            [
                                'icon' => 'currency-dollar',
                                'title' => '100% gratuit',
                                'description' => 'L\'accès à l\'annuaire est entièrement gratuit pour les familles.',
                            ],
                            [
                                'icon' => 'map-pin',
                                'title' => 'Suisse romande',
                                'description' => 'Des professionnels dans tous les cantons romands.',
                            ],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Prêt à trouver le bon professionnel ?',
                        'subtitle' => 'Répondez à quelques questions et découvrez les professionnels adaptés à votre situation.',
                        'button_text' => 'Démarrer le questionnaire',
                        'button_url' => '/questionnaire',
                        'background_color' => '#1E8A9B',
                    ],
                ],
                'meta' => ['description' => 'Annuaire des professionnels spécialisés dans le refus scolaire anxieux en Suisse romande'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE COMMENT CA MARCHE
            // =============================================
            [
                'slug' => 'comment-ca-marche',
                'title' => 'Comment ça marche',
                'content' => [
                    'hero' => [
                        'title' => 'Comment ça marche ?',
                        'subtitle' => 'Trouvez le professionnel idéal en 3 étapes simples',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'steps' => [
                        'title' => 'Un processus simple et efficace',
                        'items' => [
                            [
                                'number' => '1',
                                'title' => 'Répondez au questionnaire',
                                'description' => 'Notre questionnaire guidé vous aide à identifier vos besoins spécifiques : situation de votre enfant, localisation, préférences de consultation.',
                                'icon' => 'clipboard-document-list',
                            ],
                            [
                                'number' => '2',
                                'title' => 'Découvrez les recommandations',
                                'description' => 'En fonction de vos réponses, nous vous proposons une sélection de professionnels adaptés à votre situation, avec un score de compatibilité.',
                                'icon' => 'users',
                            ],
                            [
                                'number' => '3',
                                'title' => 'Prenez contact',
                                'description' => 'Consultez les profils détaillés et contactez directement le professionnel de votre choix.',
                                'icon' => 'phone',
                            ],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Prêt à commencer ?',
                        'subtitle' => 'Le questionnaire ne prend que 2 minutes.',
                        'button_text' => 'Commencer maintenant',
                        'button_url' => '/questionnaire',
                        'background_color' => '#1E8A9B',
                    ],
                ],
                'meta' => ['description' => 'Découvrez comment trouver un professionnel spécialisé dans le refus scolaire anxieux avec Cap Toi M\'aime'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE ASSOCIATION
            // =============================================
            [
                'slug' => 'association',
                'title' => 'L\'association',
                'content' => [
                    'hero' => [
                        'title' => 'L\'association Cap Toi M\'aime',
                        'subtitle' => 'Une association suisse créée par des parents, pour des parents',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'about' => [
                        'title' => 'Notre histoire',
                        'content' => '<p><strong>Cap Toi M\'aime</strong> est une association suisse à but non lucratif, créée par des parents confrontés au refus scolaire anxieux de leurs enfants.</p><p>Face au manque de ressources et à l\'isolement des familles, nous avons décidé de créer un réseau d\'entraide et de partage d\'expériences.</p>',
                        'image' => null,
                    ],
                    'features' => [
                        'title' => 'Nos actions',
                        'items' => [
                            [
                                'icon' => 'users',
                                'title' => 'Groupes de parole',
                                'description' => 'Des rencontres régulières pour les parents',
                            ],
                            [
                                'icon' => 'book-open',
                                'title' => 'Annuaire vérifiés',
                                'description' => 'Des professionnels qualifiés et vérifiés',
                            ],
                            [
                                'icon' => 'calendar',
                                'title' => 'Événements',
                                'description' => 'Conférences et ateliers thématiques',
                            ],
                            [
                                'icon' => 'academic-cap',
                                'title' => 'Sensibilisation',
                                'description' => 'Actions auprès des écoles et institutions',
                            ],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Rejoignez notre communauté',
                        'subtitle' => 'Devenez membre et soutenez notre mission',
                        'button_text' => 'Devenir membre',
                        'button_url' => '/devenir-membre',
                        'background_color' => '#1E8A9B',
                    ],
                ],
                'meta' => ['description' => 'Découvrez l\'association Cap Toi M\'aime, son histoire et ses actions pour accompagner les familles'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE DEVENIR MEMBRE
            // =============================================
            [
                'slug' => 'devenir-membre',
                'title' => 'Devenir membre',
                'content' => [
                    'hero' => [
                        'title' => 'Rejoignez Cap Toi M\'aime',
                        'subtitle' => 'Soutenez notre mission et bénéficiez d\'avantages exclusifs',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'features' => [
                        'title' => 'Avantages membres',
                        'items' => [
                            [
                                'icon' => 'book-open',
                                'title' => 'Accès complet',
                                'description' => 'Accès à l\'annuaire complet des professionnels',
                            ],
                            [
                                'icon' => 'users',
                                'title' => 'Groupes de parole',
                                'description' => 'Participation aux groupes de parole',
                            ],
                            [
                                'icon' => 'ticket',
                                'title' => 'Tarifs réduits',
                                'description' => 'Réductions sur les événements',
                            ],
                            [
                                'icon' => 'envelope',
                                'title' => 'Newsletter',
                                'description' => 'Newsletter mensuelle exclusive',
                            ],
                        ],
                    ],
                    'badges' => [
                        'title' => 'Nos formules',
                        'items' => [
                            [
                                'title' => 'Membre individuel',
                                'price' => 'CHF 50.-',
                                'period' => '/ an',
                                'features' => ['Accès annuaire', 'Groupes de parole', 'Newsletter'],
                                'is_popular' => false,
                            ],
                            [
                                'title' => 'Membre famille',
                                'price' => 'CHF 80.-',
                                'period' => '/ an',
                                'features' => ['Accès annuaire', 'Groupes de parole', 'Newsletter', 'Événements gratuits'],
                                'is_popular' => true,
                            ],
                            [
                                'title' => 'Professionnel',
                                'price' => 'Gratuit',
                                'period' => '',
                                'features' => ['Profil dans l\'annuaire', 'Visibilité', 'Réseau pro'],
                                'is_popular' => false,
                            ],
                        ],
                    ],
                    'form' => [
                        'title' => 'Formulaire d\'adhésion',
                        'show_form' => true,
                        'fields' => ['name', 'email', 'phone', 'membership_type', 'message'],
                        'submit_text' => 'Envoyer ma demande',
                    ],
                ],
                'meta' => ['description' => 'Devenez membre de Cap Toi M\'aime et rejoignez notre communauté'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE ESPACE PROFESSIONNELS
            // =============================================
            [
                'slug' => 'espace-professionnels',
                'title' => 'Espace professionnels',
                'content' => [
                    'hero' => [
                        'title' => 'Espace professionnels',
                        'subtitle' => 'Rejoignez notre annuaire et soyez visible auprès des familles',
                        'background_color' => '#1E8A9B',
                        'text_color' => '#FFFFFF',
                    ],
                    'badges' => [
                        'title' => 'Rejoindre l\'annuaire',
                        'items' => [
                            [
                                'icon' => 'eye',
                                'title' => 'Visibilité',
                                'description' => 'Soyez visible auprès des familles qui cherchent de l\'aide',
                            ],
                            [
                                'icon' => 'currency-dollar',
                                'title' => 'Gratuit',
                                'description' => 'L\'inscription est entièrement gratuite',
                            ],
                            [
                                'icon' => 'shield-check',
                                'title' => 'Qualité',
                                'description' => 'Faites partie d\'un réseau vérifié',
                            ],
                            [
                                'icon' => 'users',
                                'title' => 'Communauté',
                                'description' => 'Échangez avec d\'autres professionnels',
                            ],
                        ],
                    ],
                    'steps' => [
                        'title' => 'Comment s\'inscrire ?',
                        'items' => [
                            [
                                'number' => '1',
                                'title' => 'Remplissez le formulaire',
                                'description' => 'Complétez votre profil professionnel',
                                'icon' => 'document-text',
                            ],
                            [
                                'number' => '2',
                                'title' => 'Vérification',
                                'description' => 'Notre équipe vérifie vos informations sous 48h',
                                'icon' => 'check-circle',
                            ],
                            [
                                'number' => '3',
                                'title' => 'Publication',
                                'description' => 'Votre profil est publié dans l\'annuaire',
                                'icon' => 'globe-alt',
                            ],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Prêt à nous rejoindre ?',
                        'subtitle' => 'L\'inscription ne prend que quelques minutes.',
                        'button_text' => 'S\'inscrire maintenant',
                        'button_url' => '/inscription-professionnel',
                        'background_color' => '#7A1F2E',
                    ],
                ],
                'meta' => ['description' => 'Professionnels : rejoignez l\'annuaire Cap Toi M\'aime gratuitement'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE REFUS SCOLAIRE ANXIEUX
            // =============================================
            [
                'slug' => 'refus-scolaire-anxieux',
                'title' => 'Le refus scolaire anxieux',
                'content' => [
                    'hero' => [
                        'title' => 'Comprendre le refus scolaire anxieux',
                        'subtitle' => 'Ce n\'est ni un caprice, ni de la paresse : c\'est une vraie souffrance.',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'content' => [
                        'sections' => [
                            [
                                'title' => 'Qu\'est-ce que c\'est ?',
                                'content' => '<p>Le refus scolaire anxieux, aussi appelé phobie scolaire, touche environ 1 à 5% des enfants scolarisés.</p><p>Il se caractérise par une incapacité de l\'enfant ou de l\'adolescent à se rendre à l\'école, liée à une anxiété intense. Cette anxiété peut se manifester par :</p><ul><li>Symptômes physiques (maux de ventre, nausées, maux de tête)</li><li>Crises d\'angoisse ou de panique</li><li>Troubles du sommeil</li><li>Isolement social</li></ul>',
                            ],
                            [
                                'title' => 'Les causes possibles',
                                'content' => '<p>Les origines peuvent être multiples :</p><ul><li>Anxiété de séparation</li><li>Harcèlement scolaire</li><li>Troubles de l\'apprentissage (DYS, TDA/H, HPI)</li><li>Phobie sociale</li><li>Événement traumatisant</li><li>Dépression</li></ul>',
                            ],
                            [
                                'title' => 'Comment agir ?',
                                'content' => '<p>La prise en charge doit être <strong>rapide</strong> et <strong>adaptée</strong>. Plus l\'intervention est précoce, meilleures sont les chances de réussite.</p><p>N\'hésitez pas à consulter un professionnel spécialisé.</p>',
                            ],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Besoin d\'aide ?',
                        'subtitle' => 'Trouvez un professionnel spécialisé près de chez vous.',
                        'button_text' => 'Trouver un professionnel',
                        'button_url' => '/questionnaire',
                        'background_color' => '#1E8A9B',
                    ],
                ],
                'meta' => ['description' => 'Tout savoir sur le refus scolaire anxieux (phobie scolaire) : symptômes, causes et solutions'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE RESSOURCES
            // =============================================
            [
                'slug' => 'ressources',
                'title' => 'Ressources',
                'content' => [
                    'hero' => [
                        'title' => 'Ressources utiles',
                        'subtitle' => 'Documents, livres et liens pour mieux comprendre le refus scolaire anxieux',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'content' => [
                        'sections' => [
                            [
                                'title' => 'Livres recommandés',
                                'content' => '<ul><li>"Phobie scolaire : comment aider les enfants et adolescents en mal d\'école" - Marie-France Le Heuzey</li><li>"Mon enfant ne veut plus aller à l\'école" - Marie Gilbert</li><li>"Comprendre et accompagner l\'anxiété scolaire" - Béatrice Copper-Royer</li></ul>',
                            ],
                            [
                                'title' => 'Liens utiles',
                                'content' => '<ul><li><a href="https://phobiescolaire.org" target="_blank">Association Phobie Scolaire France</a></li><li><a href="https://www.projuventute.ch" target="_blank">Pro Juventute Suisse</a></li><li><a href="https://www.santepsy.ch" target="_blank">Santépsy.ch</a></li></ul>',
                            ],
                            [
                                'title' => 'Documents à télécharger',
                                'content' => '<p>Bientôt disponible : guides pratiques, fiches info, modèles de courriers...</p>',
                            ],
                        ],
                    ],
                ],
                'meta' => ['description' => 'Ressources et lectures recommandées sur le refus scolaire anxieux'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE CONTACT
            // =============================================
            [
                'slug' => 'contact',
                'title' => 'Contact',
                'content' => [
                    'hero' => [
                        'title' => 'Contactez-nous',
                        'subtitle' => 'Une question ? Nous sommes là pour vous aider.',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'form' => [
                        'title' => 'Envoyez-nous un message',
                        'show_form' => true,
                        'fields' => ['name', 'email', 'subject', 'message'],
                        'submit_text' => 'Envoyer le message',
                    ],
                    'info' => [
                        'title' => 'Nos coordonnées',
                        'email' => 'contact@captoimaime.ch',
                        'phone' => '',
                        'address' => 'Suisse romande',
                        'hours' => 'Réponse sous 48h',
                    ],
                ],
                'meta' => ['description' => 'Contactez l\'association Cap Toi M\'aime'],
                'is_active' => true,
            ],

            // =============================================
            // PAGES LÉGALES
            // =============================================
            [
                'slug' => 'mentions-legales',
                'title' => 'Mentions légales',
                'content' => [
                    'hero' => [
                        'title' => 'Mentions légales',
                        'subtitle' => '',
                        'background_color' => '#374151',
                        'text_color' => '#FFFFFF',
                    ],
                    'content' => [
                        'sections' => [
                            [
                                'title' => 'Éditeur du site',
                                'content' => '<p><strong>Association Cap Toi M\'aime</strong><br>Suisse</p>',
                            ],
                            [
                                'title' => 'Hébergement',
                                'content' => '<p>Laravel Forge / DigitalOcean<br>Europe</p>',
                            ],
                            [
                                'title' => 'Contact',
                                'content' => '<p>Email : contact@captoimaime.ch</p>',
                            ],
                        ],
                    ],
                ],
                'meta' => ['description' => 'Mentions légales du site Cap Toi M\'aime'],
                'is_active' => true,
            ],

            [
                'slug' => 'politique-confidentialite',
                'title' => 'Politique de confidentialité',
                'content' => [
                    'hero' => [
                        'title' => 'Politique de confidentialité',
                        'subtitle' => 'Protection de vos données personnelles',
                        'background_color' => '#374151',
                        'text_color' => '#FFFFFF',
                    ],
                    'content' => [
                        'sections' => [
                            [
                                'title' => 'Données collectées',
                                'content' => '<p>Nous collectons uniquement les données nécessaires au fonctionnement de nos services :</p><ul><li>Informations de compte (nom, email)</li><li>Données de navigation (cookies techniques)</li><li>Messages envoyés via le formulaire de contact</li></ul>',
                            ],
                            [
                                'title' => 'Utilisation des données',
                                'content' => '<p>Vos données sont utilisées pour :</p><ul><li>Gérer votre compte membre</li><li>Vous mettre en relation avec des professionnels</li><li>Améliorer nos services</li><li>Vous informer des événements de l\'association</li></ul>',
                            ],
                            [
                                'title' => 'Vos droits',
                                'content' => '<p>Conformément au RGPD et à la LPD suisse, vous disposez des droits suivants :</p><ul><li>Droit d\'accès à vos données</li><li>Droit de rectification</li><li>Droit à l\'effacement</li><li>Droit à la portabilité</li></ul><p>Pour exercer ces droits, contactez-nous à : contact@captoimaime.ch</p>',
                            ],
                        ],
                    ],
                ],
                'meta' => ['description' => 'Politique de confidentialité et protection des données de Cap Toi M\'aime'],
                'is_active' => true,
            ],

            [
                'slug' => 'conditions-utilisation',
                'title' => 'Conditions d\'utilisation',
                'content' => [
                    'hero' => [
                        'title' => 'Conditions générales d\'utilisation',
                        'subtitle' => '',
                        'background_color' => '#374151',
                        'text_color' => '#FFFFFF',
                    ],
                    'content' => [
                        'sections' => [
                            [
                                'title' => 'Objet du site',
                                'content' => '<p>Cap Toi M\'aime est une plateforme qui met en relation les familles confrontées au refus scolaire anxieux avec des professionnels spécialisés.</p>',
                            ],
                            [
                                'title' => 'Responsabilité',
                                'content' => '<p>L\'association Cap Toi M\'aime vérifie les informations fournies par les professionnels mais ne peut garantir l\'exhaustivité ou l\'exactitude de toutes les informations. Le choix d\'un professionnel reste de la responsabilité de l\'utilisateur.</p>',
                            ],
                            [
                                'title' => 'Propriété intellectuelle',
                                'content' => '<p>Tous les contenus présents sur ce site (textes, images, logos) sont la propriété de l\'association Cap Toi M\'aime ou de leurs auteurs respectifs et sont protégés par le droit d\'auteur.</p>',
                            ],
                        ],
                    ],
                ],
                'meta' => ['description' => 'Conditions générales d\'utilisation du site Cap Toi M\'aime'],
                'is_active' => true,
            ],

            [
                'slug' => 'a-propos',
                'title' => 'À propos',
                'content' => [
                    'hero' => [
                        'title' => 'À propos de Cap Toi M\'aime',
                        'subtitle' => 'Association suisse d\'accompagnement des familles face au refus scolaire anxieux',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'about' => [
                        'title' => 'Notre mission',
                        'content' => '<p>Nous croyons qu\'aucune famille ne devrait se sentir seule face au refus scolaire anxieux.</p><p>Notre mission est de :</p><ul><li>Informer et sensibiliser sur le refus scolaire anxieux</li><li>Accompagner les familles dans leur parcours</li><li>Mettre en relation avec des professionnels spécialisés</li><li>Créer une communauté d\'entraide</li></ul>',
                        'image' => null,
                    ],
                    'features' => [
                        'title' => 'Ce que nous offrons',
                        'items' => [
                            [
                                'icon' => 'book-open',
                                'title' => 'Annuaire vérifié',
                                'description' => 'Des professionnels qualifiés et vérifiés',
                            ],
                            [
                                'icon' => 'users',
                                'title' => 'Communauté',
                                'description' => 'Groupes de parole et événements',
                            ],
                            [
                                'icon' => 'light-bulb',
                                'title' => 'Ressources',
                                'description' => 'Information et sensibilisation',
                            ],
                        ],
                    ],
                    'info' => [
                        'title' => 'Nous contacter',
                        'email' => 'contact@captoimaime.ch',
                        'phone' => '',
                        'address' => 'Suisse romande',
                        'hours' => '',
                    ],
                ],
                'meta' => ['description' => 'Découvrez Cap Toi M\'aime, association suisse d\'accompagnement des familles face au refus scolaire anxieux'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE FAQ
            // =============================================
            [
                'slug' => 'faq',
                'title' => 'Questions fréquentes',
                'content' => [
                    'hero' => [
                        'title' => 'Questions fréquentes',
                        'subtitle' => 'Trouvez rapidement les réponses à vos questions',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'faq' => [
                        'title' => 'FAQ',
                        'show_faq' => true,
                        'categories' => ['general', 'families', 'professionals'],
                    ],
                    'cta' => [
                        'title' => 'Vous n\'avez pas trouvé votre réponse ?',
                        'subtitle' => 'Contactez-nous directement.',
                        'button_text' => 'Nous contacter',
                        'button_url' => '/contact',
                        'background_color' => '#1E8A9B',
                    ],
                ],
                'meta' => ['description' => 'Questions fréquentes sur Cap Toi M\'aime et le refus scolaire anxieux'],
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
