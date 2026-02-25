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
        Actualite::where('titre', 'Nouveau programme de développement pour les débutants')->delete();

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
        $imageVictoireCadettes = $resolveImage(['victoire-des-cadettes-lors-de-la-finale-inter-ligue-contre-bambey', 'victoire-cadette', 'victoire-cadettes', 'cadettes-finale', 'finale-inter-ligue'], 2);
        $imageFinaleU18 = $resolveImage(['final-de-nos-u18', 'finale-de-nos-u18', 'finale-u18', 'u18-finale'], 3);

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
                'titre' => 'Victoire des Cadettes lors de la finale inter-ligue contre Bambey',
                'contenu' => '<p>Nos cadettes ont réalisé une performance exceptionnelle en remportant la <strong>finale inter-ligue</strong> face à l\'équipe de <strong>Bambey</strong>. Dans une rencontre intense et engagée, nos joueuses ont su faire preuve de caractère, de discipline et d\'un esprit d\'équipe remarquable.</p>

                <p>Dès l\'entame, le groupe a imposé son rythme grâce à une défense solide, une bonne circulation de balle et une grande combativité au rebond. Malgré plusieurs temps forts adverses, les cadettes ont gardé leur calme et ont su répondre dans les moments décisifs, avec des actions collectives bien construites et une réussite importante sur les phases de transition.</p>

                <p>Cette victoire vient récompenser des semaines de travail, d\'assiduité et de rigueur à l\'entraînement. Elle témoigne aussi de la progression du groupe et du sérieux de notre projet de formation.</p>

                <p>Félicitations à toutes les joueuses, au staff technique et aux supporters qui ont accompagné l\'équipe tout au long de la compétition. Nous continuons sur cette dynamique avec ambition et humilité.</p>',
                'image' => $imageVictoireCadettes?->getFilename() ? ('actualites/' . $imageVictoireCadettes->getFilename()) : null,
                'date_publication' => Carbon::now()->subWeeks(3),
                'auteur' => 'Service Communication'
            ],
            [
                'titre' => 'En finale de nos U18 sous le coaching de Alioune Ndiaye',
                'contenu' => '<p>Nos U18 ont porté haut les couleurs d\'EBOND en atteignant la <strong>finale</strong> sous le coaching du coach <strong>Alioune Ndiaye</strong>, face à une belle équipe de <strong>Thiès</strong>.</p>

                <p>Même si le score final n\'a pas été en notre faveur, nous retenons l\'essentiel : un groupe uni, du courage, de la discipline et une progression remarquable tout au long de la compétition.</p>

                <p>Cette finale est une étape importante dans notre projet de formation. Elle montre que nos jeunes talents travaillent avec sérieux, apprennent vite et représentent dignement le basket diourbelois.</p>

                <p style="margin-top: 1rem; font-weight: 800; color: #1e40af;">Baol Baol we are</p>',
                'image' => $imageFinaleU18?->getFilename() ? ('actualites/' . $imageFinaleU18->getFilename()) : null,
                'date_publication' => Carbon::now()->subDays(10),
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
