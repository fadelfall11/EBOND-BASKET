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
        $imageVictoireCadettes = $resolveImage(['victoire-des-cadettes-lors-de-la-finale-inter-ligue-contre-bambey', 'victoire-cadette', 'victoire-cadettes', 'cadettes-finale', 'finale-inter-ligue'], 2);

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
                'titre' => 'Victoire des Cadettes lors de la finale inter-ligue contre Bambey',
                'contenu' => '<p>Nos cadettes ont réalisé une performance exceptionnelle en remportant la <strong>finale inter-ligue</strong> face à l\'équipe de <strong>Bambey</strong>. Dans une rencontre intense et engagée, nos joueuses ont su faire preuve de caractère, de discipline et d\'un esprit d\'équipe remarquable.</p>

                <p>Dès l\'entame, le groupe a imposé son rythme grâce à une défense solide, une bonne circulation de balle et une grande combativité au rebond. Malgré plusieurs temps forts adverses, les cadettes ont gardé leur calme et ont su répondre dans les moments décisifs, avec des actions collectives bien construites et une réussite importante sur les phases de transition.</p>

                <p>Cette victoire vient récompenser des semaines de travail, d\'assiduité et de rigueur à l\'entraînement. Elle témoigne aussi de la progression du groupe et du sérieux de notre projet de formation.</p>

                <p>Félicitations à toutes les joueuses, au staff technique et aux supporters qui ont accompagné l\'équipe tout au long de la compétition. Nous continuons sur cette dynamique avec ambition et humilité.</p>',
                'image' => $imageVictoireCadettes?->getFilename() ? ('actualites/' . $imageVictoireCadettes->getFilename()) : null,
                'date_publication' => Carbon::now()->subWeeks(3),
                'auteur' => 'Service Communication'
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
