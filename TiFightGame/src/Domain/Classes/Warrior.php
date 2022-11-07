<?php

require_once('Classes.php');
class Warrior extends Classes
{
    public function __construct(string $name, $weapon = null)
    {
        $this->name = $name;
        $this->health = $this->health + 20;
        $this->damage = $this->damage + 5;
        if ($weapon != null) {
            $this->weapon = $weapon;
        };
    }
}

