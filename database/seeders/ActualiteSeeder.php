<?php

namespace Database\Seeders;

use App\Models\Actualite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class ActualiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $normalize = static function (string $value): string {
            $value = mb_strtolower($value);
            $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value) ?: $value;
            $value = preg_replace('/[^a-z0-9]+/i', '-', $value);
            return trim((string) $value, '-');
        };

        $images = collect(File::files(public_path('images/actualites')))
            ->sortBy(fn($file) => mb_strtolower($file->getFilename()))
            ->values();

        $imagesByKey = $images
            ->mapWithKeys(function ($file) use ($normalize) {
                $base = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                return [$normalize($base) => $file];
            });

        $resolveImage = function (array $candidateKeys, int $fallbackIndex) use ($imagesByKey, $images, $normalize) {
            foreach ($candidateKeys as $key) {
                $key = $normalize($key);
                $file = $imagesByKey->get($key);
                if ($file) {
                    return $file;
                }

                $file = $imagesByKey->first(function ($file, $storedKey) use ($key) {
                    return $storedKey === $key || str_contains($storedKey, $key) || str_contains($key, $storedKey);
                });
                if ($file) {
                    return $file;
                }
            }

            return $images->get($fallbackIndex);
        };

        $imageTournoi = $resolveImage(['tournoi-de-basket-feu-bassirou-faye', 'tournoi-bassirou-faye', 'bassirou-faye'], 0);
        $imageProgramme = $resolveImage(['nouveau-programme-de-developpement-pour-les-debutants', 'programme-developpement-debutants', 'programme-developpement'], 1);
        $imageTerrains = $resolveImage(['inauguration-de-nos-nouveaux-terrains-modernes', 'inauguration-nouveaux-terrains', 'nouveaux-terrains'], 2);

        $actualites = [
            [
                'titre' => 'Tournoi de Basket Feu Bassirou Faye',
                'contenu' => '<p>Le Diamono Basket Club a l\'honneur de vous inviter à la 5e édition du Tournoi de Basket Feu Bassirou Faye.</p>
                
                <p>Cet événement majeur du calendrier sportif se déroulera du <strong>01 au 05 Avril 2026</strong> au Stade Ely Manel Fall de Diourbel. Une occasion exceptionnelle de célébrer le basketball et de rendre hommage à une figure emblématique de notre sport.</p>
                
                <p>Venez nombreux supporter les équipes et vivre des moments intenses de compétition et de partage. Que le meilleur gagne !</p>',
                'image' => $imageTournoi?->getFilename() ? ('actualites/' . $imageTournoi->getFilename()) : null,
                'date_publication' => Carbon::now()->subDays(1),
                'auteur' => 'Comité d\'Organisation'
            ],
            [
                'titre' => 'Nouveau programme de développement pour les débutants',
                'contenu' => '<p>Nous sommes fiers d\'annoncer le lancement de notre nouveau programme de développement dédié aux jeunes joueurs de 6 à 9 ans. Ce programme, élaboré par notre coach Ibrahim Ba, vise à initier les enfants au basketball de manière ludique et éducative.</p>
                
                <p>Le programme se déroulera chaque mercredi et samedi de 15h à 17h dans nos installations modernes. Les enfants apprendront les bases du basketball tout en développant leur coordination, leur agilité et leur esprit d\'équipe.</p>
                
                <p>Les inscriptions sont déjà ouvertes et les premières séances commenceront le mois prochain. N\'hésitez pas à nous contacter pour plus d\'informations sur ce programme qui promet d\'être une excellente introduction au monde du basketball.</p>',
                'image' => $imageProgramme?->getFilename() ? ('actualites/' . $imageProgramme->getFilename()) : null,
                'date_publication' => Carbon::now()->subWeek(),
                'auteur' => 'Service Communication'
            ],
            [
                'titre' => 'Inauguration de nos nouveaux terrains modernes',
                'contenu' => '<p>Nous sommes ravis d\'annoncer l\'inauguration officielle de nos nouveaux terrains de basketball équipés des dernières technologies. Ces installations de pointe comprennent deux terrains aux normes internationales, un système d\'éclairage LED et des gradins pour 500 spectateurs.</p>
                
                <p>La cérémonie d\'inauguration se déroulera le samedi prochain en présence des autorités locales, de parents d\'élèves et de partenaires de l\'école. Des démonstrations et des matchs d\'exhibition seront organisés pour marquer cet événement.</p>
                
                <p>Ces nouveaux terrains permettront à nos joueurs de s\'entraîner dans des conditions optimales et d\'accueillir des compétitions de haut niveau. Un grand merci à tous nos partenaires qui ont rendu ce projet possible.</p>',
                'image' => $imageTerrains?->getFilename() ? ('actualites/' . $imageTerrains->getFilename()) : null,
                'date_publication' => Carbon::now()->subWeeks(3),
                'auteur' => 'Comité de Direction'
            ]
        ];

        foreach ($actualites as $actualite) {
            Actualite::updateOrCreate(
                ['titre' => $actualite['titre']],
                $actualite
            );
        }
    }
}
