<?php

namespace Rpg\Models\Archetype;

use Rpg\Models\Player;

class Clerc extends Player {
    public string $label = "clerc";
    public function __construct($nom){
        parent::__construct(
            $nom,//Nom du Monstre
            20,// Nombre de Pv
            25,// Nombre de mana
            1,//level
            0,//xp
            0,// Nombre de piece d'or
            1,// Def
            5,// Dpt
        );
    }
    public function specialAttack(Player $ennemy): void {
        $healingAmount = min($this->mana, 20); // Le clerc peut restaurer jusqu'à 20 points de vie
        $this->mana -= $healingAmount; // Dépense de la mana
        $this->health += $healingAmount; // Restauration des points de vie
        $this->health = min($this->health, $this->healthMax); // Assurer que les points de vie ne dépassent pas le maximum
    }
}

?>