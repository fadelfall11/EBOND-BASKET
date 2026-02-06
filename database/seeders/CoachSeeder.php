<?php

namespace Database\Seeders;

use App\Models\Coach;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coach::where('nom', 'Ndiaye')->where('prenom', 'Alione')->update(['prenom' => 'Alioune']);
        Coach::where('nom', 'Sene')->where('prenom', 'Awa')->update(['nom' => 'Séne']);

        $coaches = [
            [
                'nom' => 'Ndiaye',
                'prenom' => 'Alioune',
                'specialite' => 'Entraînement offensif',
                'experience' => 12,
                'bio' => 'Coach expérimenté spécialisé dans le développement des techniques offensives et le perfectionnement des jeunes talents.'
            ],
            [
                'nom' => 'Ndiaye',
                'prenom' => 'Thiendou',
                'specialite' => 'Défense et stratégie',
                'experience' => 10,
                'bio' => 'Expert en défense individuelle et collective, passionné par la formation tactique et le développement du basketball.'
            ],
            [
                'nom' => 'Séne',
                'prenom' => 'Awa',
                'specialite' => 'Formation jeunes',
                'experience' => 8,
                'bio' => 'Coach dédiée à la formation des jeunes talents avec une approche pédagogique unique et bienveillante.'
            ]
        ];

        foreach ($coaches as $coach) {
            Coach::updateOrCreate(
                ['nom' => $coach['nom'], 'prenom' => $coach['prenom']],
                $coach
            );
        }
    }
}
