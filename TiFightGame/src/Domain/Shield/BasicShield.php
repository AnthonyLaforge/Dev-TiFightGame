<?php
require_once('Shield.php');
class BasicShield extends Shield
{

    public function __construct($durability = 100)
    {
        $this->armor = $this->armor + 2;
        $this->shieldName = 'Bouclier en bois';
        $this->durability = $durability;
        
    }
}