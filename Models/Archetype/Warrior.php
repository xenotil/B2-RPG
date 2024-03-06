<?php

namespace Rpg\Models\Archetype;
use Rpg\Models\Ennemys\Ennemy;
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
    public function levelup(){
        parent::levelup();
        $this->damage += 2;
        $this->defense ++;
        $this->healthMax += 10;
        $this->health +=5;
    }
    
    public function specialAttack(Ennemy $enemy): void {
        $this->damage *= 2; // Increase damage by 50%
    }
}
?>