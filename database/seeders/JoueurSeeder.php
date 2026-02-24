<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Joueur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class JoueurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $minimesGarcons = Categorie::where('nom', 'Minimes')->where('genre', 'garcon')->firstOrFail();
        $cadetsGarcons = Categorie::where('nom', 'Cadets')->where('genre', 'garcon')->firstOrFail();
        $minimesFilles = Categorie::where('nom', 'Minimes Filles')->where('genre', 'fille')->firstOrFail();
        $cadettesFilles = Categorie::where('nom', 'Cadettes')->where('genre', 'fille')->firstOrFail();

        $normalize = static function (string $value): string {
            $value = mb_strtolower($value);
            $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value) ?: $value;
            $value = preg_replace('/[^a-z0-9]+/i', '-', $value);
            return trim((string) $value, '-');
        };

        $collapseRepeats = static function (string $value): string {
            return (string) preg_replace('/(.)\\1+/u', '$1', $value);
        };

        $photos = collect(File::files(public_path('images/joueurs')))
            ->sortBy(fn($file) => mb_strtolower($file->getFilename()))
            ->values();

        $photosByKey = $photos
            ->mapWithKeys(function ($file) use ($normalize) {
                $base = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                return [$normalize($base) => $file];
            });

        // Nettoyer les joueurs existants pour ces catégories pour éviter les doublons
        Joueur::whereIn('categorie_id', [
            $minimesGarcons->id,
            $cadetsGarcons->id,
            $minimesFilles->id,
            $cadettesFilles->id
        ])->delete();

        $joueurs = [
            // Cadets Garçons
            // cherif alwely diop,abdou samb,pape malick ngom,serigne saliou gueye,ablaye dione,assana ndiaye,pape,babacar ngingue
            ['prenom' => 'Cherif Alwely', 'nom' => 'Diop', 'poste' => 'Arrière', 'categorie_id' => $cadetsGarcons->id, 'numero' => 4, 'capitaine' => true, 'eloges' => 'Arrière complet, capable de défendre fort et de créer des solutions offensives.'],
            ['prenom' => 'Abdou', 'nom' => 'Samb', 'poste' => 'Ailier fort', 'categorie_id' => $cadetsGarcons->id, 'numero' => 5, 'capitaine' => false, 'eloges' => 'Puissant et combatif, il apporte de l\'impact au rebond et dans la raquette.'],
            ['prenom' => 'Serigne Saliou', 'nom' => 'Gueye', 'poste' => 'Pivot', 'categorie_id' => $cadetsGarcons->id, 'numero' => 7, 'capitaine' => false, 'eloges' => 'Présence intérieure, protège le cercle et sécurise les rebonds.'],
            ['prenom' => 'Ablaye', 'nom' => 'Dione', 'poste' => 'Meneur', 'categorie_id' => $cadetsGarcons->id, 'numero' => 8, 'capitaine' => false, 'eloges' => 'Meneur organisé, donne le tempo et met ses coéquipiers dans les meilleures positions.'],
            ['prenom' => 'Assana', 'nom' => 'Ndiaye', 'poste' => 'Meneur', 'categorie_id' => $cadetsGarcons->id, 'numero' => 9, 'capitaine' => false, 'eloges' => 'Meneur dynamique, bon défenseur sur la ligne arrière et très actif en transition.'],
            ['prenom' => 'Babacar', 'nom' => 'Ngingue', 'poste' => 'Ailier', 'categorie_id' => $cadetsGarcons->id, 'numero' => 11, 'capitaine' => false, 'eloges' => 'Ailier polyvalent, utile des deux côtés du terrain avec une bonne activité.'],

            // Minimes Garçons
            // papa idy omar sy,thierno konté,ousmane samb,serigne saliou,thierno,birahim diba,pape maguette,fallou
            ['prenom' => 'Papa Idy Omar', 'nom' => 'Sy', 'poste' => 'Pivot', 'categorie_id' => $minimesGarcons->id, 'numero' => 4, 'capitaine' => true, 'eloges' => 'Grand et solide, il sécurise la raquette et apporte une présence importante au rebond.'],
            ['prenom' => 'Thierno', 'nom' => 'Konté', 'poste' => 'Arrière', 'categorie_id' => $minimesGarcons->id, 'numero' => 5, 'capitaine' => false, 'eloges' => 'Shooter naturel avec une mécanique de tir fluide et une grande précision.'],
            ['prenom' => 'Ousmane', 'nom' => 'Samb', 'poste' => 'Meneur', 'categorie_id' => $minimesGarcons->id, 'numero' => 6, 'capitaine' => false, 'eloges' => 'Organise le jeu avec énergie et met du rythme en transition.'],
            ['prenom' => 'Serigne', 'nom' => 'Saliou', 'poste' => 'Ailier fort', 'categorie_id' => $minimesGarcons->id, 'numero' => 7, 'capitaine' => false, 'eloges' => 'Fort potentiel athlétique, très actif au rebond et en défense.'],
            ['prenom' => 'Birahim', 'nom' => 'Diba', 'poste' => 'Meneur', 'categorie_id' => $minimesGarcons->id, 'numero' => 9, 'capitaine' => false, 'eloges' => 'Meneur dynamique, capable d\'accélérer le jeu et de créer des décalages.'],
            ['prenom' => 'Pape', 'nom' => 'Maguette', 'poste' => 'Pivot', 'categorie_id' => $minimesGarcons->id, 'numero' => 10, 'capitaine' => false, 'eloges' => 'Présence intérieure fiable, bon finisseur près du cercle.'],

            // Minimes Filles
            // marta,bousso,thiendou2,nogaye,maman,fatima,yangane,oumou aw
            ['prenom' => 'Marta', 'nom' => 'Mendy', 'poste' => 'Meneuse', 'categorie_id' => $minimesFilles->id, 'numero' => 4, 'capitaine' => true, 'eloges' => 'Meneuse talentueuse avec une grande vision de jeu et un excellent dribble.'],
            ['prenom' => 'Bousso', 'nom' => 'Diop', 'poste' => 'Arrière', 'categorie_id' => $minimesFilles->id, 'numero' => 5, 'capitaine' => false, 'eloges' => 'Rapide et incisive, elle crée constamment le danger dans la défense adverse.'],
            ['prenom' => 'Thiendou', 'nom' => 'Ndiaye', 'poste' => 'Ailière', 'categorie_id' => $minimesFilles->id, 'numero' => 6, 'capitaine' => false, 'eloges' => 'Joueuse complète avec une bonne technique individuelle et un sens du collectif.'],
            ['prenom' => 'Nogaye', 'nom' => 'Ndiaye', 'poste' => 'Ailière forte', 'categorie_id' => $minimesFilles->id, 'numero' => 7, 'capitaine' => false, 'eloges' => 'Solide en défense et efficace au rebond, un pilier pour l\'équipe.'],
            ['prenom' => 'Maman', 'nom' => 'Diop', 'poste' => 'Meneuse', 'categorie_id' => $minimesFilles->id, 'numero' => 8, 'capitaine' => false, 'eloges' => 'Grande taille et bonne présence sous le panier, difficile à bouger.'],
            ['prenom' => 'Fatima', 'nom' => 'Sow', 'poste' => 'Arrière', 'categorie_id' => $minimesFilles->id, 'numero' => 9, 'capitaine' => false, 'eloges' => 'Très adroite à mi-distance et intelligente dans ses placements.'],
            ['prenom' => 'Yangane', 'nom' => 'Faye', 'poste' => 'Ailière', 'categorie_id' => $minimesFilles->id, 'numero' => 10, 'capitaine' => false, 'eloges' => 'Joueuse athlétique avec une grande endurance et une volonté de fer.'],
            ['prenom' => 'Oumou', 'nom' => 'Aw', 'poste' => 'Meneuse', 'categorie_id' => $minimesFilles->id, 'numero' => 11, 'capitaine' => false, 'eloges' => 'Excellente finisseuse près du cercle avec un bon sens du placement.'],

            // Cadettes Filles
            // yaye fatou dieng,aminata sarr,mamy sow,ndeye dieng,fayou dieng ,mame diarra diop,sally diome,mame fatou camara
            ['prenom' => 'Yaye Fatou', 'nom' => 'Dieng', 'poste' => 'Meneuse', 'categorie_id' => $cadettesFilles->id, 'numero' => 4, 'capitaine' => true, 'eloges' => 'Leader naturelle sur le terrain, organise le jeu avec calme et précision.'],
            ['prenom' => 'Aminata', 'nom' => 'Sarr', 'poste' => 'Arrière', 'categorie_id' => $cadettesFilles->id, 'numero' => 5, 'capitaine' => false, 'eloges' => 'Shooteuse d\'élite capable de faire basculer un match sur une série de tirs.'],
            ['prenom' => 'Mamy', 'nom' => 'Sow', 'poste' => 'Ailière', 'categorie_id' => $cadettesFilles->id, 'numero' => 6, 'capitaine' => false, 'eloges' => 'Ailière percutante avec un premier pas très rapide et une bonne finition.'],
            ['prenom' => 'Ndeye', 'nom' => 'Dieng', 'poste' => 'Ailière forte', 'categorie_id' => $cadettesFilles->id, 'numero' => 7, 'capitaine' => false, 'eloges' => 'Guerrière des parquets, excelle dans les tâches défensives et le rebond.'],
            ['prenom' => 'Fatou', 'nom' => 'Dieng', 'poste' => 'Pivot', 'categorie_id' => $cadettesFilles->id, 'numero' => 8, 'capitaine' => false, 'eloges' => 'Technique impeccable au poste bas, avec un excellent jeu de jambes.'],
            ['prenom' => 'Mame Diarra', 'nom' => 'Diop', 'poste' => 'Arrière', 'categorie_id' => $cadettesFilles->id, 'numero' => 9, 'capitaine' => false, 'eloges' => 'Joueuse intelligente qui anticipe bien les actions adverses.'],
            ['prenom' => 'Sally', 'nom' => 'Diome', 'poste' => 'Ailière', 'categorie_id' => $cadettesFilles->id, 'numero' => 10, 'capitaine' => false, 'eloges' => 'Polyvalente et régulière, elle apporte de la stabilité à l\'équipe.'],
            ['prenom' => 'Mame Fatou', 'nom' => 'Camara', 'poste' => 'Pivot', 'categorie_id' => $cadettesFilles->id, 'numero' => 11, 'capitaine' => false, 'eloges' => 'Force de la nature sous les panneaux, intimidatrice en défense.'],
        ];

        foreach ($joueurs as $index => $joueur) {
            $photoFile = null;

            $exactKey = $normalize($joueur['prenom'] . '-' . $joueur['nom']);
            $photoFile = $photosByKey->get($exactKey);

            if (!$photoFile) {
                $collapsedExactKey = $collapseRepeats($exactKey);
                $photoFile = $photosByKey->get($collapsedExactKey);
            }

            $searchNeedles = collect([
                $joueur['prenom'] . ' ' . $joueur['nom'],
                $joueur['nom'] . ' ' . $joueur['prenom'],
            ])
                ->map(fn($v) => $normalize($v))
                ->filter()
                ->values();

            if (!$photoFile) {
                foreach ($searchNeedles as $needle) {
                    $photoFile = $photosByKey->first(function ($file, $key) use ($needle) {
                        return $key === $needle || str_contains($key, $needle);
                    });

                    if ($photoFile) {
                        break;
                    }

                    $collapsedNeedle = $collapseRepeats($needle);
                    $photoFile = $photosByKey->first(function ($file, $key) use ($collapsedNeedle) {
                        return $key === $collapsedNeedle || str_contains($key, $collapsedNeedle);
                    });

                    if ($photoFile) {
                        break;
                    }
                }
            }

            if (!$photoFile) {
                $photoFile = $photos->get($index);
            }

            if ($photoFile?->getFilename()) {
                $joueur['photo'] = 'joueurs/' . $photoFile->getFilename();
            }

            Joueur::updateOrCreate(
                [
                    'categorie_id' => $joueur['categorie_id'],
                    'numero' => $joueur['numero'],
                ],
                $joueur
            );
        }
    }
}
