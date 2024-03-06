<?php

namespace Rpg\Models\Ennemys;

use Rpg\Models\Ennemys\Ennemy;



class Boss extends Ennemy {
    public function __construct(int $level){
        $noms = [
            'Alduien',
            'Bob Lennon',
            'XENOmorph',
        ];
        parent::__construct(
            $noms[random_int(0,2)],//Nom du Monstre
            30+5*$level,// Nombre de Pv
            30+2*$level,// Nombre de mana
            $level,//level
            (random_int(0,5))*$level,// Nombre de piece d'or
            1*$level,// Def
            5*$level,// Dpt
        );
    }
}