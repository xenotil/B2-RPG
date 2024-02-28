<?php

namespace Rpg\Models\Archetype;

use Rpg\Models\Player;

class Warrior extends Player {
    public string $label = "Warrior";
    public function __construct($nom){
        parent::__construct(
            $nom,//Nom du Monstre
            30,// Nombre de Pv
            10,// Nombre de mana
            1,//level
            0,//xp
            0,// Nombre de piece d or
            2,// Def
            5,// Dpt
        );
    }
    public function specialAttack(Player $ennemy): void {
        $this->mana -= 5; // Dépense de la mana
        $this->defense *= 2; // Double la défense
    }
}

?>