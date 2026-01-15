<?php

namespace Database\Seeders;

use App\Models\Canton;
use App\Models\City;
use Illuminate\Database\Seeder;

class CantonSeeder extends Seeder
{
    public function run(): void
    {
        $cantons = [
            'GE' => [
                'name' => 'Genève',
                'cities' => [
                    ['name' => 'Genève', 'postal_code' => '1200'],
                    ['name' => 'Carouge', 'postal_code' => '1227'],
                    ['name' => 'Vernier', 'postal_code' => '1214'],
                    ['name' => 'Lancy', 'postal_code' => '1212'],
                    ['name' => 'Meyrin', 'postal_code' => '1217'],
                    ['name' => 'Onex', 'postal_code' => '1213'],
                    ['name' => 'Thônex', 'postal_code' => '1226'],
                    ['name' => 'Versoix', 'postal_code' => '1290'],
                    ['name' => 'Chêne-Bougeries', 'postal_code' => '1224'],
                    ['name' => 'Grand-Saconnex', 'postal_code' => '1218'],
                ],
            ],
            'VD' => [
                'name' => 'Vaud',
                'cities' => [
                    ['name' => 'Lausanne', 'postal_code' => '1000'],
                    ['name' => 'Yverdon-les-Bains', 'postal_code' => '1400'],
                    ['name' => 'Montreux', 'postal_code' => '1820'],
                    ['name' => 'Nyon', 'postal_code' => '1260'],
                    ['name' => 'Renens', 'postal_code' => '1020'],
                    ['name' => 'Vevey', 'postal_code' => '1800'],
                    ['name' => 'Pully', 'postal_code' => '1009'],
                    ['name' => 'Morges', 'postal_code' => '1110'],
                    ['name' => 'Prilly', 'postal_code' => '1008'],
                    ['name' => 'Ecublens', 'postal_code' => '1024'],
                ],
            ],
            'VS' => [
                'name' => 'Valais',
                'cities' => [
                    ['name' => 'Sion', 'postal_code' => '1950'],
                    ['name' => 'Martigny', 'postal_code' => '1920'],
                    ['name' => 'Sierre', 'postal_code' => '3960'],
                    ['name' => 'Monthey', 'postal_code' => '1870'],
                    ['name' => 'Brig-Glis', 'postal_code' => '3900'],
                    ['name' => 'Naters', 'postal_code' => '3904'],
                    ['name' => 'Conthey', 'postal_code' => '1964'],
                    ['name' => 'Fully', 'postal_code' => '1926'],
                    ['name' => 'Collombey-Muraz', 'postal_code' => '1868'],
                    ['name' => 'Saviese', 'postal_code' => '1965'],
                ],
            ],
            'NE' => [
                'name' => 'Neuchâtel',
                'cities' => [
                    ['name' => 'Neuchâtel', 'postal_code' => '2000'],
                    ['name' => 'La Chaux-de-Fonds', 'postal_code' => '2300'],
                    ['name' => 'Le Locle', 'postal_code' => '2400'],
                    ['name' => 'Val-de-Travers', 'postal_code' => '2105'],
                    ['name' => 'Boudry', 'postal_code' => '2017'],
                    ['name' => 'Peseux', 'postal_code' => '2034'],
                    ['name' => 'Cortaillod', 'postal_code' => '2016'],
                    ['name' => 'Bevaix', 'postal_code' => '2022'],
                    ['name' => 'Marin-Epagnier', 'postal_code' => '2074'],
                    ['name' => 'Hauterive', 'postal_code' => '2068'],
                ],
            ],
            'FR' => [
                'name' => 'Fribourg',
                'cities' => [
                    ['name' => 'Fribourg', 'postal_code' => '1700'],
                    ['name' => 'Bulle', 'postal_code' => '1630'],
                    ['name' => 'Villars-sur-Glâne', 'postal_code' => '1752'],
                    ['name' => 'Marly', 'postal_code' => '1723'],
                    ['name' => 'Granges-Paccot', 'postal_code' => '1763'],
                    ['name' => 'Givisiez', 'postal_code' => '1762'],
                    ['name' => 'Estavayer-le-Lac', 'postal_code' => '1470'],
                    ['name' => 'Châtel-Saint-Denis', 'postal_code' => '1618'],
                    ['name' => 'Romont', 'postal_code' => '1680'],
                    ['name' => 'Morat', 'postal_code' => '1787'],
                ],
            ],
            'JU' => [
                'name' => 'Jura',
                'cities' => [
                    ['name' => 'Delémont', 'postal_code' => '2800'],
                    ['name' => 'Porrentruy', 'postal_code' => '2900'],
                    ['name' => 'Bassecourt', 'postal_code' => '2854'],
                    ['name' => 'Courrendlin', 'postal_code' => '2830'],
                    ['name' => 'Courroux', 'postal_code' => '2822'],
                    ['name' => 'Saignelégier', 'postal_code' => '2350'],
                    ['name' => 'Courtételle', 'postal_code' => '2852'],
                    ['name' => 'Alle', 'postal_code' => '2942'],
                    ['name' => 'Fontenais', 'postal_code' => '2902'],
                    ['name' => 'Develier', 'postal_code' => '2802'],
                ],
            ],
            'BE' => [
                'name' => 'Berne',
                'cities' => [
                    ['name' => 'Berne', 'postal_code' => '3000'],
                    ['name' => 'Bienne', 'postal_code' => '2500'],
                    ['name' => 'Moutier', 'postal_code' => '2740'],
                    ['name' => 'Saint-Imier', 'postal_code' => '2610'],
                    ['name' => 'Tramelan', 'postal_code' => '2720'],
                    ['name' => 'La Neuveville', 'postal_code' => '2520'],
                    ['name' => 'Reconvilier', 'postal_code' => '2732'],
                    ['name' => 'Tavannes', 'postal_code' => '2710'],
                    ['name' => 'Courtelary', 'postal_code' => '2608'],
                    ['name' => 'Corgémont', 'postal_code' => '2606'],
                ],
            ],
        ];

        $order = 1;
        foreach ($cantons as $code => $data) {
            $canton = Canton::updateOrCreate(
                ['code' => $code],
                ['name' => $data['name'], 'order' => $order++, 'is_active' => true]
            );

            foreach ($data['cities'] as $cityData) {
                City::updateOrCreate(
                    ['canton_id' => $canton->id, 'name' => $cityData['name']],
                    ['postal_code' => $cityData['postal_code'], 'is_active' => true]
                );
            }
        }
    }
}
