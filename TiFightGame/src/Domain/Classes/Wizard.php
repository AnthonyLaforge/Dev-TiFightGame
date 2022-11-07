<?php
require_once('Classes.php');
class Wizard extends Classes
{
    public function __construct(string $name,$weapon = null)
    {   
        $this->name = $name;
        $this->weapon = $weapon;
        $this->mana = $this->mana + 50;
        $this->attack_speed = $this->attack_speed - 1;
    }
}
