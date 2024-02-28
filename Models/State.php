<?php

namespace Rpg\Models;

abstract class State {
    public string $name;
    public int $health;
    public int $healthMax;
    public int $defense;
    public int $manaPool;
    public int $mana;
    public int $level;
    public int $gold;
    public int $damage;
}
?>