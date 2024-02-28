<?php

namespace Rpg\Models;

use Rpg\Models\State;

abstract class Player extends State {
    public int $xp;
    public function __construct(string $name, int $healthMax, int $manaMax, int $level, int $xp, int $gold, int $defense, int $damage){
        $this->name = $name;
        $this->health = $healthMax;
        $this->healthMax = $healthMax;
        $this->mana = $manaMax;
        $this->manaPool = $manaMax;
        $this->level = $level;
        $this->xp = $xp;
        $this->gold = $gold;
        $this->defense = $defense;
        $this->damage = $damage;
    }
    public function levelup(){
        $level = $level + 1;
        $xp = 0;
        return;
    }
    public function BasicAttack(Player $ennemy){
        $damage = max(1, $this->damage - $ennemy->defense);
        $ennemy->health -= $damage;
    }

    abstract public function specialAttack(Player $ennemy): void;
}

?>