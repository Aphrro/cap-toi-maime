<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Psychologue',
                'description' => 'Accompagnement psychologique, thérapie cognitive et comportementale, gestion de l\'anxiété',
                'icon' => 'brain',
                'order' => 1
            ],
            [
                'name' => 'Pédopsychiatre',
                'description' => 'Diagnostic et suivi médical des troubles psychiatriques chez l\'enfant et l\'adolescent',
                'icon' => 'stethoscope',
                'order' => 2
            ],
            [
                'name' => 'Neuropsychologue',
                'description' => 'Bilans neuropsychologiques, diagnostic HPI, TDAH, TSA, troubles DYS',
                'icon' => 'scan',
                'order' => 3
            ],
            [
                'name' => 'Thérapeute familial',
                'description' => 'Accompagnement de la famille, médiation, communication parent-enfant',
                'icon' => 'users',
                'order' => 4
            ],
            [
                'name' => 'Coach scolaire',
                'description' => 'Remotivation, orientation, méthodologie, confiance en soi',
                'icon' => 'compass',
                'order' => 5
            ],
            [
                'name' => 'Orthopédagogue',
                'description' => 'Apprentissages adaptés, stratégies d\'apprentissage personnalisées',
                'icon' => 'book-open',
                'order' => 6
            ],
            [
                'name' => 'Sophrologue',
                'description' => 'Relaxation, gestion du stress et de l\'anxiété, préparation mentale',
                'icon' => 'wind',
                'order' => 7
            ],
            [
                'name' => 'Art-thérapeute',
                'description' => 'Expression créative, libération émotionnelle par l\'art',
                'icon' => 'palette',
                'order' => 8
            ],
            [
                'name' => 'Hypnothérapeute',
                'description' => 'Hypnose thérapeutique, gestion des phobies et de l\'anxiété',
                'icon' => 'sparkles',
                'order' => 9
            ],
            [
                'name' => 'Ergothérapeute',
                'description' => 'Autonomie fonctionnelle, adaptation de l\'environnement scolaire',
                'icon' => 'hand',
                'order' => 10
            ],
            [
                'name' => 'Logopédiste',
                'description' => 'Troubles du langage, communication, troubles DYS',
                'icon' => 'message-circle',
                'order' => 11
            ],
            [
                'name' => 'Pédiatre',
                'description' => 'Suivi médical global, coordination des soins',
                'icon' => 'heart-pulse',
                'order' => 12
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
