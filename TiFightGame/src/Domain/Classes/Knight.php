<?php
require_once('Classes.php');

class Knight extends Classes
{
    public function __construct(string $name, $weapon = null, $shield = null)
    {
        $this->name = $name;
        $this->damage = $this->damage = 2;
        $this->armor = $this->armor = 6;
        if ($weapon != null) {
            $this->weapon = $weapon;
        }
        if ($shield != null) {
            $this->shield = $shield;
        }
    }
}
