<?php
require_once('Weapon.php');
class Sword extends Weapon
{

    public function __construct($durability = 100)
    {
        $this->damage = $this->damage + 5;
        $this->durability = $durability;
        $this->weaponName = 'Épée';
        
    }
}