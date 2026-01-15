<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'mentions-legales',
                'title' => 'Mentions légales',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Mentions légales', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p><strong>Éditeur du site</strong><br>Association Cap Toi M\'aime<br>Suisse</p><p><strong>Hébergement</strong><br>Laravel Forge / DigitalOcean</p><p><strong>Contact</strong><br>contact@captoimaime.ch</p>'],
                    ],
                ],
                'meta' => ['description' => 'Mentions légales du site Cap Toi M\'aime'],
                'is_active' => true,
            ],
            [
                'slug' => 'politique-confidentialite',
                'title' => 'Politique de confidentialité',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Politique de confidentialité', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>La protection de vos données personnelles est importante pour nous. Cette politique explique comment nous collectons, utilisons et protégeons vos informations.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Données collectées', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Nous collectons uniquement les données nécessaires au fonctionnement de nos services :</p><ul><li>Informations de compte (nom, email)</li><li>Données de navigation (cookies techniques)</li><li>Messages envoyés via le formulaire de contact</li></ul>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Utilisation des données', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Vos données sont utilisées pour :</p><ul><li>Gérer votre compte membre</li><li>Vous mettre en relation avec des professionnels</li><li>Améliorer nos services</li><li>Vous informer des événements de l\'association</li></ul>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Vos droits', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Conformément au RGPD et à la LPD suisse, vous disposez des droits suivants :</p><ul><li>Droit d\'accès à vos données</li><li>Droit de rectification</li><li>Droit à l\'effacement</li><li>Droit à la portabilité</li></ul><p>Pour exercer ces droits, contactez-nous à : contact@captoimaime.ch</p>'],
                    ],
                ],
                'meta' => ['description' => 'Politique de confidentialité et protection des données de Cap Toi M\'aime'],
                'is_active' => true,
            ],
            [
                'slug' => 'conditions-utilisation',
                'title' => 'Conditions d\'utilisation',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Conditions générales d\'utilisation', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>En utilisant ce site, vous acceptez les présentes conditions d\'utilisation.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Objet du site', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Cap Toi M\'aime est une plateforme qui met en relation les familles confrontées au refus scolaire anxieux avec des professionnels spécialisés.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Responsabilité', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>L\'association Cap Toi M\'aime vérifie les informations fournies par les professionnels mais ne peut garantir l\'exhaustivité ou l\'exactitude de toutes les informations. Le choix d\'un professionnel reste de la responsabilité de l\'utilisateur.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Propriété intellectuelle', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Tous les contenus présents sur ce site (textes, images, logos) sont la propriété de l\'association Cap Toi M\'aime ou de leurs auteurs respectifs et sont protégés par le droit d\'auteur.</p>'],
                    ],
                ],
                'meta' => ['description' => 'Conditions générales d\'utilisation du site Cap Toi M\'aime'],
                'is_active' => true,
            ],
            [
                'slug' => 'a-propos',
                'title' => 'À propos',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'À propos de Cap Toi M\'aime', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p><strong>Cap Toi M\'aime</strong> est une association suisse dédiée à l\'accompagnement des familles confrontées au refus scolaire anxieux (phobie scolaire).</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Notre mission', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Nous croyons qu\'aucune famille ne devrait se sentir seule face au refus scolaire anxieux. Notre mission est de :</p><ul><li>Informer et sensibiliser sur le refus scolaire anxieux</li><li>Accompagner les familles dans leur parcours</li><li>Mettre en relation avec des professionnels spécialisés</li><li>Créer une communauté d\'entraide</li></ul>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'L\'annuaire', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Notre annuaire regroupe des professionnels de santé et de l\'accompagnement spécialisés dans le refus scolaire anxieux en Suisse romande. Chaque professionnel est vérifié par notre équipe.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Nous contacter', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Pour toute question, n\'hésitez pas à nous contacter via notre <a href="/contact">formulaire de contact</a> ou par email à contact@captoimaime.ch</p>'],
                    ],
                ],
                'meta' => ['description' => 'Découvrez Cap Toi M\'aime, association suisse d\'accompagnement des familles face au refus scolaire anxieux'],
                'is_active' => true,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}
