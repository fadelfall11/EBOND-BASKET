<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Joueur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            ['prenom' => 'Cherif Alwely', 'nom' => 'Diop', 'poste' => 'Meneur', 'categorie_id' => $cadetsGarcons->id, 'numero' => 4, 'capitaine' => true, 'eloges' => 'Meneur visionnaire avec une excellente lecture du jeu et un leadership naturel.'],
            ['prenom' => 'Abdou', 'nom' => 'Samb', 'poste' => 'Arrière', 'categorie_id' => $cadetsGarcons->id, 'numero' => 5, 'capitaine' => false, 'eloges' => 'Arrière rapide et adroit, capable de percer les défenses adverses avec facilité.'],
            ['prenom' => 'Pape Malick', 'nom' => 'Ngom', 'poste' => 'Ailier', 'categorie_id' => $cadetsGarcons->id, 'numero' => 6, 'capitaine' => false, 'eloges' => 'Ailier polyvalent doté d\'une grande agilité et d\'un tir fiable à mi-distance.'],
            ['prenom' => 'Serigne Saliou', 'nom' => 'Gueye', 'poste' => 'Ailier fort', 'categorie_id' => $cadetsGarcons->id, 'numero' => 7, 'capitaine' => false, 'eloges' => 'Joueur physique et combatif, excellent rebondeur et défenseur tenace.'],
            ['prenom' => 'Ablaye', 'nom' => 'Dione', 'poste' => 'Pivot', 'categorie_id' => $cadetsGarcons->id, 'numero' => 8, 'capitaine' => false, 'eloges' => 'Pivot dominant dans la raquette, impérial au contre et solide au poste bas.'],
            ['prenom' => 'Assana', 'nom' => 'Ndiaye', 'poste' => 'Arrière', 'categorie_id' => $cadetsGarcons->id, 'numero' => 9, 'capitaine' => false, 'eloges' => 'Défenseur infatigable avec une grande intelligence de jeu et un esprit collectif.'],
            ['prenom' => 'Pape', 'nom' => 'Ndiaye', 'poste' => 'Ailier', 'categorie_id' => $cadetsGarcons->id, 'numero' => 10, 'capitaine' => false, 'eloges' => 'Joueur explosif avec une détente impressionnante et un sens du spectacle.'],
            ['prenom' => 'Babacar', 'nom' => 'Ngingue', 'poste' => 'Pivot', 'categorie_id' => $cadetsGarcons->id, 'numero' => 11, 'capitaine' => false, 'eloges' => 'Intérieur technique avec de bons mouvements et une présence rassurante sous le panier.'],

            // Minimes Garçons
            // papa idy omar sy,thierno konté,ousmane samb,serigne saliou,thierno,birahim diba,pape maguette,fallou
            ['prenom' => 'Papa Idy Omar', 'nom' => 'Sy', 'poste' => 'Meneur', 'categorie_id' => $minimesGarcons->id, 'numero' => 4, 'capitaine' => true, 'eloges' => 'Jeune meneur prometteur avec une excellente maîtrise du ballon et une grande vivacité.'],
            ['prenom' => 'Thierno', 'nom' => 'Konté', 'poste' => 'Arrière', 'categorie_id' => $minimesGarcons->id, 'numero' => 5, 'capitaine' => false, 'eloges' => 'Shooter naturel avec une mécanique de tir fluide et une grande précision.'],
            ['prenom' => 'Ousmane', 'nom' => 'Samb', 'poste' => 'Ailier', 'categorie_id' => $minimesGarcons->id, 'numero' => 6, 'capitaine' => false, 'eloges' => 'Joueur énergique qui apporte beaucoup d\'intensité et de dynamisme sur le terrain.'],
            ['prenom' => 'Serigne', 'nom' => 'Saliou', 'poste' => 'Ailier fort', 'categorie_id' => $minimesGarcons->id, 'numero' => 7, 'capitaine' => false, 'eloges' => 'Fort potentiel athlétique, très actif au rebond et en défense.'],
            ['prenom' => 'Thierno', 'nom' => 'Diallo', 'poste' => 'Arrière', 'categorie_id' => $minimesGarcons->id, 'numero' => 8, 'capitaine' => false, 'eloges' => 'Joueur rapide en contre-attaque et très adroit en pénétration.'],
            ['prenom' => 'Birahim', 'nom' => 'Diba', 'poste' => 'Pivot', 'categorie_id' => $minimesGarcons->id, 'numero' => 9, 'capitaine' => false, 'eloges' => 'Grand gabarit pour son âge, protecteur de cercle et bon finisseur.'],
            ['prenom' => 'Pape', 'nom' => 'Maguette', 'poste' => 'Ailier', 'categorie_id' => $minimesGarcons->id, 'numero' => 10, 'capitaine' => false, 'eloges' => 'Joueur polyvalent capable de jouer à plusieurs postes avec efficacité.'],
            ['prenom' => 'Fallou', 'nom' => 'Fall', 'poste' => 'Ailier fort', 'categorie_id' => $minimesGarcons->id, 'numero' => 11, 'capitaine' => false, 'eloges' => 'Combattant sur le terrain, ne lâche rien et motive ses coéquipiers.'],

            // Minimes Filles
            // marta,bousso,thiendou2,nogaye,maman,fatima,yangane,oumou aw
            ['prenom' => 'Marta', 'nom' => 'Gomis', 'poste' => 'Meneuse', 'categorie_id' => $minimesFilles->id, 'numero' => 4, 'capitaine' => true, 'eloges' => 'Meneuse talentueuse avec une grande vision de jeu et un excellent dribble.'],
            ['prenom' => 'Bousso', 'nom' => 'Diop', 'poste' => 'Arrière', 'categorie_id' => $minimesFilles->id, 'numero' => 5, 'capitaine' => false, 'eloges' => 'Rapide et incisive, elle crée constamment le danger dans la défense adverse.'],
            ['prenom' => 'Thiendou', 'nom' => 'Ndiaye', 'poste' => 'Ailière', 'categorie_id' => $minimesFilles->id, 'numero' => 6, 'capitaine' => false, 'eloges' => 'Joueuse complète avec une bonne technique individuelle et un sens du collectif.'],
            ['prenom' => 'Nogaye', 'nom' => 'Ndiaye', 'poste' => 'Ailière forte', 'categorie_id' => $minimesFilles->id, 'numero' => 7, 'capitaine' => false, 'eloges' => 'Solide en défense et efficace au rebond, un pilier pour l\'équipe.'],
            ['prenom' => 'Maman', 'nom' => 'Diop', 'poste' => 'Pivot', 'categorie_id' => $minimesFilles->id, 'numero' => 8, 'capitaine' => false, 'eloges' => 'Grande taille et bonne présence sous le panier, difficile à bouger.'],
            ['prenom' => 'Fatima', 'nom' => 'Sow', 'poste' => 'Arrière', 'categorie_id' => $minimesFilles->id, 'numero' => 9, 'capitaine' => false, 'eloges' => 'Très adroite à mi-distance et intelligente dans ses placements.'],
            ['prenom' => 'Yangane', 'nom' => 'Faye', 'poste' => 'Ailière', 'categorie_id' => $minimesFilles->id, 'numero' => 10, 'capitaine' => false, 'eloges' => 'Joueuse athlétique avec une grande endurance et une volonté de fer.'],
            ['prenom' => 'Oumou', 'nom' => 'Aw', 'poste' => 'Pivot', 'categorie_id' => $minimesFilles->id, 'numero' => 11, 'capitaine' => false, 'eloges' => 'Excellente finisseuse près du cercle avec un bon sens du placement.'],

            // Cadettes Filles
            // yaye fatou dieng,aminata sarr,mamy sow,ndeye dieng,fayou dieng ,mame diarra diop,sally diome,mame fatou camara
            ['prenom' => 'Yaye Fatou', 'nom' => 'Dieng', 'poste' => 'Meneuse', 'categorie_id' => $cadettesFilles->id, 'numero' => 4, 'capitaine' => true, 'eloges' => 'Leader naturelle sur le terrain, organise le jeu avec calme et précision.'],
            ['prenom' => 'Aminata', 'nom' => 'Sarr', 'poste' => 'Arrière', 'categorie_id' => $cadettesFilles->id, 'numero' => 5, 'capitaine' => false, 'eloges' => 'Shooteuse d\'élite capable de faire basculer un match sur une série de tirs.'],
            ['prenom' => 'Mamy', 'nom' => 'Sow', 'poste' => 'Ailière', 'categorie_id' => $cadettesFilles->id, 'numero' => 6, 'capitaine' => false, 'eloges' => 'Ailière percutante avec un premier pas très rapide et une bonne finition.'],
            ['prenom' => 'Ndeye', 'nom' => 'Dieng', 'poste' => 'Ailière forte', 'categorie_id' => $cadettesFilles->id, 'numero' => 7, 'capitaine' => false, 'eloges' => 'Guerrière des parquets, excelle dans les tâches défensives et le rebond.'],
            ['prenom' => 'Fayou', 'nom' => 'Dieng', 'poste' => 'Pivot', 'categorie_id' => $cadettesFilles->id, 'numero' => 8, 'capitaine' => false, 'eloges' => 'Technique impeccable au poste bas, avec un excellent jeu de jambes.'],
            ['prenom' => 'Mame Diarra', 'nom' => 'Diop', 'poste' => 'Arrière', 'categorie_id' => $cadettesFilles->id, 'numero' => 9, 'capitaine' => false, 'eloges' => 'Joueuse intelligente qui anticipe bien les actions adverses.'],
            ['prenom' => 'Sally', 'nom' => 'Diome', 'poste' => 'Ailière', 'categorie_id' => $cadettesFilles->id, 'numero' => 10, 'capitaine' => false, 'eloges' => 'Polyvalente et régulière, elle apporte de la stabilité à l\'équipe.'],
            ['prenom' => 'Mame Fatou', 'nom' => 'Camara', 'poste' => 'Pivot', 'categorie_id' => $cadettesFilles->id, 'numero' => 11, 'capitaine' => false, 'eloges' => 'Force de la nature sous les panneaux, intimidatrice en défense.'],
        ];

        foreach ($joueurs as $joueur) {
            Joueur::create($joueur);
        }
    }
}
