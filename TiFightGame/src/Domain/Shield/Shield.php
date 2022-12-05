<?php
class Shield
{
    public string $shieldName;
    public float $armor = 0;
    public float $durability = 100;

    public function getShieldName()
    {
        return $this->shieldName;
    }

    public function getShieldArmor() 
    {
        return $this->armor;
    }
}
