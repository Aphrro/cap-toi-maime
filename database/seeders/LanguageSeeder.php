<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            ['name' => 'Français', 'code' => 'fr', 'order' => 1],
            ['name' => 'Allemand', 'code' => 'de', 'order' => 2],
            ['name' => 'Italien', 'code' => 'it', 'order' => 3],
            ['name' => 'Anglais', 'code' => 'en', 'order' => 4],
            ['name' => 'Espagnol', 'code' => 'es', 'order' => 5],
            ['name' => 'Portugais', 'code' => 'pt', 'order' => 6],
            ['name' => 'Arabe', 'code' => 'ar', 'order' => 7],
        ];

        foreach ($languages as $lang) {
            Language::updateOrCreate(
                ['code' => $lang['code']],
                ['name' => $lang['name'], 'order' => $lang['order'], 'is_active' => true]
            );
        }
    }
}
