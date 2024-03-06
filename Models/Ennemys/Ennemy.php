<?php

namespace Rpg\Models\Ennemys;

use Rpg\Models\State;



abstract class Ennemy extends State {
    public function __construct(string $name, int $healthMax, int $manaMax, int $level, int $gold, int $defense, int $damage) {
        $this->name = $name;
        $this->health = $healthMax;
        $this->healthMax = $healthMax;
        $this->manaMax = $manaMax;
        $this->mana = $manaMax;
        $this->level = $level;
        $this->gold = $gold;
        $this->defense = $defense;
        $this->damage = $damage;
    }
    public function basicAttack(State $target): void {
        $damageDealt = max(0, $this->damage - $target->defense);
        $target->health -= $damageDealt;
        $target->health = max(0, $target->health);
    }
}


?>