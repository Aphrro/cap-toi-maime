<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProfessionSeeder extends Seeder
{
    public function run(): void
    {
        $professions = [
            'Psychologue',
            'Psychiatre',
            'Psychothérapeute',
            'Pédopsychiatre',
            'Neuropsychologue',
            'Logopédiste',
            'Ergothérapeute',
            'Psychomotricien',
            'Coach parental',
            'Thérapeute familial',
            'Hypnothérapeute',
            'Art-thérapeute',
            'Sophrologue',
            'Enseignant spécialisé',
            'Educateur spécialisé',
        ];

        foreach ($professions as $index => $name) {
            Profession::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'order' => $index, 'is_active' => true]
            );
        }
    }
}
