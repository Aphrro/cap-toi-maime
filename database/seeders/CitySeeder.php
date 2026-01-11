<?php

namespace Database\Seeders;

use App\Models\Canton;
use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            // Geneve
            ['name' => 'Geneve', 'postal_code' => '1200', 'canton_code' => 'GE', 'latitude' => 46.2044, 'longitude' => 6.1432],
            ['name' => 'Carouge', 'postal_code' => '1227', 'canton_code' => 'GE', 'latitude' => 46.1835, 'longitude' => 6.1391],
            ['name' => 'Vernier', 'postal_code' => '1214', 'canton_code' => 'GE', 'latitude' => 46.2170, 'longitude' => 6.0850],

            // Vaud
            ['name' => 'Lausanne', 'postal_code' => '1000', 'canton_code' => 'VD', 'latitude' => 46.5197, 'longitude' => 6.6323],
            ['name' => 'Montreux', 'postal_code' => '1820', 'canton_code' => 'VD', 'latitude' => 46.4312, 'longitude' => 6.9107],
            ['name' => 'Nyon', 'postal_code' => '1260', 'canton_code' => 'VD', 'latitude' => 46.3830, 'longitude' => 6.2399],
            ['name' => 'Vevey', 'postal_code' => '1800', 'canton_code' => 'VD', 'latitude' => 46.4628, 'longitude' => 6.8430],
            ['name' => 'Morges', 'postal_code' => '1110', 'canton_code' => 'VD', 'latitude' => 46.5110, 'longitude' => 6.4990],

            // Valais
            ['name' => 'Sion', 'postal_code' => '1950', 'canton_code' => 'VS', 'latitude' => 46.2270, 'longitude' => 7.3600],
            ['name' => 'Martigny', 'postal_code' => '1920', 'canton_code' => 'VS', 'latitude' => 46.1020, 'longitude' => 7.0720],
            ['name' => 'Monthey', 'postal_code' => '1870', 'canton_code' => 'VS', 'latitude' => 46.2540, 'longitude' => 6.9540],

            // Fribourg
            ['name' => 'Fribourg', 'postal_code' => '1700', 'canton_code' => 'FR', 'latitude' => 46.8065, 'longitude' => 7.1620],
            ['name' => 'Bulle', 'postal_code' => '1630', 'canton_code' => 'FR', 'latitude' => 46.6190, 'longitude' => 7.0580],

            // Neuchatel
            ['name' => 'Neuchatel', 'postal_code' => '2000', 'canton_code' => 'NE', 'latitude' => 46.9900, 'longitude' => 6.9293],
            ['name' => 'La Chaux-de-Fonds', 'postal_code' => '2300', 'canton_code' => 'NE', 'latitude' => 47.1035, 'longitude' => 6.8260],

            // Jura
            ['name' => 'Delemont', 'postal_code' => '2800', 'canton_code' => 'JU', 'latitude' => 47.3650, 'longitude' => 7.3490],
            ['name' => 'Porrentruy', 'postal_code' => '2900', 'canton_code' => 'JU', 'latitude' => 47.4150, 'longitude' => 7.0750],

            // Berne (partie francophone)
            ['name' => 'Bienne', 'postal_code' => '2500', 'canton_code' => 'BE', 'latitude' => 47.1368, 'longitude' => 7.2467],
            ['name' => 'Moutier', 'postal_code' => '2740', 'canton_code' => 'BE', 'latitude' => 47.2780, 'longitude' => 7.3690],
        ];

        foreach ($cities as $cityData) {
            $canton = Canton::where('code', $cityData['canton_code'])->first();
            if ($canton) {
                City::create([
                    'name' => $cityData['name'],
                    'postal_code' => $cityData['postal_code'],
                    'canton_id' => $canton->id,
                    'latitude' => $cityData['latitude'],
                    'longitude' => $cityData['longitude'],
                ]);
            }
        }
    }
}
