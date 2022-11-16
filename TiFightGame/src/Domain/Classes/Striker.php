<?php
require_once('/laragon/www/TiFightGame/src/Domain/Classes/Classes.php');
class Striker extends Classes
{
    public function __construct(string $name, $weapon = null)
    {   
        $this->name = $name;
        if (!isset($weapon)){  #If the play has weapon, he deal less dmg
            $this->damage = $this->damage + 10;
            $this->health = $this->health + 30;
        } else {
            $this->weapon = $weapon;
        }
        $this->class = 'Percuteur';
    }
}