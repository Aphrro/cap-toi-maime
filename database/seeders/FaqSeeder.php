<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Parents FAQs
            [
                'category' => 'parents',
                'question' => 'Comment accéder à l\'annuaire des professionnels ?',
                'answer' => 'L\'annuaire est réservé aux membres de l\'association Cap Toi M\'aime. Pour y accéder, vous devez d\'abord adhérer à l\'association. Une fois membre, vous pourrez consulter tous les profils des professionnels vérifiés.',
                'order' => 1,
            ],
            [
                'category' => 'parents',
                'question' => 'Comment fonctionne le questionnaire de matching ?',
                'answer' => 'Notre questionnaire analyse votre situation familiale (âge de l\'enfant, symptômes, localisation, préférences) pour vous recommander les professionnels les plus adaptés. Un score de compatibilité vous aide à faire votre choix.',
                'order' => 2,
            ],
            [
                'category' => 'parents',
                'question' => 'Les professionnels sont-ils vérifiés ?',
                'answer' => 'Oui, chaque professionnel est vérifié par notre équipe avant d\'apparaître dans l\'annuaire. Nous contrôlons leurs diplômes et leur expérience dans le domaine du refus scolaire anxieux.',
                'order' => 3,
            ],
            // Pros FAQs
            [
                'category' => 'pros',
                'question' => 'L\'inscription est-elle payante ?',
                'answer' => 'Non, l\'inscription et la présence dans l\'annuaire sont entièrement gratuites. Notre mission est de faciliter l\'accès aux soins, pas de générer des revenus. Aucune commission n\'est prélevée sur les consultations.',
                'order' => 1,
            ],
            [
                'category' => 'pros',
                'question' => 'Combien de temps prend la validation ?',
                'answer' => 'Nous validons les profils sous 24 à 48 heures ouvrées. Vous recevrez un email de confirmation dès que votre profil sera approuvé et visible dans l\'annuaire.',
                'order' => 2,
            ],
            [
                'category' => 'pros',
                'question' => 'Quels documents dois-je fournir ?',
                'answer' => 'Pour la validation, nous demandons une copie de vos diplômes et éventuellement vos certifications complémentaires. Ces documents sont uniquement utilisés pour la vérification et ne sont pas publiés.',
                'order' => 3,
            ],
            // General FAQs
            [
                'category' => 'general',
                'question' => 'Qu\'est-ce que le refus scolaire anxieux ?',
                'answer' => 'Le refus scolaire anxieux (ou phobie scolaire) est un trouble caractérisé par une incapacité de l\'enfant à aller à l\'école due à une anxiété intense. Ce n\'est pas un caprice ni un simple refus : c\'est une vraie souffrance qui nécessite un accompagnement adapté.',
                'order' => 1,
            ],
            [
                'category' => 'general',
                'question' => 'Qu\'est-ce que Cap Toi M\'aime ?',
                'answer' => 'Cap Toi M\'aime est une association suisse qui accompagne les familles confrontées au refus scolaire anxieux. Nous proposons des groupes de parole, des événements, et cet annuaire de professionnels spécialisés.',
                'order' => 2,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                [
                    'category' => $faq['category'],
                    'answer' => $faq['answer'],
                    'order' => $faq['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
