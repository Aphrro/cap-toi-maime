<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // =============================================
            // SITE - Identité
            // =============================================
            [
                'group' => 'site',
                'key' => 'site_name',
                'value' => 'Cap Toi M\'aime',
                'type' => 'text',
                'label' => 'Nom du site',
            ],
            [
                'group' => 'site',
                'key' => 'site_description',
                'value' => 'Annuaire des professionnels spécialisés dans le refus scolaire anxieux en Suisse romande',
                'type' => 'textarea',
                'label' => 'Description du site',
            ],
            [
                'group' => 'site',
                'key' => 'site_logo',
                'value' => null,
                'type' => 'file',
                'label' => 'Logo du site',
            ],
            [
                'group' => 'site',
                'key' => 'site_favicon',
                'value' => null,
                'type' => 'file',
                'label' => 'Favicon',
            ],

            // =============================================
            // COULEURS
            // =============================================
            [
                'group' => 'colors',
                'key' => 'color_primary',
                'value' => '#7A1F2E',
                'type' => 'color',
                'label' => 'Couleur primaire (Bourgogne)',
            ],
            [
                'group' => 'colors',
                'key' => 'color_secondary',
                'value' => '#1E8A9B',
                'type' => 'color',
                'label' => 'Couleur secondaire (Teal)',
            ],
            [
                'group' => 'colors',
                'key' => 'color_accent',
                'value' => '#F5A623',
                'type' => 'color',
                'label' => 'Couleur accent',
            ],
            [
                'group' => 'colors',
                'key' => 'color_background',
                'value' => '#FFFFFF',
                'type' => 'color',
                'label' => 'Couleur de fond',
            ],

            // =============================================
            // NAVBAR - Configuration complète
            // =============================================
            [
                'group' => 'navbar',
                'key' => 'navbar_config',
                'value' => json_encode([
                    'links' => [
                        ['label' => 'Accueil', 'url' => '/', 'is_active' => true],
                        ['label' => 'Comment ça marche', 'url' => '/comment-ca-marche', 'is_active' => true],
                        ['label' => 'Annuaire', 'url' => '/annuaire', 'is_active' => true],
                        ['label' => 'Ressources', 'url' => '/ressources', 'is_active' => true],
                        ['label' => 'L\'Association', 'url' => '/association', 'is_active' => true],
                    ],
                    'cta_text' => 'TROUVER UN PRO',
                    'cta_url' => '/questionnaire',
                    'cta_visible' => true,
                ], JSON_UNESCAPED_UNICODE),
                'type' => 'json',
                'label' => 'Configuration Navbar',
            ],

            // =============================================
            // FOOTER - Configuration complète
            // =============================================
            [
                'group' => 'footer',
                'key' => 'footer_config',
                'value' => json_encode([
                    'description' => 'Plateforme de mise en relation entre familles et professionnels spécialisés dans l\'accompagnement du refus scolaire anxieux en Suisse.',
                    'columns' => [
                        [
                            'title' => 'Navigation',
                            'links' => [
                                ['label' => 'Accueil', 'url' => '/'],
                                ['label' => 'Annuaire', 'url' => '/annuaire'],
                                ['label' => 'Comment ça marche', 'url' => '/comment-ca-marche'],
                                ['label' => 'FAQ', 'url' => '/faq'],
                            ]
                        ],
                        [
                            'title' => 'Professionnels',
                            'links' => [
                                ['label' => 'Devenir membre', 'url' => '/devenir-membre'],
                                ['label' => 'Espace pro', 'url' => '/espace-professionnels'],
                            ]
                        ],
                        [
                            'title' => 'Légal',
                            'links' => [
                                ['label' => 'Mentions légales', 'url' => '/mentions-legales'],
                                ['label' => 'Confidentialité', 'url' => '/politique-confidentialite'],
                                ['label' => 'CGU', 'url' => '/conditions-utilisation'],
                            ]
                        ],
                    ],
                    'social' => [
                        'facebook' => 'https://www.facebook.com/captoimaime',
                        'instagram' => 'https://www.instagram.com/captoimaime',
                        'linkedin' => '',
                        'twitter' => '',
                    ],
                    'copyright' => '© ' . date('Y') . ' Cap Toi M\'aime. Tous droits réservés.',
                ], JSON_UNESCAPED_UNICODE),
                'type' => 'json',
                'label' => 'Configuration Footer',
            ],

            // =============================================
            // CONTACT
            // =============================================
            [
                'group' => 'contact',
                'key' => 'contact_email',
                'value' => 'contact@captoimaime.ch',
                'type' => 'email',
                'label' => 'Email de contact',
            ],
            [
                'group' => 'contact',
                'key' => 'contact_phone',
                'value' => null,
                'type' => 'text',
                'label' => 'Téléphone de contact',
            ],
            [
                'group' => 'contact',
                'key' => 'contact_address',
                'value' => 'Suisse romande',
                'type' => 'textarea',
                'label' => 'Adresse',
            ],

            // =============================================
            // SOCIAL (valeurs simples pour compatibilité)
            // =============================================
            [
                'group' => 'social',
                'key' => 'facebook_url',
                'value' => 'https://www.facebook.com/captoimaime',
                'type' => 'url',
                'label' => 'Page Facebook',
            ],
            [
                'group' => 'social',
                'key' => 'instagram_url',
                'value' => 'https://www.instagram.com/captoimaime',
                'type' => 'url',
                'label' => 'Compte Instagram',
            ],
            [
                'group' => 'social',
                'key' => 'linkedin_url',
                'value' => null,
                'type' => 'url',
                'label' => 'Page LinkedIn',
            ],
            [
                'group' => 'social',
                'key' => 'youtube_url',
                'value' => null,
                'type' => 'url',
                'label' => 'Chaîne YouTube',
            ],

            // =============================================
            // SEO
            // =============================================
            [
                'group' => 'seo',
                'key' => 'meta_title',
                'value' => 'Cap Toi M\'aime - Annuaire Refus Scolaire Anxieux Suisse',
                'type' => 'text',
                'label' => 'Titre meta par défaut',
            ],
            [
                'group' => 'seo',
                'key' => 'meta_description',
                'value' => 'Trouvez des professionnels spécialisés dans le refus scolaire anxieux (phobie scolaire) en Suisse romande. Psychologues, psychiatres, thérapeutes vérifiés.',
                'type' => 'textarea',
                'label' => 'Description meta par défaut',
            ],
            [
                'group' => 'seo',
                'key' => 'meta_keywords',
                'value' => 'refus scolaire anxieux, phobie scolaire, suisse, psychologue, psychiatre, thérapeute, enfant, adolescent',
                'type' => 'text',
                'label' => 'Mots-clés meta',
            ],
            [
                'group' => 'seo',
                'key' => 'google_analytics_id',
                'value' => null,
                'type' => 'text',
                'label' => 'Google Analytics ID',
            ],

            // =============================================
            // EMAIL
            // =============================================
            [
                'group' => 'email',
                'key' => 'email_from_name',
                'value' => 'Cap Toi M\'aime',
                'type' => 'text',
                'label' => 'Nom expéditeur emails',
            ],
            [
                'group' => 'email',
                'key' => 'email_from_address',
                'value' => 'noreply@captoimaime.ch',
                'type' => 'email',
                'label' => 'Adresse expéditeur emails',
            ],
            [
                'group' => 'email',
                'key' => 'email_contact_recipients',
                'value' => 'contact@captoimaime.ch',
                'type' => 'text',
                'label' => 'Destinataires formulaire contact',
            ],

            // =============================================
            // MEMBERSHIP
            // =============================================
            [
                'group' => 'membership',
                'key' => 'membership_fee_individual',
                'value' => '50',
                'type' => 'number',
                'label' => 'Cotisation individuelle (CHF)',
            ],
            [
                'group' => 'membership',
                'key' => 'membership_fee_family',
                'value' => '80',
                'type' => 'number',
                'label' => 'Cotisation famille (CHF)',
            ],
            [
                'group' => 'membership',
                'key' => 'membership_fee_professional',
                'value' => '0',
                'type' => 'number',
                'label' => 'Cotisation professionnel (CHF)',
            ],
            [
                'group' => 'membership',
                'key' => 'iban',
                'value' => null,
                'type' => 'text',
                'label' => 'IBAN pour les paiements',
            ],

            // =============================================
            // EVENTS
            // =============================================
            [
                'group' => 'events',
                'key' => 'events_enabled',
                'value' => '1',
                'type' => 'boolean',
                'label' => 'Activer les événements',
            ],
            [
                'group' => 'events',
                'key' => 'events_registration_enabled',
                'value' => '1',
                'type' => 'boolean',
                'label' => 'Activer les inscriptions aux événements',
            ],

            // =============================================
            // FEATURES FLAGS
            // =============================================
            [
                'group' => 'features',
                'key' => 'questionnaire_enabled',
                'value' => '1',
                'type' => 'boolean',
                'label' => 'Activer le questionnaire',
            ],
            [
                'group' => 'features',
                'key' => 'registration_enabled',
                'value' => '1',
                'type' => 'boolean',
                'label' => 'Activer les inscriptions',
            ],
            [
                'group' => 'features',
                'key' => 'contact_form_enabled',
                'value' => '1',
                'type' => 'boolean',
                'label' => 'Activer le formulaire de contact',
            ],
            [
                'group' => 'features',
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
                'label' => 'Mode maintenance',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
