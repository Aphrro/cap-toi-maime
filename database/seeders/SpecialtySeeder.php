<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            ['name' => 'Phobie scolaire', 'description' => 'Refus scolaire anxieux, peur intense de l\'école'],
            ['name' => 'Refus scolaire', 'description' => 'Décrochage, perte de motivation scolaire'],
            ['name' => 'Haut Potentiel (HPI)', 'description' => 'Accompagnement des enfants à haut potentiel intellectuel'],
            ['name' => 'TDAH', 'description' => 'Trouble du déficit de l\'attention avec ou sans hyperactivité'],
            ['name' => 'TSA / Autisme', 'description' => 'Troubles du spectre autistique'],
            ['name' => 'Troubles DYS', 'description' => 'Dyslexie, dysorthographie, dyscalculie, dyspraxie'],
            ['name' => 'Anxiété', 'description' => 'Troubles anxieux, crises d\'angoisse, anxiété sociale'],
            ['name' => 'Harcèlement scolaire', 'description' => 'Accompagnement des victimes de harcèlement'],
            ['name' => 'Burn-out scolaire', 'description' => 'Épuisement lié à la surcharge scolaire'],
            ['name' => 'Hypersensibilité', 'description' => 'Accompagnement des personnes hypersensibles'],
            ['name' => 'Gestion des émotions', 'description' => 'Régulation émotionnelle, intelligence émotionnelle'],
            ['name' => 'Confiance en soi', 'description' => 'Estime de soi, affirmation de soi'],
            ['name' => 'Orientation scolaire', 'description' => 'Aide au choix d\'orientation, projet professionnel'],
            ['name' => 'Médiation familiale', 'description' => 'Résolution de conflits familiaux'],
            ['name' => 'Traumatisme', 'description' => 'Accompagnement post-traumatique, EMDR'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::updateOrCreate(
                ['name' => $specialty['name']],
                $specialty
            );
        }
    }
}
