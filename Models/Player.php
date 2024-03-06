<?php

namespace Rpg\Models;
use Rpg\Models\Ennemys\Ennemy;

abstract class Player extends State {
    public int $xp;

    public function __construct(string $name, int $healthMax, int $manaMax, int $level, int $xp, int $gold, int $defense, int $damage) {
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

    public function levelup() {
        $this->level++;
        $this->xp = 0;
    }
    public function basicAttack(State $target): void {
        $damageDealt = max(0, $this->damage - $target->defense);
        $target->health -= $damageDealt;
        $target->health = max(0, $target->health);
    }
    abstract public function specialAttack(Ennemy $enemy): void;
}
