<?php

namespace Rpg\Models\Ennemys;

use Rpg\Models\Ennemys\Ennemy;



class Goblin extends Ennemy {
    public function __construct(int $level){
        parent::__construct(
            "Le Goblin",//Nom du Monstre
            5+5*$level,// Nombre de Pv
            5+2*$level,// Nombre de mana
            $level,//level
            (random_int(0,5))*$level,// Nombre de piece d'or
            1*$level-1,// Def
            5*$level,// Dpt
        );
    }
}
