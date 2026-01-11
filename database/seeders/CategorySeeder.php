<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Psychologue', 'icon' => 'brain', 'order' => 1],
            ['name' => 'Pedopsychiatre', 'icon' => 'heart', 'order' => 2],
            ['name' => 'Therapeute familial', 'icon' => 'users', 'order' => 3],
            ['name' => 'Coach scolaire', 'icon' => 'graduation-cap', 'order' => 4],
            ['name' => 'Orthopedagogue', 'icon' => 'book', 'order' => 5],
            ['name' => 'Sophrologue', 'icon' => 'spa', 'order' => 6],
            ['name' => 'Art-therapeute', 'icon' => 'palette', 'order' => 7],
            ['name' => 'Hypnotherapeute', 'icon' => 'eye', 'order' => 8],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
