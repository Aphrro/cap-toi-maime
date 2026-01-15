<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            [
                'group' => 'general',
                'key' => 'site_name',
                'value' => 'Cap Toi M\'aime',
                'type' => 'text',
                'label' => 'Nom du site',
            ],
            [
                'group' => 'general',
                'key' => 'site_description',
                'value' => 'Annuaire des professionnels spécialisés dans le refus scolaire anxieux en Suisse romande',
                'type' => 'textarea',
                'label' => 'Description du site',
            ],
            [
                'group' => 'general',
                'key' => 'site_logo',
                'value' => null,
                'type' => 'text',
                'label' => 'Logo du site (URL)',
            ],

            // Contact
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

            // Social
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

            // SEO
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

            // Email
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

            // Membership
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

            // Events
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
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
