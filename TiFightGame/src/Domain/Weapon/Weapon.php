<?php
require_once('src/Domain/Classes/Classes.php');
require_once('src/Domain/Weapon/Sword.php');
require_once('src/Domain/Weapon/Shield.php');
require_once('src/Domain/Weapon/MagicWand.php');
class Weapon 
{
    public float $damage = 0;
    public float $durability = 100;
    public float $attack_speed = 0;
    public float $mana = 0;
    
    public function getName() {
        return $this->name;
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
}
