<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Canton;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            // Genève
            ['name' => 'Genève', 'postal_code' => '1200', 'canton' => 'GE'],
            ['name' => 'Carouge', 'postal_code' => '1227', 'canton' => 'GE'],
            ['name' => 'Vernier', 'postal_code' => '1214', 'canton' => 'GE'],
            ['name' => 'Lancy', 'postal_code' => '1212', 'canton' => 'GE'],
            ['name' => 'Meyrin', 'postal_code' => '1217', 'canton' => 'GE'],
            ['name' => 'Thônex', 'postal_code' => '1226', 'canton' => 'GE'],

            // Vaud
            ['name' => 'Lausanne', 'postal_code' => '1000', 'canton' => 'VD'],
            ['name' => 'Nyon', 'postal_code' => '1260', 'canton' => 'VD'],
            ['name' => 'Montreux', 'postal_code' => '1820', 'canton' => 'VD'],
            ['name' => 'Vevey', 'postal_code' => '1800', 'canton' => 'VD'],
            ['name' => 'Morges', 'postal_code' => '1110', 'canton' => 'VD'],
            ['name' => 'Yverdon-les-Bains', 'postal_code' => '1400', 'canton' => 'VD'],
            ['name' => 'Pully', 'postal_code' => '1009', 'canton' => 'VD'],
            ['name' => 'Renens', 'postal_code' => '1020', 'canton' => 'VD'],

            // Valais
            ['name' => 'Sion', 'postal_code' => '1950', 'canton' => 'VS'],
            ['name' => 'Martigny', 'postal_code' => '1920', 'canton' => 'VS'],
            ['name' => 'Sierre', 'postal_code' => '3960', 'canton' => 'VS'],
            ['name' => 'Monthey', 'postal_code' => '1870', 'canton' => 'VS'],

            // Fribourg
            ['name' => 'Fribourg', 'postal_code' => '1700', 'canton' => 'FR'],
            ['name' => 'Bulle', 'postal_code' => '1630', 'canton' => 'FR'],

            // Neuchâtel
            ['name' => 'Neuchâtel', 'postal_code' => '2000', 'canton' => 'NE'],
            ['name' => 'La Chaux-de-Fonds', 'postal_code' => '2300', 'canton' => 'NE'],

            // Jura
            ['name' => 'Delémont', 'postal_code' => '2800', 'canton' => 'JU'],
            ['name' => 'Porrentruy', 'postal_code' => '2900', 'canton' => 'JU'],

            // Berne (partie francophone)
            ['name' => 'Bienne', 'postal_code' => '2502', 'canton' => 'BE'],
            ['name' => 'Moutier', 'postal_code' => '2740', 'canton' => 'BE'],
        ];

        foreach ($cities as $cityData) {
            $canton = Canton::where('code', $cityData['canton'])->first();

            if ($canton) {
                City::updateOrCreate(
                    ['name' => $cityData['name'], 'canton_id' => $canton->id],
                    [
                        'postal_code' => $cityData['postal_code'],
                        'canton_id' => $canton->id,
                    ]
                );
            }
        }
    }
}
