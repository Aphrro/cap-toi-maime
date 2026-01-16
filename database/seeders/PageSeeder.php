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
            // PAGE ACCUEIL - 5 sections
            // =============================================
            [
                'slug' => 'accueil',
                'title' => 'Accueil',
                'content' => [
                    // === SECTION 1 : HERO ===
                    'hero' => [
                        'title' => 'Pourquoi cet annuaire ?',
                        'paragraph' => "A force d'echanger avec des familles, nous avons fait un constat : trouver un professionnel disponible rapidement peut devenir un veritable parcours du combattant.",
                        'button_text' => 'CONSULTER L\'ANNUAIRE',
                        'button_url' => '/annuaire',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                        'background_image' => null,
                        'highlights' => [
                            [
                                'icon' => 'heroicon-o-users',
                                'title' => 'Reserve aux membres',
                                'description' => 'Avantage de l\'adhesion',
                            ],
                            [
                                'icon' => 'heroicon-o-shield-check',
                                'title' => 'Professionnels verifies',
                                'description' => 'Formes au RSA',
                            ],
                            [
                                'icon' => 'heroicon-o-clock',
                                'title' => 'Disponibilite en temps reel',
                                'description' => 'Mise a jour reguliere',
                            ],
                        ],
                    ],

                    // === SECTION 2 : NOTRE REPONSE ===
                    'reponse' => [
                        'show' => true,
                        'title' => 'Notre reponse',
                        'paragraph' => "Un annuaire associatif, independant et qualifie, pense pour les parents de jeunes en phobie / refus scolaire anxieux (RSA) en Suisse romande.",
                        'background_color' => '#FFFFFF',
                        'cards' => [
                            [
                                'icon' => 'heroicon-o-check',
                                'title' => 'Reserve aux membres',
                                'description' => "Un outil reserve aux membres de Cap Toi M'aime : un avantage concret de l'adhesion, au service des familles.",
                            ],
                            [
                                'icon' => 'heroicon-o-shield-check',
                                'title' => 'Professionnels selectionnes',
                                'description' => "Une selection de professionnels connus de l'association, sensibilises et/ou formes a la thematique du refus scolaire anxieux.",
                            ],
                            [
                                'icon' => 'heroicon-o-document-text',
                                'title' => 'Fiches claires',
                                'description' => "Des fiches detaillees : specialites, modalites de remboursement (LAMal/LCA/ASCA/RME), disponibilite en temps reel.",
                            ],
                        ],
                    ],

                    // === SECTION 3 : NOTRE PLUS ===
                    'plus' => [
                        'show' => true,
                        'title' => 'Notre "plus" pour vous faire gagner du temps',
                        'background_color' => '#F9FAFB',
                        'features' => [
                            [
                                'icon' => 'heroicon-o-clock',
                                'title' => 'Reperage rapide de la disponibilite',
                                'description' => "Code simple declare par les professionnels et mis a jour regulierement.",
                                'show_availability_badges' => true,
                            ],
                            [
                                'icon' => 'heroicon-o-video-camera',
                                'title' => 'Presentation video',
                                'description' => "Quand c'est possible, une presentation video du praticien pour \"mettre un visage sur un nom\" et comprendre son approche avant de reserver.",
                                'show_availability_badges' => false,
                            ],
                        ],
                    ],

                    // === SECTION 4 : POURQUOI ===
                    'pourquoi' => [
                        'show' => true,
                        'title' => 'Pourquoi nous l\'avons construit ainsi ?',
                        'paragraph' => "Notre but est de reduire l'errance therapeutique, rassurer les parents et faciliter un premier pas utile.",
                        'background_color' => '#FFFFFF',
                        'alert' => [
                            'show' => true,
                            'icon' => 'heroicon-o-exclamation-triangle',
                            'title' => 'Limites et rappel important',
                            'text' => "Cet annuaire est informatif : il ne remplace pas un avis medical et n'engage pas une garantie de resultat clinique. Chaque famille reste libre de son choix ; l'association met a disposition des informations fiables et actualisees pour faciliter l'orientation.",
                            'background_color' => '#FEF3C7',
                        ],
                    ],

                    // === SECTION 5 : CTA FINAL ===
                    'cta' => [
                        'show' => true,
                        'title' => 'Pret a trouver le bon professionnel ?',
                        'subtitle' => 'Consultez notre annuaire de professionnels specialises.',
                        'button_text' => 'CONSULTER L\'ANNUAIRE',
                        'button_url' => '/annuaire',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],
                ],
                'meta' => [
                    'title' => 'Cap Toi M\'aime - Annuaire de professionnels specialises RSA',
                    'description' => 'Trouvez des professionnels formes au refus scolaire anxieux en Suisse romande.',
                    'keywords' => 'phobie scolaire, refus scolaire, therapeute, psychologue, suisse',
                ],
                'is_active' => true,
            ],

            // =============================================
            // PAGE ESPACE PROFESSIONNELS
            // =============================================
            [
                'slug' => 'espace-professionnels',
                'title' => 'Espace professionnels',
                'content' => [
                    // Hero
                    'hero' => [
                        'title' => 'Accompagnez des familles qui ont vraiment besoin de vous',
                        'subtitle' => 'Rejoignez l\'annuaire des professionnels specialises dans le refus scolaire anxieux en Suisse romande.',
                        'button_text' => 'Rejoindre gratuitement',
                        'button_url' => '/register',
                        'button_color' => '#7A1F2E',
                        'background_color' => '#1E8A9B',
                        'background_color_end' => '#156d7a',
                        'text_color' => '#FFFFFF',
                        'image' => null,
                        // Mockup fiche pro
                        'mockup_initials' => 'MD',
                        'mockup_name' => 'Dr. Marie Dupont',
                        'mockup_profession' => 'Psychologue',
                        'mockup_availability' => 'Disponible',
                        'mockup_location' => 'Geneve',
                        'mockup_badge_text' => 'Verifie',
                        'mockup_tags' => ['Phobie scolaire', 'Anxiete', 'TDA/H'],
                        'mockup_insurances' => ['LAMal', 'ASCA'],
                        'mockup_visio_text' => 'Visio',
                    ],
                    // Badges
                    'badges_section' => [
                        'show' => true,
                        'items' => [
                            ['icon' => 'check', 'text' => '100% Gratuit'],
                            ['icon' => 'users', 'text' => 'Patients qualifies'],
                            ['icon' => 'shield-check', 'text' => 'Badge verifie'],
                        ],
                    ],
                    // Stats
                    'stats_section' => [
                        'show' => true,
                        'title' => '',
                        'background_color' => '#FFFFFF',
                        'items' => [
                            ['value' => 'dynamic:pros_count', 'label' => 'Professionnels verifies', 'is_dynamic' => true, 'color' => '#7A1F2E'],
                            ['value' => 'dynamic:members_count', 'label' => 'Familles membres', 'is_dynamic' => true, 'color' => '#1E8A9B'],
                            ['value' => '7', 'label' => 'Cantons romands', 'is_dynamic' => false, 'color' => '#7A1F2E'],
                            ['value' => '0%', 'label' => 'Commission', 'is_dynamic' => false, 'color' => '#22c55e'],
                        ],
                    ],
                    // Features/Avantages avec Tabs
                    'features_section' => [
                        'show' => true,
                        'title' => 'Tout ce dont vous avez besoin',
                        'subtitle' => 'Decouvrez les fonctionnalites qui vous aideront a developper votre pratique.',
                        'background_color' => '#F9FAFB',
                        'tabs' => [
                            [
                                'id' => 'profil',
                                'label' => 'Profil verifie',
                                'badge_text' => 'Badge de confiance',
                                'badge_color' => '#7A1F2E',
                                'title' => 'Un profil qui inspire confiance',
                                'description' => 'Chaque professionnel inscrit est verifie par notre equipe. Le badge "Verifie Cap Toi M\'aime" rassure les familles et vous distingue.',
                                'features' => ['Verification des diplomes', 'Validation manuelle par notre equipe', 'Badge visible sur votre profil'],
                                'visual_title' => 'Verifie Cap Toi M\'aime',
                                'visual_subtitle' => 'Professionnel de confiance',
                            ],
                            [
                                'id' => 'visibilite',
                                'label' => 'Visibilite',
                                'badge_text' => 'Visibilite optimale',
                                'badge_color' => '#1E8A9B',
                                'title' => 'Soyez visible aupres des bonnes familles',
                                'description' => 'Notre annuaire est reserve aux membres de l\'association - des familles reellement concernees par le refus scolaire anxieux.',
                                'features' => ['Audience qualifiee et ciblee', 'Filtres par specialite et localisation', 'Profil complet et personnalise'],
                                'visual_title' => 'Recherche par specialite',
                                'visual_tags' => ['Phobie scolaire', 'Anxiete', 'TDA/H', 'HPI'],
                            ],
                            [
                                'id' => 'matching',
                                'label' => 'Matching intelligent',
                                'badge_text' => 'Matching intelligent',
                                'badge_color' => '#7c3aed',
                                'title' => 'Les bonnes familles vous trouvent',
                                'description' => 'Notre questionnaire guide intelligent oriente les familles vers les professionnels les plus adaptes a leur situation specifique.',
                                'features' => ['Algorithme de correspondance', 'Score de compatibilite', 'Recommandations personnalisees'],
                                'visual_score' => '92%',
                                'visual_score_label' => 'Score de correspondance',
                                'visual_bars' => [
                                    ['label' => 'Specialite', 'width' => '100%'],
                                    ['label' => 'Localisation', 'width' => '83%'],
                                    ['label' => 'Disponibilite', 'width' => '100%'],
                                ],
                            ],
                            [
                                'id' => 'stats',
                                'label' => 'Statistiques',
                                'badge_text' => 'Tableau de bord',
                                'badge_color' => '#ea580c',
                                'title' => 'Suivez votre visibilite',
                                'description' => 'Accedez a des statistiques detaillees sur les consultations de votre profil et mesurez votre impact.',
                                'features' => ['Nombre de vues du profil', 'Demandes de contact', 'Evolution dans le temps'],
                                'visual_views' => '156',
                                'visual_views_label' => 'Vues ce mois',
                                'visual_contacts' => '12',
                                'visual_contacts_label' => 'Contacts',
                                'visual_growth' => '+24%',
                                'visual_growth_label' => 'vs mois precedent',
                            ],
                        ],
                    ],
                    // Etapes
                    'steps_section' => [
                        'show' => true,
                        'title' => 'Comment ca marche ?',
                        'subtitle' => 'Un processus simple en 4 etapes',
                        'background_color' => '#FFFFFF',
                        'items' => [
                            ['number' => '1', 'title' => 'Inscription', 'description' => 'Remplissez le formulaire en ~10 minutes', 'duration' => '~10 min', 'color' => '#7A1F2E'],
                            ['number' => '2', 'title' => 'Verification', 'description' => 'Nous verifions vos diplomes', 'duration' => '~48h', 'color' => '#7A1F2E'],
                            ['number' => '3', 'title' => 'Validation', 'description' => 'Votre profil est approuve', 'duration' => '~48h', 'color' => '#7A1F2E'],
                            ['number' => '4', 'title' => 'En ligne', 'description' => 'Les familles vous contactent', 'duration' => 'Pour toujours', 'is_final' => true],
                        ],
                    ],
                    // Preview section (apercu fiche pro)
                    'preview_section' => [
                        'show' => true,
                        'title' => 'Apercu de votre fiche professionnelle',
                        'subtitle' => 'Survolez les elements pour decouvrir les fonctionnalites',
                        'background_color' => '#F9FAFB',
                        'demo_initials' => 'MD',
                        'demo_name' => 'Dr. Marie Dupont',
                        'demo_profession' => 'Psychologue specialisee',
                        'demo_availability' => 'Disponible',
                        'demo_location' => 'Geneve',
                        'demo_visio' => 'Visio disponible',
                        'demo_specialties' => ['Phobie scolaire', 'Refus scolaire anxieux', 'Anxiete', 'TDA/H'],
                        'demo_insurances' => ['LAMal', 'ASCA', 'RME'],
                        'badge_text' => 'Verifie',
                        'specialties_label' => 'Specialites',
                        'insurance_label' => 'Remboursements',
                        'contact_button_text' => 'Contacter ce professionnel',
                        'tooltip_photo' => 'Photo professionnelle pour humaniser votre profil',
                        'tooltip_badge' => 'Badge de confiance attribue apres verification de vos diplomes',
                        'tooltip_availability' => 'Indiquez votre disponibilite en temps reel',
                        'tooltip_specialties' => 'Vos domaines d\'expertise mis en avant',
                        'tooltip_insurance' => 'Information importante pour les familles',
                        'tooltip_contact' => 'Les familles peuvent vous contacter directement',
                    ],
                    // Speed Dating
                    'speed_dating_section' => [
                        'show' => true,
                        'title' => 'Speed Dating Therapeutes-Familles',
                        'description' => 'Participez a nos evenements de mise en relation directe avec les familles. Un format unique pour vous presenter et creer des liens de confiance.',
                        'badge_text' => 'Evenements exclusifs',
                        'background_color' => '#156d7a',
                        'features' => [
                            'Rencontres en visio de 15 minutes',
                            'Plusieurs familles rencontrees en une soiree',
                            'Gratuit pour les professionnels inscrits',
                        ],
                        'button_text' => 'Participer aux prochains evenements',
                        'button_url' => '/register',
                        'next_event_label' => 'Prochain evenement',
                        'next_event_title' => 'Speed Dating #12',
                        'next_event_date' => 'Jeudi 30 janvier 2026',
                        'next_event_time' => '18h30 - 20h30',
                        'next_event_participants' => '15 familles inscrites',
                        'next_event_places' => 'Places limitees',
                    ],
                    // About
                    'about_section' => [
                        'show' => true,
                        'title' => 'Cap Toi M\'aime',
                        'subtitle' => 'L\'association',
                        'content' => '<p>Cap Toi M\'aime accompagne les familles confrontees au refus scolaire anxieux en Suisse romande. Notre mission : briser l\'isolement et faciliter l\'acces aux soins.</p><p>L\'annuaire est ne d\'un constat simple : les familles peinent a trouver des professionnels formes et disponibles. En rejoignant notre reseau, vous participez a cette mission d\'interet general.</p>',
                        'background_color' => '#FFFFFF',
                        'image' => null,
                        'quote' => 'Ensemble, redonnons le sourire a nos enfants',
                        'quote_author' => 'Marine Chambat, Fondatrice',
                        'link_text' => 'Decouvrir l\'association',
                        'link_url' => 'https://www.captoimaime.ch',
                    ],
                    // FAQ
                    'faq_section' => [
                        'show' => true,
                        'title' => 'Questions frequentes',
                        'subtitle' => 'Tout ce que vous devez savoir avant de vous inscrire',
                        'background_color' => '#F9FAFB',
                        'custom_items' => [
                            [
                                'question' => 'L\'inscription est-elle payante ?',
                                'answer' => 'Non, l\'inscription et la presence dans l\'annuaire sont <strong>entierement gratuites</strong>. Notre mission est de faciliter l\'acces aux soins, pas de generer des revenus. Aucune commission n\'est prelevee sur les consultations.',
                            ],
                            [
                                'question' => 'Combien de temps prend la validation ?',
                                'answer' => 'Nous validons les profils sous <strong>24 a 48 heures ouvrees</strong>. Vous recevrez un email de confirmation des que votre profil sera approuve et visible dans l\'annuaire.',
                            ],
                            [
                                'question' => 'Puis-je modifier mon profil apres inscription ?',
                                'answer' => 'Oui, vous avez acces a votre espace personnel pour <strong>mettre a jour vos informations a tout moment</strong> : disponibilite, tarifs, specialites, coordonnees, etc.',
                            ],
                            [
                                'question' => 'Comment les familles me contactent-elles ?',
                                'answer' => 'Vos coordonnees (telephone, email, site web) sont affichees sur votre profil. <strong>Les familles vous contactent directement</strong>, sans intermediaire. Vous gerez vos rendez-vous comme d\'habitude.',
                            ],
                            [
                                'question' => 'Qui peut voir mon profil ?',
                                'answer' => 'L\'annuaire est reserve aux <strong>familles membres de l\'association Cap Toi M\'aime</strong>. Cela garantit une audience qualifiee et reellement concernee par le refus scolaire anxieux.',
                            ],
                            [
                                'question' => 'Quels documents dois-je fournir ?',
                                'answer' => 'Pour la validation, nous demandons une <strong>copie de vos diplomes</strong> et eventuellement vos certifications complementaires. Ces documents sont uniquement utilises pour la verification et ne sont pas publies.',
                            ],
                        ],
                    ],
                    // CTA
                    'cta_section' => [
                        'show' => true,
                        'title' => 'Pret a rejoindre notre reseau ?',
                        'subtitle' => 'L\'inscription est gratuite et ne prend que quelques minutes. Rejoignez les professionnels qui font la difference pour les familles en Suisse romande.',
                        'button_text' => 'Creer mon profil gratuitement',
                        'button_url' => '/register',
                        'gradient_start' => '#7A1F2E',
                        'gradient_end' => '#1E8A9B',
                        'footer_text' => 'Aucune carte de credit requise',
                    ],
                ],
                'meta' => [
                    'title' => 'Espace Professionnels - Cap Toi M\'aime',
                    'description' => 'Professionnels : rejoignez l\'annuaire Cap Toi M\'aime gratuitement et aidez les familles.',
                ],
                'is_active' => true,
            ],

            // =============================================
            // PAGE CONTACT - 3 sections (selon PageResource)
            // =============================================
            [
                'slug' => 'contact',
                'title' => 'Contact',
                'content' => [
                    // === SECTION 1 : HERO ===
                    'hero' => [
                        'title' => 'Contactez-nous',
                        'subtitle' => 'Une question sur l\'adhesion, l\'annuaire ou l\'association ? Notre equipe est a votre ecoute.',
                    ],

                    // === SECTION 2 : FORMULAIRE ===
                    'form' => [
                        'title' => 'Envoyez-nous un message',
                        'button_text' => 'Envoyer le message',
                        'success_message' => 'Merci pour votre message. Nous vous repondrons dans les plus brefs delais.',
                        'name_label' => 'Votre nom',
                        'email_label' => 'Votre email',
                        'subject_label' => 'Sujet',
                        'message_label' => 'Votre message',
                        'subjects' => [
                            ['value' => 'adhesion', 'label' => 'Question sur l\'adhesion'],
                            ['value' => 'annuaire', 'label' => 'Question sur l\'annuaire'],
                            ['value' => 'professionnel', 'label' => 'Je suis professionnel'],
                            ['value' => 'autre', 'label' => 'Autre'],
                        ],
                    ],

                    // === SECTION 3 : INFOS CONTACT ===
                    'info' => [
                        'title' => 'Autres moyens de nous contacter',
                        'email' => 'hello@captoimaime.ch',
                        'phone' => '',
                        'address' => 'Suisse romande',
                        'hours' => 'Reponse sous 48h',
                    ],
                ],
                'meta' => [
                    'title' => 'Contact - Cap Toi M\'aime',
                    'description' => 'Contactez l\'association Cap Toi M\'aime pour toute question.',
                ],
                'is_active' => true,
            ],

            // =============================================
            // PAGE FAQ - 3 sections (selon PageResource)
            // =============================================
            [
                'slug' => 'faq',
                'title' => 'Questions Frequentes',
                'content' => [
                    // === SECTION 1 : HERO ===
                    'hero' => [
                        'title' => 'Questions Frequentes',
                        'subtitle' => 'Trouvez des reponses a vos questions sur la phobie scolaire, l\'annuaire et l\'adhesion.',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],

                    // === SECTION 2 : CONFIGURATION FAQ ===
                    'faq' => [
                        'category_filter' => 'all',
                    ],

                    // === SECTION 3 : CTA FINAL ===
                    'cta' => [
                        'show' => true,
                        'title' => 'Vous n\'avez pas trouve la reponse ?',
                        'button_text' => 'Contactez-nous',
                        'button_url' => '/contact',
                    ],
                ],
                'meta' => [
                    'title' => 'FAQ - Cap Toi M\'aime',
                    'description' => 'Questions frequentes sur Cap Toi M\'aime et le refus scolaire anxieux.',
                ],
                'is_active' => true,
            ],

            // =============================================
            // PAGE A PROPOS - 5 sections (selon PageResource)
            // =============================================
            [
                'slug' => 'a-propos',
                'title' => 'A propos',
                'content' => [
                    // === SECTION 1 : HERO ===
                    'hero' => [
                        'title' => 'A propos de Cap Toi M\'aime',
                        'subtitle' => 'Une association suisse d\'accompagnement des familles face au refus scolaire anxieux.',
                        'background_color' => '#7A1F2E',
                        'text_color' => '#FFFFFF',
                    ],

                    // === SECTION 2 : NOTRE MISSION ===
                    'mission' => [
                        'show' => true,
                        'title' => 'Notre mission',
                        'content' => '<p>Cap Toi M\'aime accompagne les familles confrontees au refus scolaire anxieux en Suisse romande. Notre mission : briser l\'isolement et faciliter l\'acces aux soins.</p><p>L\'annuaire est ne d\'un constat simple : les familles peinent a trouver des professionnels formes et disponibles.</p>',
                        'image' => null,
                    ],

                    // === SECTION 3 : NOS VALEURS ===
                    'valeurs' => [
                        'show' => true,
                        'title' => 'Nos valeurs',
                        'items' => [
                            [
                                'icon' => 'heroicon-o-heart',
                                'title' => 'Bienveillance',
                                'description' => 'Accompagner les familles avec empathie et sans jugement.',
                            ],
                            [
                                'icon' => 'heroicon-o-users',
                                'title' => 'Solidarite',
                                'description' => 'Creer une communaute d\'entraide entre familles.',
                            ],
                            [
                                'icon' => 'heroicon-o-academic-cap',
                                'title' => 'Expertise',
                                'description' => 'S\'appuyer sur des professionnels formes et qualifies.',
                            ],
                        ],
                    ],

                    // === SECTION 4 : L'EQUIPE ===
                    'equipe' => [
                        'show' => true,
                        'title' => 'L\'equipe',
                        'members' => [
                            [
                                'photo' => null,
                                'name' => 'Marine Chambat',
                                'role' => 'Fondatrice',
                                'bio' => 'Maman concernee par le RSA, Marine a cree Cap Toi M\'aime pour briser l\'isolement des familles.',
                            ],
                        ],
                    ],

                    // === SECTION 5 : CTA FINAL ===
                    'cta' => [
                        'show' => true,
                        'title' => 'Rejoignez notre communaute',
                        'subtitle' => 'Decouvrez nos actions et ressources.',
                        'button_text' => 'Consulter l\'annuaire',
                        'button_url' => '/annuaire',
                    ],
                ],
                'meta' => [
                    'title' => 'A propos - Cap Toi M\'aime',
                    'description' => 'Decouvrez Cap Toi M\'aime, association suisse d\'accompagnement des familles face au refus scolaire anxieux.',
                ],
                'is_active' => true,
            ],

            // =============================================
            // PAGES LEGALES
            // =============================================
            [
                'slug' => 'mentions-legales',
                'title' => 'Mentions legales',
                'content' => [
                    'hero' => [
                        'title' => 'Mentions legales',
                        'subtitle' => '',
                        'background_color' => '#374151',
                        'text_color' => '#FFFFFF',
                    ],
                    'content_section' => [
                        'show' => true,
                        'title' => '',
                        'content' => '',
                        'sections' => [
                            [
                                'title' => 'Editeur du site',
                                'content' => '<p><strong>Association Cap Toi M\'aime</strong><br>Suisse</p>',
                            ],
                            [
                                'title' => 'Hebergement',
                                'content' => '<p>Laravel Forge / Hetzner<br>Europe</p>',
                            ],
                            [
                                'title' => 'Contact',
                                'content' => '<p>Email : hello@captoimaime.ch</p>',
                            ],
                        ],
                    ],
                ],
                'meta' => ['description' => 'Mentions legales du site Cap Toi M\'aime'],
                'is_active' => true,
            ],

            [
                'slug' => 'politique-confidentialite',
                'title' => 'Politique de confidentialite',
                'content' => [
                    'hero' => [
                        'title' => 'Politique de confidentialite',
                        'subtitle' => 'Protection de vos donnees personnelles',
                        'background_color' => '#374151',
                        'text_color' => '#FFFFFF',
                    ],
                    'content_section' => [
                        'show' => true,
                        'title' => '',
                        'content' => '',
                        'sections' => [
                            [
                                'title' => 'Donnees collectees',
                                'content' => '<p>Nous collectons uniquement les donnees necessaires au fonctionnement de nos services.</p>',
                            ],
                            [
                                'title' => 'Utilisation des donnees',
                                'content' => '<p>Vos donnees sont utilisees pour gerer votre compte et vous mettre en relation avec des professionnels.</p>',
                            ],
                            [
                                'title' => 'Vos droits',
                                'content' => '<p>Vous disposez d\'un droit d\'acces, de rectification et d\'effacement. Contact : hello@captoimaime.ch</p>',
                            ],
                        ],
                    ],
                ],
                'meta' => ['description' => 'Politique de confidentialite de Cap Toi M\'aime'],
                'is_active' => true,
            ],

            [
                'slug' => 'conditions-utilisation',
                'title' => 'Conditions d\'utilisation',
                'content' => [
                    'hero' => [
                        'title' => 'Conditions generales d\'utilisation',
                        'subtitle' => '',
                        'background_color' => '#374151',
                        'text_color' => '#FFFFFF',
                    ],
                    'content_section' => [
                        'show' => true,
                        'title' => '',
                        'content' => '',
                        'sections' => [
                            [
                                'title' => 'Objet du site',
                                'content' => '<p>Cap Toi M\'aime est une plateforme de mise en relation entre familles et professionnels.</p>',
                            ],
                            [
                                'title' => 'Responsabilite',
                                'content' => '<p>Le choix d\'un professionnel reste de la responsabilite de l\'utilisateur.</p>',
                            ],
                            [
                                'title' => 'Propriete intellectuelle',
                                'content' => '<p>Tous les contenus sont proteges par le droit d\'auteur.</p>',
                            ],
                        ],
                    ],
                ],
                'meta' => ['description' => 'Conditions d\'utilisation de Cap Toi M\'aime'],
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
