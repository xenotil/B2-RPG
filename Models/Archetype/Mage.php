<?php

namespace Rpg\Models\Archetype;
use Rpg\Models\Ennemys\Ennemy;
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
    public function levelup(){
        parent::levelup();
        $this->manaMax += 5;
        $this->mana += 2;
        $this->damage += 2;
        $this->defense ++;
        $this->healthMax += 5;
        $this->health +=2;
    }
    // Mage.php
    public function specialAttack(Ennemy $enemy): void {
        $this->mana += 10; // Vol de mana à l'ennemi
        $enemy->mana = max(0, $enemy->mana - 10); // Reduce enemy's mana by 10
    }
}

?>