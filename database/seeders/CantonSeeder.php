<?php

namespace Database\Seeders;

use App\Models\Canton;
use Illuminate\Database\Seeder;

class CantonSeeder extends Seeder
{
    public function run(): void
    {
        $cantons = [
            ['name' => 'Geneve', 'code' => 'GE'],
            ['name' => 'Vaud', 'code' => 'VD'],
            ['name' => 'Valais', 'code' => 'VS'],
            ['name' => 'Fribourg', 'code' => 'FR'],
            ['name' => 'Neuchatel', 'code' => 'NE'],
            ['name' => 'Jura', 'code' => 'JU'],
            ['name' => 'Berne', 'code' => 'BE'],
        ];

        foreach ($cantons as $canton) {
            Canton::create($canton);
        }
    }
}
