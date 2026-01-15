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
                        'title' => 'Trouvez des thérapeutes disponibles, proches de chez vous et formés au refus scolaire anxieux.',
                        'subtitle' => 'Un annuaire de thérapeutes tops et dispos, qui connaissent vraiment la phobie scolaire, et que l\'équipe Cap Toi M\'aime connaît et recommande.',
                        'button_text' => 'ÊTRE GUIDÉ - Questionnaire personnalisé',
                        'button_url' => '/questionnaire',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                        'background_image' => null,
                    ],
                    'search' => [
                        'title' => 'Recherche rapide',
                        'placeholder' => 'Recherche rapide...',
                        'button_text' => 'Chercher',
                        'show_filters' => true,
                        'show_canton_filter' => true,
                        'show_specialty_filter' => true,
                    ],
                    'sections' => [
                        'professions' => [
                            'title' => 'TYPES DE PROFESSIONNELS',
                            'subtitle' => '',
                            'show_count' => true,
                        ],
                        'specialties' => [
                            'title' => 'SPÉCIALITÉS RECHERCHÉES',
                            'subtitle' => '',
                            'show_icons' => true,
                        ],
                        'featured' => [
                            'title' => 'PROFESSIONNELS MIS EN AVANT',
                            'subtitle' => '',
                            'show' => true,
                        ],
                        'stats' => [
                            'show' => false,
                            'items' => [],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Prêts à trouver le professionnel qui vous convient à vous et à votre enfant ?',
                        'subtitle' => '',
                        'button_text' => 'Commencez maintenant',
                        'button_url' => '/questionnaire',
                        'background_color' => '#7A1F2E',
                    ],
                ],
                'meta' => ['description' => 'Annuaire des professionnels spécialisés dans le refus scolaire anxieux en Suisse romande'],
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
                        'subtitle' => 'Une question sur l\'adhésion, l\'annuaire ou l\'association ? Notre équipe est à votre écoute.',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'form' => [
                        'title' => 'Envoyez-nous un message',
                        'show_form' => true,
                        'fields' => ['name', 'email', 'subject', 'message'],
                        'submit_text' => 'Envoyer le message',
                        'subjects' => [
                            ['value' => 'adhesion', 'label' => 'Question sur l\'adhésion'],
                            ['value' => 'annuaire', 'label' => 'Question sur l\'annuaire'],
                            ['value' => 'professionnel', 'label' => 'Je suis professionnel'],
                            ['value' => 'autre', 'label' => 'Autre'],
                        ],
                    ],
                    'info' => [
                        'title' => 'Nos coordonnées',
                        'email' => 'hello@captoimaime.ch',
                        'phone' => '',
                        'address' => 'Suisse romande',
                        'hours' => 'Délai de réponse : Sous 48h ouvrées',
                    ],
                    'links' => [
                        'title' => 'Liens utiles',
                        'items' => [
                            ['label' => 'Questions fréquentes (FAQ)', 'url' => '/faq', 'icon' => 'question-mark-circle'],
                            ['label' => 'À propos de l\'annuaire', 'url' => '/a-propos', 'icon' => 'information-circle'],
                            ['label' => 'Espace professionnels', 'url' => '/espace-professionnels', 'icon' => 'briefcase'],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Vous êtes professionnel ?',
                        'subtitle' => 'Rejoignez notre annuaire et aidez les familles à vous trouver.',
                        'button_text' => 'Espace professionnels',
                        'button_url' => '/espace-professionnels',
                        'background_color' => '#7A1F2E',
                    ],
                ],
                'meta' => ['description' => 'Contactez l\'association Cap Toi M\'aime'],
                'is_active' => true,
            ],

            // =============================================
            // PAGE FAQ
            // =============================================
            [
                'slug' => 'faq',
                'title' => 'Questions Fréquentes',
                'content' => [
                    'hero' => [
                        'title' => 'Questions Fréquentes',
                        'subtitle' => 'Trouvez des réponses à vos questions sur la phobie scolaire, l\'annuaire et l\'adhésion.',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'badges' => [
                        'title' => '',
                        'items' => [
                            ['icon' => 'question-mark-circle', 'title' => 'Réponses rapides', 'description' => 'Informations essentielles'],
                            ['icon' => 'book-open', 'title' => 'Comprendre le RSA', 'description' => 'Refus scolaire anxieux'],
                            ['icon' => 'chat-bubble-left-right', 'title' => 'Besoin d\'aide ?', 'description' => 'Contactez-nous'],
                        ],
                    ],
                    'faq' => [
                        'title' => 'FAQ',
                        'show_faq' => true,
                        'categories' => [
                            ['key' => 'all', 'label' => 'Toutes'],
                            ['key' => 'general', 'label' => 'Général'],
                            ['key' => 'parents', 'label' => 'Parents'],
                            ['key' => 'professionnels', 'label' => 'Professionnels'],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Vous n\'avez pas trouvé votre réponse ?',
                        'subtitle' => 'Notre équipe est là pour vous aider. N\'hésitez pas à nous contacter.',
                        'button_text' => 'Nous contacter',
                        'button_url' => '/contact',
                        'background_color' => '#FFFFFF',
                    ],
                ],
                'meta' => ['description' => 'Questions fréquentes sur Cap Toi M\'aime et le refus scolaire anxieux'],
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
                        'title' => 'Accompagnez des familles qui ont vraiment besoin de vous',
                        'subtitle' => 'Rejoignez l\'annuaire des professionnels spécialisés dans le refus scolaire anxieux en Suisse romande.',
                        'button_text' => 'Rejoindre gratuitement',
                        'button_url' => '/inscription-professionnel',
                        'background_color' => '#1E8A9B',
                        'text_color' => '#FFFFFF',
                    ],
                    'badges' => [
                        'title' => '',
                        'items' => [
                            ['icon' => 'check', 'title' => '100% Gratuit', 'description' => ''],
                            ['icon' => 'check', 'title' => 'Patients qualifiés', 'description' => ''],
                            ['icon' => 'check', 'title' => 'Badge vérifié', 'description' => ''],
                        ],
                    ],
                    'sections' => [
                        'stats' => [
                            'show' => true,
                            'items' => [
                                ['value' => '0', 'label' => 'Professionnels vérifiés', 'dynamic' => 'pros_count'],
                                ['value' => '0', 'label' => 'Familles membres', 'dynamic' => 'members_count'],
                                ['value' => '7', 'label' => 'Cantons romands'],
                                ['value' => '0%', 'label' => 'Commission'],
                            ],
                        ],
                    ],
                    'features' => [
                        'title' => 'Tout ce dont vous avez besoin',
                        'subtitle' => 'Découvrez les fonctionnalités qui vous aideront à développer votre pratique.',
                        'tabs' => [
                            [
                                'key' => 'profil',
                                'label' => 'Profil vérifié',
                                'title' => 'Un profil qui inspire confiance',
                                'description' => 'Chaque professionnel inscrit est vérifié par notre équipe. Le badge "Vérifié Cap Toi M\'aime" rassure les familles et vous distingue.',
                                'items' => [
                                    'Vérification des diplômes',
                                    'Validation manuelle par notre équipe',
                                    'Badge visible sur votre profil',
                                ],
                            ],
                            [
                                'key' => 'visibilite',
                                'label' => 'Visibilité',
                                'title' => 'Soyez visible auprès des bonnes familles',
                                'description' => 'Notre annuaire est réservé aux membres de l\'association - des familles réellement concernées par le refus scolaire anxieux.',
                                'items' => [
                                    'Audience qualifiée et ciblée',
                                    'Filtres par spécialité et localisation',
                                    'Profil complet et personnalisé',
                                ],
                            ],
                            [
                                'key' => 'matching',
                                'label' => 'Matching intelligent',
                                'title' => 'Les bonnes familles vous trouvent',
                                'description' => 'Notre questionnaire guide intelligent oriente les familles vers les professionnels les plus adaptés à leur situation spécifique.',
                                'items' => [
                                    'Algorithme de correspondance',
                                    'Score de compatibilité',
                                    'Recommandations personnalisées',
                                ],
                            ],
                            [
                                'key' => 'stats',
                                'label' => 'Statistiques',
                                'title' => 'Suivez votre visibilité',
                                'description' => 'Accédez à des statistiques détaillées sur les consultations de votre profil et mesurez votre impact.',
                                'items' => [
                                    'Nombre de vues du profil',
                                    'Demandes de contact',
                                    'Évolution dans le temps',
                                ],
                            ],
                        ],
                    ],
                    'steps' => [
                        'title' => 'Comment ça marche ?',
                        'subtitle' => 'Un processus simple en 4 étapes',
                        'items' => [
                            ['number' => '1', 'title' => 'Inscription', 'description' => 'Remplissez le formulaire en ~10 minutes', 'duration' => '~10 min'],
                            ['number' => '2', 'title' => 'Vérification', 'description' => 'Nous vérifions vos diplômes', 'duration' => '~48h'],
                            ['number' => '3', 'title' => 'Validation', 'description' => 'Votre profil est approuvé', 'duration' => '~48h'],
                            ['number' => '4', 'title' => 'En ligne', 'description' => 'Les familles vous contactent', 'duration' => 'Pour toujours'],
                        ],
                    ],
                    'about' => [
                        'title' => 'Cap Toi M\'aime',
                        'subtitle' => 'L\'association',
                        'content' => '<p>Cap Toi M\'aime accompagne les familles confrontées au refus scolaire anxieux en Suisse romande. Notre mission : briser l\'isolement et faciliter l\'accès aux soins.</p><p>L\'annuaire est né d\'un constat simple : les familles peinent à trouver des professionnels formés et disponibles. En rejoignant notre réseau, vous participez à cette mission d\'intérêt général.</p>',
                        'quote' => 'Ensemble, redonnons le sourire à nos enfants',
                        'quote_author' => 'Marine Chambat, Fondatrice',
                    ],
                    'faq' => [
                        'title' => 'Questions fréquentes',
                        'subtitle' => 'Tout ce que vous devez savoir avant de vous inscrire',
                        'items' => [
                            [
                                'question' => 'L\'inscription est-elle payante ?',
                                'answer' => 'Non, l\'inscription et la présence dans l\'annuaire sont entièrement gratuites. Notre mission est de faciliter l\'accès aux soins, pas de générer des revenus. Aucune commission n\'est prélevée sur les consultations.',
                            ],
                            [
                                'question' => 'Combien de temps prend la validation ?',
                                'answer' => 'Nous validons les profils sous 24 à 48 heures ouvrées. Vous recevrez un email de confirmation dès que votre profil sera approuvé et visible dans l\'annuaire.',
                            ],
                            [
                                'question' => 'Puis-je modifier mon profil après inscription ?',
                                'answer' => 'Oui, vous avez accès à votre espace personnel pour mettre à jour vos informations à tout moment : disponibilité, tarifs, spécialités, coordonnées, etc.',
                            ],
                            [
                                'question' => 'Comment les familles me contactent-elles ?',
                                'answer' => 'Vos coordonnées (téléphone, email, site web) sont affichées sur votre profil. Les familles vous contactent directement, sans intermédiaire. Vous gérez vos rendez-vous comme d\'habitude.',
                            ],
                            [
                                'question' => 'Qui peut voir mon profil ?',
                                'answer' => 'L\'annuaire est réservé aux familles membres de l\'association Cap Toi M\'aime. Cela garantit une audience qualifiée et réellement concernée par le refus scolaire anxieux.',
                            ],
                            [
                                'question' => 'Quels documents dois-je fournir ?',
                                'answer' => 'Pour la validation, nous demandons une copie de vos diplômes et éventuellement vos certifications complémentaires. Ces documents sont uniquement utilisés pour la vérification et ne sont pas publiés.',
                            ],
                        ],
                    ],
                    'cta' => [
                        'title' => 'Prêt à rejoindre notre réseau ?',
                        'subtitle' => 'L\'inscription est gratuite et ne prend que quelques minutes. Rejoignez les professionnels qui font la différence pour les familles en Suisse romande.',
                        'button_text' => 'Créer mon profil gratuitement',
                        'button_url' => '/inscription-professionnel',
                        'note' => 'Aucune carte de crédit requise',
                    ],
                ],
                'meta' => ['description' => 'Professionnels : rejoignez l\'annuaire Cap Toi M\'aime gratuitement'],
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
                                'content' => '<p>Laravel Forge / Hetzner<br>Europe</p>',
                            ],
                            [
                                'title' => 'Contact',
                                'content' => '<p>Email : hello@captoimaime.ch</p>',
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
                                'content' => '<p>Conformément au RGPD et à la LPD suisse, vous disposez des droits suivants :</p><ul><li>Droit d\'accès à vos données</li><li>Droit de rectification</li><li>Droit à l\'effacement</li><li>Droit à la portabilité</li></ul><p>Pour exercer ces droits, contactez-nous à : hello@captoimaime.ch</p>',
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
                        'title' => 'À propos de l\'annuaire',
                        'subtitle' => 'Association suisse d\'accompagnement des familles face au refus scolaire anxieux',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                    'about' => [
                        'title' => 'Notre mission',
                        'content' => '<p>Nous croyons qu\'aucune famille ne devrait se sentir seule face au refus scolaire anxieux.</p><p>Notre mission est de :</p><ul><li>Informer et sensibiliser sur le refus scolaire anxieux</li><li>Accompagner les familles dans leur parcours</li><li>Mettre en relation avec des professionnels spécialisés</li><li>Créer une communauté d\'entraide</li></ul>',
                        'image' => null,
                    ],
                    'info' => [
                        'title' => 'Nous contacter',
                        'email' => 'hello@captoimaime.ch',
                        'phone' => '',
                        'address' => 'Suisse romande',
                        'hours' => '',
                        'website' => 'www.captoimaime.ch',
                    ],
                ],
                'meta' => ['description' => 'Découvrez Cap Toi M\'aime, association suisse d\'accompagnement des familles face au refus scolaire anxieux'],
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
