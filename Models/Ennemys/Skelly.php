<?php

namespace Rpg\Models\Ennemys;

use Rpg\Models\Ennemys\Ennemy;



class Skelly extends Ennemy {
    public function __construct(int $level){
        parent::__construct(
            "Le Skelly",//Nom du Monstre
            3+5*$level,// Nombre de Pv
            5+2*$level,// Nombre de mana
            $level,//level
            (random_int(0,5))*$level,// Nombre de piece d'or
            1*$level-2,// Def
            6*$level,// Dpt
        );
    }
}