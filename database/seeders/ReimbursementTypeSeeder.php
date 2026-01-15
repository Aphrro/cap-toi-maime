<?php

namespace Database\Seeders;

use App\Models\ReimbursementType;
use Illuminate\Database\Seeder;

class ReimbursementTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'LAMal (Assurance de base)',
                'code' => 'lamal',
                'description' => 'Remboursement par l\'assurance maladie de base suisse',
                'order' => 1,
            ],
            [
                'name' => 'Assurance complémentaire',
                'code' => 'complementaire',
                'description' => 'Remboursement par les assurances complémentaires',
                'order' => 2,
            ],
            [
                'name' => 'ASCA',
                'code' => 'asca',
                'description' => 'Fondation suisse pour les médecines complémentaires',
                'order' => 3,
            ],
            [
                'name' => 'RME',
                'code' => 'rme',
                'description' => 'Registre de Médecine Empirique',
                'order' => 4,
            ],
            [
                'name' => 'APTN',
                'code' => 'aptn',
                'description' => 'Association des Psychothérapeutes',
                'order' => 5,
            ],
            [
                'name' => 'AI/AVS',
                'code' => 'ai_avs',
                'description' => 'Assurance Invalidité / Vieillesse et Survivants',
                'order' => 6,
            ],
            [
                'name' => 'Pas de remboursement',
                'code' => 'none',
                'description' => 'Consultation non remboursée',
                'order' => 99,
            ],
        ];

        foreach ($types as $type) {
            ReimbursementType::updateOrCreate(
                ['code' => $type['code']],
                [
                    'name' => $type['name'],
                    'description' => $type['description'],
                    'order' => $type['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
