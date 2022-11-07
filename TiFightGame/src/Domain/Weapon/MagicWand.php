<?php
class MagicWand extends Weapon
{
    public function __construct()
    {
        $this->damage = $this->damage + 1;
        $this->attack_speed = $this->attack_speed - 1;
    }
}
