<?php

namespace Database\Seeders;

use App\Models\Actualite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ActualiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actualites = [
            [
                'titre' => 'Tournoi de Basket Feu Bassirou Faye',
                'contenu' => '<p>Le Diamono Basket Club a l\'honneur de vous inviter à la 5e édition du Tournoi de Basket Feu Bassirou Faye.</p>
                
                <p>Cet événement majeur du calendrier sportif se déroulera du <strong>01 au 05 Avril 2026</strong> au Stade Ely Manel Fall de Diourbel. Une occasion exceptionnelle de célébrer le basketball et de rendre hommage à une figure emblématique de notre sport.</p>
                
                <p>Venez nombreux supporter les équipes et vivre des moments intenses de compétition et de partage. Que le meilleur gagne !</p>',
                'date_publication' => Carbon::now()->subDays(1),
                'auteur' => 'Comité d\'Organisation'
            ],
            [
                'titre' => 'Nouveau programme de développement pour les débutants',
                'contenu' => '<p>Nous sommes fiers d\'annoncer le lancement de notre nouveau programme de développement dédié aux jeunes joueurs de 6 à 9 ans. Ce programme, élaboré par notre coach Ibrahim Ba, vise à initier les enfants au basketball de manière ludique et éducative.</p>
                
                <p>Le programme se déroulera chaque mercredi et samedi de 15h à 17h dans nos installations modernes. Les enfants apprendront les bases du basketball tout en développant leur coordination, leur agilité et leur esprit d\'équipe.</p>
                
                <p>Les inscriptions sont déjà ouvertes et les premières séances commenceront le mois prochain. N\'hésitez pas à nous contacter pour plus d\'informations sur ce programme qui promet d\'être une excellente introduction au monde du basketball.</p>',
                'date_publication' => Carbon::now()->subWeek(),
                'auteur' => 'Service Communication'
            ],
            [
                'titre' => 'Inauguration de nos nouveaux terrains modernes',
                'contenu' => '<p>Nous sommes ravis d\'annoncer l\'inauguration officielle de nos nouveaux terrains de basketball équipés des dernières technologies. Ces installations de pointe comprennent deux terrains aux normes internationales, un système d\'éclairage LED et des gradins pour 500 spectateurs.</p>
                
                <p>La cérémonie d\'inauguration se déroulera le samedi prochain en présence des autorités locales, de parents d\'élèves et de partenaires de l\'école. Des démonstrations et des matchs d\'exhibition seront organisés pour marquer cet événement.</p>
                
                <p>Ces nouveaux terrains permettront à nos joueurs de s\'entraîner dans des conditions optimales et d\'accueillir des compétitions de haut niveau. Un grand merci à tous nos partenaires qui ont rendu ce projet possible.</p>',
                'date_publication' => Carbon::now()->subWeeks(3),
                'auteur' => 'Comité de Direction'
            ]
        ];

        foreach ($actualites as $actualite) {
            Actualite::create($actualite);
        }
    }
}
