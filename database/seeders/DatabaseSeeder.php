<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CantonSeeder::class,
            ProfessionSeeder::class,
            SpecialtySeeder::class,
            LanguageSeeder::class,
            ReimbursementTypeSeeder::class,
            FaqSeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
