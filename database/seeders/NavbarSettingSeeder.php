<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class NavbarSettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'navbar_config'],
            [
                'value' => json_encode([
                    'links' => [
                        ['label' => 'Accueil', 'url' => '/', 'is_active' => true],
                        ['label' => 'À propos', 'url' => '/a-propos', 'is_active' => true],
                        ['label' => 'FAQ', 'url' => '/faq', 'is_active' => true],
                        ['label' => 'Témoignages', 'url' => '/temoignages', 'is_active' => true],
                        ['label' => 'Contact', 'url' => '/contact', 'is_active' => true],
                        ['label' => 'Espace Pro', 'url' => '/espace-pro', 'is_active' => true],
                    ],
                    'cta_text' => 'Trouver un pro',
                    'cta_url' => '/annuaire',
                    'cta_visible' => true
                ]),
                'group' => 'navigation'
            ]
        );
    }
}
