<?php

namespace Database\Seeders;

use App\Models\Coach;
use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

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

        $normalize = static function (string $value): string {
            $value = mb_strtolower($value);
            $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value) ?: $value;
            $value = preg_replace('/[^a-z0-9]+/i', '-', $value);
            return trim((string) $value, '-');
        };

        $photos = collect(File::files(public_path('images/categories')))
            ->sortBy(fn($file) => mb_strtolower($file->getFilename()))
            ->values();

        $photosByKey = $photos
            ->mapWithKeys(function ($file) use ($normalize) {
                $base = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                return [$normalize($base) => $file];
            });

        $resolvePhoto = function (array $candidateKeys, int $fallbackIndex) use ($photosByKey, $photos, $normalize) {
            foreach ($candidateKeys as $key) {
                $key = $normalize($key);
                $file = $photosByKey->get($key);
                if ($file) {
                    return $file;
                }

                $file = $photosByKey->first(function ($file, $storedKey) use ($key) {
                    return $storedKey === $key || str_contains($storedKey, $key) || str_contains($key, $storedKey);
                });
                if ($file) {
                    return $file;
                }
            }

            return $photos->get($fallbackIndex);
        };

        Categorie::where('nom', 'Seniors')->delete();

        $photoMinimesGarcon = $resolvePhoto(['minime-garcon', 'minimes-garcon', 'minimes-garcons', 'minimes garcon'], 0);
        $photoCadetsGarcon = $resolvePhoto(['cadets', 'cadet', 'cadets-garcon', 'cadet-garcon'], 1);
        $photoMinimesFille = $resolvePhoto(['minime-fille', 'minimes-fille', 'minimes-filles', 'minimes filles'], 2);
        $photoCadettesFille = $resolvePhoto(['cadette', 'cadettes', 'cadettes-fille', 'cadette-fille'], 3);

        $categories = [
            [
                'nom' => 'Minimes',
                'genre' => 'garcon',
                'age_min' => 10,
                'age_max' => 13,
                'coach_id' => $coachThiendou->id,
                'photo' => $photoMinimesGarcon?->getFilename() ? ('categories/' . $photoMinimesGarcon->getFilename()) : null,
                'description' => 'Développement des techniques fondamentales et compréhension tactique du jeu. Préparation aux compétitions régionales avec accent sur le perfectionnement individuel.'
            ],
            [
                'nom' => 'Cadets',
                'genre' => 'garcon',
                'age_min' => 14,
                'age_max' => 17,
                'coach_id' => $coachThiendou->id,
                'photo' => $photoCadetsGarcon?->getFilename() ? ('categories/' . $photoCadetsGarcon->getFilename()) : null,
                'description' => 'Formation avancée avec préparation aux compétitions nationales. Travail sur la condition physique, les stratégies complexes et le leadership.'
            ],
            [
                'nom' => 'Minimes Filles',
                'genre' => 'fille',
                'age_min' => 10,
                'age_max' => 13,
                'coach_id' => $coachAwa->id,
                'photo' => $photoMinimesFille?->getFilename() ? ('categories/' . $photoMinimesFille->getFilename()) : null,
                'description' => 'Développement des compétences techniques et tactiques pour les jeunes joueuses. Préparation aux tournois féminins avec accent sur le jeu collectif.'
            ],
            [
                'nom' => 'Cadettes',
                'genre' => 'fille',
                'age_min' => 14,
                'age_max' => 17,
                'coach_id' => $coachAwa->id,
                'photo' => $photoCadettesFille?->getFilename() ? ('categories/' . $photoCadettesFille->getFilename()) : null,
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
