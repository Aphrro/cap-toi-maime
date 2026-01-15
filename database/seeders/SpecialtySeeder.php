<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            ['name' => 'Phobie scolaire', 'icon' => '🏫', 'description' => 'Accompagnement des enfants présentant une phobie scolaire'],
            ['name' => 'Refus scolaire anxieux', 'icon' => '😰', 'description' => 'Prise en charge du refus scolaire lié à l\'anxiété'],
            ['name' => 'Anxiété', 'icon' => '💭', 'description' => 'Troubles anxieux chez l\'enfant et l\'adolescent'],
            ['name' => 'Dépression', 'icon' => '🌧️', 'description' => 'Accompagnement des états dépressifs'],
            ['name' => 'TDA/H', 'icon' => '⚡', 'description' => 'Trouble du Déficit de l\'Attention avec ou sans Hyperactivité'],
            ['name' => 'HPI / Haut Potentiel', 'icon' => '🧠', 'description' => 'Accompagnement des enfants à haut potentiel intellectuel'],
            ['name' => 'TSA / Autisme', 'icon' => '🧩', 'description' => 'Troubles du Spectre de l\'Autisme'],
            ['name' => 'Troubles DYS', 'icon' => '📚', 'description' => 'Dyslexie, dysorthographie, dyscalculie, dyspraxie'],
            ['name' => 'Harcèlement scolaire', 'icon' => '🛡️', 'description' => 'Accompagnement des victimes de harcèlement'],
            ['name' => 'Traumatisme', 'icon' => '💔', 'description' => 'Prise en charge des traumatismes psychologiques'],
            ['name' => 'Troubles du sommeil', 'icon' => '🌙', 'description' => 'Insomnies et troubles du sommeil chez l\'enfant'],
            ['name' => 'Gestion des émotions', 'icon' => '🎭', 'description' => 'Régulation émotionnelle et gestion du stress'],
            ['name' => 'Estime de soi', 'icon' => '⭐', 'description' => 'Travail sur la confiance et l\'estime de soi'],
            ['name' => 'Relations familiales', 'icon' => '👨‍👩‍👧', 'description' => 'Accompagnement des dynamiques familiales'],
            ['name' => 'Orientation scolaire', 'icon' => '🎯', 'description' => 'Aide à l\'orientation et au projet scolaire'],
        ];

        foreach ($specialties as $index => $specialty) {
            Specialty::updateOrCreate(
                ['slug' => Str::slug($specialty['name'])],
                [
                    'name' => $specialty['name'],
                    'icon' => $specialty['icon'],
                    'description' => $specialty['description'],
                    'order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
