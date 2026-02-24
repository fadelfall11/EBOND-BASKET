<?php

namespace Database\Seeders;

use App\Models\Coach;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coach::where('nom', 'Ndiaye')->where('prenom', 'Alione')->update(['prenom' => 'Alioune']);
        Coach::where('nom', 'Sene')->where('prenom', 'Awa')->update(['nom' => 'Séne']);

        $normalize = static function (string $value): string {
            $value = mb_strtolower($value);
            $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value) ?: $value;
            $value = preg_replace('/[^a-z0-9]+/i', '-', $value);
            return trim((string) $value, '-');
        };

        $photos = collect(File::files(public_path('images/coaches')))
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

        $photoAlioune = $resolvePhoto(['alioune-ndiaye', 'alioune ndiaye', 'ndiaye-alioune'], 0);
        $photoThiendou = $resolvePhoto(['thiendou-ndiaye', 'thiendou ndiaye', 'ndiaye-thiendou'], 1);
        $photoAwa = $resolvePhoto(['awa-sene', 'awa séne', 'awa sene', 'sene-awa', 'séne-awa'], 2);

        $coaches = [
            [
                'nom' => 'Ndiaye',
                'prenom' => 'Alioune',
                'specialite' => 'Entraînement offensif',
                'experience' => 12,
                'photo' => $photoAlioune?->getFilename() ? ('coaches/' . $photoAlioune->getFilename()) : null,
                'bio' => 'Coach expérimenté spécialisé dans le développement des techniques offensives et le perfectionnement des jeunes talents.'
            ],
            [
                'nom' => 'Ndiaye',
                'prenom' => 'Thiendou',
                'specialite' => 'Défense et stratégie',
                'experience' => 10,
                'photo' => $photoThiendou?->getFilename() ? ('coaches/' . $photoThiendou->getFilename()) : null,
                'bio' => 'Expert en défense individuelle et collective, passionné par la formation tactique et le développement du basketball.'
            ],
            [
                'nom' => 'Séne',
                'prenom' => 'Awa',
                'specialite' => 'Formation jeunes',
                'experience' => 8,
                'photo' => $photoAwa?->getFilename() ? ('coaches/' . $photoAwa->getFilename()) : null,
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
