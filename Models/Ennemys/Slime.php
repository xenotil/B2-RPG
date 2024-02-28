<?php

namespace Rpg\Models\Ennemys;

use Rpg\Models\Ennemys\Ennemy;



class Slime extends Ennemy {
    public function __construct(int $level){
        parent::__construct(
            "Le Slime",//Nom du Monstre
            10+10*$level,// Nombre de Pv
            3+1*$level,// Nombre de mana
            $level,//level
            (random_int(0,5))*$level,// Nombre de piece d'or
            0,// Def
            5*$level,// Dpt
        );
    }
}