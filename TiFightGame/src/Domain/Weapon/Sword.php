<?php
require_once('src/Domain/Classes/Classes.php');
require_once('Weapon.php');
class Sword extends Weapon
{

    public function __construct(string $name,$durability = 100)
    {
        $this->name = $name;
        $this->damage = $this->damage + 5;
        $this->durability = $durability;
        
    }
}