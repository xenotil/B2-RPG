<?php

namespace Rpg\Models\Ennemys;

use Rpg\Models\State;



abstract class Ennemy extends State {
    public function __construct(string $name, int $healthMax, int $manaMax, int $level, int $gold, int $defense, int $damage) {
        $this->name = $name;
        $this->health = $healthMax;
        $this->healthMax = $healthMax;
        $this->manaPool = $manaMax;
        $this->mana = $manaMax;
        $this->level = $level;
        $this->gold = $gold;
        $this->defense = $defense;
        $this->damage = $damage;
    }
}


?>