<?php

namespace Database\Seeders;

use App\Models\Professional;
use App\Models\Category;
use App\Models\City;
use App\Models\Specialty;
use Illuminate\Database\Seeder;

class ProfessionalSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les IDs
        $psychologue = Category::where('name', 'Psychologue')->first();
        $neuropsychologue = Category::where('name', 'Neuropsychologue')->first();
        $coach = Category::where('name', 'Coach scolaire')->first();
        $pedopsy = Category::where('name', 'Pédopsychiatre')->first();
        $sophrologue = Category::where('name', 'Sophrologue')->first();

        $geneve = City::where('name', 'Genève')->first();
        $lausanne = City::where('name', 'Lausanne')->first();
        $nyon = City::where('name', 'Nyon')->first();

        $phobieScolaire = Specialty::where('name', 'Phobie scolaire')->first();
        $hpi = Specialty::where('name', 'Haut Potentiel (HPI)')->first();
        $tdah = Specialty::where('name', 'TDAH')->first();
        $anxiete = Specialty::where('name', 'Anxiété')->first();
        $harcelement = Specialty::where('name', 'Harcèlement scolaire')->first();
        $confiance = Specialty::where('name', 'Confiance en soi')->first();

        // Professionnels fictifs
        $professionals = [
            [
                'first_name' => 'Marie',
                'last_name' => 'Dupont',
                'title' => 'Dr.',
                'email' => 'marie.dupont@example.ch',
                'phone' => '+41 22 123 45 67',
                'bio' => 'Psychologue spécialisée dans l\'accompagnement des adolescents en phobie scolaire depuis 15 ans. Approche cognitive et comportementale.',
                'address' => 'Rue du Rhône 45',
                'city_id' => $geneve?->id,
                'category_id' => $psychologue?->id,
                'languages' => ['FR', 'EN'],
                'consultation_type' => 'cabinet',
                'is_verified' => true,
                'is_active' => true,
                'validation_status' => 'approved',
                'specialties' => [$phobieScolaire?->id, $anxiete?->id, $harcelement?->id],
            ],
            [
                'first_name' => 'Jean',
                'last_name' => 'Martin',
                'title' => null,
                'email' => 'jean.martin@example.ch',
                'phone' => '+41 21 234 56 78',
                'bio' => 'Neuropsychologue spécialisé dans le diagnostic et l\'accompagnement des enfants HPI et TDAH. Bilans complets et suivis personnalisés.',
                'address' => 'Avenue de la Gare 12',
                'city_id' => $lausanne?->id,
                'category_id' => $neuropsychologue?->id,
                'languages' => ['FR', 'DE'],
                'consultation_type' => 'cabinet',
                'is_verified' => true,
                'is_active' => true,
                'validation_status' => 'approved',
                'specialties' => [$hpi?->id, $tdah?->id],
            ],
            [
                'first_name' => 'Sophie',
                'last_name' => 'Müller',
                'title' => null,
                'email' => 'sophie.muller@example.ch',
                'phone' => '+41 22 345 67 89',
                'bio' => 'Coach scolaire certifiée, j\'accompagne les jeunes en décrochage vers la remotivation et la confiance en soi.',
                'address' => 'Chemin des Vignes 8',
                'city_id' => $nyon?->id,
                'category_id' => $coach?->id,
                'languages' => ['FR', 'DE', 'EN'],
                'consultation_type' => 'visio',
                'is_verified' => true,
                'is_active' => true,
                'validation_status' => 'approved',
                'specialties' => [$phobieScolaire?->id, $confiance?->id],
            ],
            [
                'first_name' => 'Philippe',
                'last_name' => 'Renaud',
                'title' => 'Dr.',
                'email' => 'philippe.renaud@example.ch',
                'phone' => '+41 22 456 78 90',
                'bio' => 'Pédopsychiatre avec 20 ans d\'expérience. Spécialisé dans les troubles anxieux et le refus scolaire chez l\'adolescent.',
                'address' => 'Boulevard des Philosophes 22',
                'city_id' => $geneve?->id,
                'category_id' => $pedopsy?->id,
                'languages' => ['FR'],
                'consultation_type' => 'cabinet',
                'is_verified' => true,
                'is_active' => true,
                'validation_status' => 'approved',
                'specialties' => [$phobieScolaire?->id, $anxiete?->id],
            ],
            [
                'first_name' => 'Isabelle',
                'last_name' => 'Favre',
                'title' => null,
                'email' => 'isabelle.favre@example.ch',
                'phone' => '+41 21 567 89 01',
                'bio' => 'Sophrologue certifiée, j\'aide les jeunes à gérer leur stress et leur anxiété face à l\'école par des techniques de relaxation.',
                'address' => 'Rue de Bourg 30',
                'city_id' => $lausanne?->id,
                'category_id' => $sophrologue?->id,
                'languages' => ['FR', 'IT'],
                'consultation_type' => 'cabinet',
                'is_verified' => false,
                'is_active' => true,
                'validation_status' => 'approved',
                'specialties' => [$anxiete?->id, $confiance?->id],
            ],
        ];

        foreach ($professionals as $data) {
            $specialties = $data['specialties'] ?? [];
            unset($data['specialties']);

            $professional = Professional::updateOrCreate(
                ['email' => $data['email']],
                $data
            );

            if (!empty($specialties)) {
                $professional->specialties()->sync(array_filter($specialties));
            }
        }
    }
}
