<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'author_name' => 'Marie L.',
                'author_role' => 'Maman de 2 enfants',
                'content' => 'Grace a cet annuaire, nous avons trouve une psychologue specialisee qui a vraiment compris la situation de notre fils. Apres des mois de recherche infructueuse, nous avons enfin pu obtenir un accompagnement adapte.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'author_name' => 'Pierre D.',
                'author_role' => 'Papa',
                'content' => 'Le coach scolaire que nous avons contacte via Cap Toi M\'aime a fait des merveilles avec notre fille. Elle reprend confiance peu a peu et commence a envisager le retour a l\'ecole.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'author_name' => 'Sophie M.',
                'author_role' => 'Maman',
                'content' => 'Enfin un annuaire qui regroupe des professionnels vraiment formes a la phobie scolaire. On ne perd plus de temps avec des therapeutes qui ne comprennent pas cette problematique.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'author_name' => 'Jean-Marc R.',
                'author_role' => 'Parent',
                'content' => 'Tres utile pour trouver un professionnel pres de chez nous. Le pedopsychiatre recommande a ete d\'une grande aide pour notre famille.',
                'rating' => 4,
                'is_approved' => true,
            ],
            [
                'author_name' => 'Nathalie B.',
                'author_role' => 'Maman de 3 enfants',
                'content' => 'Apres avoir essaye plusieurs therapeutes sans succes, nous avons enfin trouve le bon accompagnement grace a cet annuaire. Notre fils va beaucoup mieux.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'author_name' => 'Laurent P.',
                'author_role' => 'Papa',
                'content' => 'Le therapeute familial trouve via Cap Toi M\'aime nous a permis de mieux comprendre la situation et d\'aider notre enfant ensemble, en famille.',
                'rating' => 5,
                'is_approved' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
