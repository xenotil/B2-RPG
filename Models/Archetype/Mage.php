<?php

namespace Rpg\Models\Archetype;

use Rpg\Models\Player;

class Mage extends Player {
    public string $label = "Mage";
    public function __construct($nom){
        parent::__construct(
            $nom,//Nom du Monstre
            15,// Nombre de Pv
            35,// Nombre de mana
            1,//level
            0,//xp
            0,// Nombre de piece d'or
            1,// Def
            5,// Dpt
        );
    }
    public function specialAttack(Player $ennemy): void {
        $this->mana += 10; // Vol de mana à l'ennemi
        $ennemy->mana -= 10; // Perte de mana pour l'ennemi
    }
}

?>