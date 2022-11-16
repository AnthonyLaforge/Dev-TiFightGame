<?php
class Weapon 
{
    public float $damage = 0;
    public float $durability = 100;
    public float $attack_speed = 0;
    public float $mana = 0;
    public string $weaponName;
    
    public function __construct()
    {
        $this->weaponName = 'Aucune';
    }

    public function getDamage() {
        return $this->damage;
    }

    public function getAttackSpeed(){
        return $this->attack_speed;
    }
    
    public function getMana()
    {
        return $this->mana;
    }
    public function getWeaponName()
    {
        return $this->weaponName;
    }
}
