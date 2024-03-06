<?php

namespace Rpg\Models\Archetype;
use Rpg\Models\Ennemys\Ennemy;
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
    public function levelup(){
        parent::levelup();
        echo "je rajouter des truc ici";
    }

    public function specialAttack(Ennemy $enemy): void {
        $healingAmount = min($this->mana, 20); // Maximum of 20 health points restored
        $this->mana -= $healingAmount; // Spend mana
        $this->health += $healingAmount; // Restore health
        $this->health = min($this->health, $this->healthMax); // Cap health at max value
    }

}

?>