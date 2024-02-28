<?php

namespace Rpg\Models\Ennemys;

use Rpg\Models\Ennemys\Ennemy;
use Rpg\Models\Ennemys\Goblin;

class MonsterFactory{
    public function generatMonster(int $level):Ennemy {
        if($level < 3){
            $possibelMonster = [Goblin::class,skelly::class,Slime::class,];
            //choix au hasard
            $monster = $possibelMonster[random_int(0,2)];
            return new $monster($level);
        } else {
            return new Boss($level);  
        }
    }
}

?>