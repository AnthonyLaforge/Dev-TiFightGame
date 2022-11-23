<?php
require_once('/laragon/www/TiFightGame/src/Domain/Classes/Classes.php');
class Warrior extends Classes
{
    public function __construct(string $name, $weapon = "Aucune")
    {
        $this->name = $name;
        $this->health = $this->health + 20;
        $this->damage = $this->damage + 5;
        if ($weapon != "Aucune") {
            $this->weapon = $weapon;
        }
        $this->class = 'Combattant';
    }
}
