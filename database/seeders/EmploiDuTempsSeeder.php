<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\EmploiDuTemps;
use Illuminate\Database\Seeder;

class EmploiDuTempsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $minimesGarcons = Categorie::where('nom', 'Minimes')->where('genre', 'garcon')->firstOrFail();
        $cadetsGarcons = Categorie::where('nom', 'Cadets')->where('genre', 'garcon')->firstOrFail();

        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

        foreach ($jours as $jour) {
            EmploiDuTemps::updateOrCreate(
                [
                    'categorie_id' => $minimesGarcons->id,
                    'jour' => $jour,
                    'heure_debut' => '16:30',
                    'heure_fin' => '18:30',
                ],
                [
                    'categorie_id' => $minimesGarcons->id,
                    'jour' => $jour,
                    'heure_debut' => '16:30',
                    'heure_fin' => '18:30',
                    'lieu' => 'Terrain principal',
                    'description' => 'Entraînement technique + coordination + jeu collectif.',
                ]
            );

            EmploiDuTemps::updateOrCreate(
                [
                    'categorie_id' => $cadetsGarcons->id,
                    'jour' => $jour,
                    'heure_debut' => '18:00',
                    'heure_fin' => '20:00',
                ],
                [
                    'categorie_id' => $cadetsGarcons->id,
                    'jour' => $jour,
                    'heure_debut' => '18:00',
                    'heure_fin' => '20:00',
                    'lieu' => 'Terrain principal',
                    'description' => 'Séance tactique + systèmes + match d\'application.',
                ]
            );
        }
    }
}
