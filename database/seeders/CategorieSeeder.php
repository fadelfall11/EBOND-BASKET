<?php

namespace Database\Seeders;

use App\Models\Coach;
use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coachAlioune = Coach::where('nom', 'Ndiaye')->where('prenom', 'Alioune')->firstOrFail();
        $coachThiendou = Coach::where('nom', 'Ndiaye')->where('prenom', 'Thiendou')->firstOrFail();
        $coachAwa = Coach::where('nom', 'Séne')->where('prenom', 'Awa')->firstOrFail();

        Categorie::where('nom', 'Seniors')->delete();

        $categories = [
            [
                'nom' => 'Minimes',
                'genre' => 'garcon',
                'age_min' => 10,
                'age_max' => 13,
                'coach_id' => $coachThiendou->id,
                'description' => 'Développement des techniques fondamentales et compréhension tactique du jeu. Préparation aux compétitions régionales avec accent sur le perfectionnement individuel.'
            ],
            [
                'nom' => 'Cadets',
                'genre' => 'garcon',
                'age_min' => 14,
                'age_max' => 17,
                'coach_id' => $coachThiendou->id,
                'description' => 'Formation avancée avec préparation aux compétitions nationales. Travail sur la condition physique, les stratégies complexes et le leadership.'
            ],
            [
                'nom' => 'Minimes Filles',
                'genre' => 'fille',
                'age_min' => 10,
                'age_max' => 13,
                'coach_id' => $coachAwa->id,
                'description' => 'Développement des compétences techniques et tactiques pour les jeunes joueuses. Préparation aux tournois féminins avec accent sur le jeu collectif.'
            ],
            [
                'nom' => 'Cadettes',
                'genre' => 'fille',
                'age_min' => 14,
                'age_max' => 17,
                'coach_id' => $coachAwa->id,
                'description' => 'Formation intensive pour les adolescentes talentueuses. Préparation aux sélections nationales et développement du leadership féminin.'
            ]
        ];

        foreach ($categories as $categorie) {
            Categorie::updateOrCreate(
                [
                    'nom' => $categorie['nom'],
                    'genre' => $categorie['genre'],
                    'age_min' => $categorie['age_min'],
                    'age_max' => $categorie['age_max'],
                ],
                $categorie
            );
        }
    }
}
