<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            // =============================================
            // PAGES PRINCIPALES DU SITE
            // =============================================
            [
                'slug' => 'accueil',
                'title' => 'Accueil',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Trouvez le bon professionnel pour votre enfant', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Cap Toi M\'aime vous accompagne dans la recherche de professionnels spécialisés dans le refus scolaire anxieux en Suisse romande.</p>'],
                    ],
                ],
                'meta' => ['description' => 'Annuaire des professionnels spécialisés dans le refus scolaire anxieux en Suisse romande'],
                'is_active' => true,
            ],
            [
                'slug' => 'comment-ca-marche',
                'title' => 'Comment ça marche',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Comment ça marche ?', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => '1. Répondez au questionnaire', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Notre questionnaire guidé vous aide à identifier vos besoins spécifiques : situation de votre enfant, localisation, préférences de consultation.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => '2. Découvrez les professionnels recommandés', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>En fonction de vos réponses, nous vous proposons une sélection de professionnels adaptés à votre situation, avec un score de compatibilité.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => '3. Prenez contact', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Consultez les profils détaillés et contactez directement le professionnel de votre choix.</p>'],
                    ],
                ],
                'meta' => ['description' => 'Découvrez comment trouver un professionnel spécialisé dans le refus scolaire anxieux avec Cap Toi M\'aime'],
                'is_active' => true,
            ],
            [
                'slug' => 'association',
                'title' => 'L\'association',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'L\'association Cap Toi M\'aime', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p><strong>Cap Toi M\'aime</strong> est une association suisse à but non lucratif, créée par des parents confrontés au refus scolaire anxieux de leurs enfants.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Notre histoire', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Face au manque de ressources et à l\'isolement des familles, nous avons décidé de créer un réseau d\'entraide et de partage d\'expériences.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Nos actions', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<ul><li>Groupes de parole pour les parents</li><li>Annuaire de professionnels vérifiés</li><li>Événements et conférences</li><li>Sensibilisation auprès des écoles</li></ul>'],
                    ],
                ],
                'meta' => ['description' => 'Découvrez l\'association Cap Toi M\'aime, son histoire et ses actions pour accompagner les familles'],
                'is_active' => true,
            ],
            [
                'slug' => 'devenir-membre',
                'title' => 'Devenir membre',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Rejoignez Cap Toi M\'aime', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>En devenant membre, vous soutenez notre mission et bénéficiez d\'avantages exclusifs.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Avantages membres', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<ul><li>Accès complet à l\'annuaire des professionnels</li><li>Participation aux groupes de parole</li><li>Tarifs réduits sur les événements</li><li>Newsletter mensuelle</li><li>Soutien d\'une communauté bienveillante</li></ul>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Cotisations', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<ul><li><strong>Membre individuel :</strong> CHF 50.- / an</li><li><strong>Membre famille :</strong> CHF 80.- / an</li><li><strong>Professionnel :</strong> Gratuit</li></ul>'],
                    ],
                ],
                'meta' => ['description' => 'Devenez membre de Cap Toi M\'aime et rejoignez notre communauté'],
                'is_active' => true,
            ],
            [
                'slug' => 'espace-professionnels',
                'title' => 'Espace professionnels',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Espace professionnels', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Vous êtes un professionnel de santé spécialisé dans l\'accompagnement du refus scolaire anxieux ? Rejoignez notre annuaire !</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Pourquoi nous rejoindre ?', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<ul><li><strong>Visibilité :</strong> Soyez visible auprès des familles qui cherchent de l\'aide</li><li><strong>Gratuit :</strong> L\'inscription et la présence dans l\'annuaire sont entièrement gratuites</li><li><strong>Qualité :</strong> Faites partie d\'un réseau de professionnels vérifiés</li><li><strong>Communauté :</strong> Participez à nos événements et échanges entre professionnels</li></ul>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Comment s\'inscrire ?', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<ol><li>Remplissez le formulaire d\'inscription</li><li>Fournissez vos diplômes et certifications</li><li>Notre équipe vérifie votre profil sous 48h</li><li>Votre profil est publié dans l\'annuaire</li></ol>'],
                    ],
                ],
                'meta' => ['description' => 'Professionnels : rejoignez l\'annuaire Cap Toi M\'aime gratuitement'],
                'is_active' => true,
            ],
            [
                'slug' => 'refus-scolaire-anxieux',
                'title' => 'Le refus scolaire anxieux',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Comprendre le refus scolaire anxieux', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Le refus scolaire anxieux, aussi appelé phobie scolaire, touche environ 1 à 5% des enfants scolarisés. Ce n\'est ni un caprice, ni de la paresse : c\'est une vraie souffrance.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Qu\'est-ce que c\'est ?', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Le refus scolaire anxieux se caractérise par une incapacité de l\'enfant ou de l\'adolescent à se rendre à l\'école, liée à une anxiété intense. Cette anxiété peut se manifester par :</p><ul><li>Symptômes physiques (maux de ventre, nausées, maux de tête)</li><li>Crises d\'angoisse ou de panique</li><li>Troubles du sommeil</li><li>Isolement social</li></ul>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Les causes possibles', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Les origines peuvent être multiples :</p><ul><li>Anxiété de séparation</li><li>Harcèlement scolaire</li><li>Troubles de l\'apprentissage (DYS, TDA/H, HPI)</li><li>Phobie sociale</li><li>Événement traumatisant</li><li>Dépression</li></ul>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Comment agir ?', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>La prise en charge doit être <strong>rapide</strong> et <strong>adaptée</strong>. Plus l\'intervention est précoce, meilleures sont les chances de réussite. N\'hésitez pas à consulter un professionnel spécialisé.</p>'],
                    ],
                ],
                'meta' => ['description' => 'Tout savoir sur le refus scolaire anxieux (phobie scolaire) : symptômes, causes et solutions'],
                'is_active' => true,
            ],
            [
                'slug' => 'ressources',
                'title' => 'Ressources',
                'content' => [
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Ressources utiles', 'level' => 'h1'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<p>Retrouvez ici des ressources pour mieux comprendre et accompagner le refus scolaire anxieux.</p>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Livres recommandés', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<ul><li>"Phobie scolaire : comment aider les enfants et adolescents en mal d\'école" - Marie-France Le Heuzey</li><li>"Mon enfant ne veut plus aller à l\'école" - Marie Gilbert</li></ul>'],
                    ],
                    [
                        'type' => 'heading',
                        'data' => ['content' => 'Liens utiles', 'level' => 'h2'],
                    ],
                    [
                        'type' => 'paragraph',
                        'data' => ['content' => '<ul><li>Association Phobie Scolaire France</li><li>Pro Juventute Suisse</li><li>Santépsy.ch</li></ul>'],
                    ],
                ],
                'meta' => ['description' => 'Ressources et lectures recommandées sur le refus scolaire anxieux'],
                'is_active' => true,
            ],

            // =============================================
            // PAGES LÉGALES
            // =============================================
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
