<?php
require_once('/laragon/www/TiFightGame/src/Domain/Classes/Classes.php');
require_once('/laragon/www/TiFightGame/src/Domain/Shield/Shield.php');
class Knight extends Classes
{
    public function __construct(string $name, $weapon = "Aucune", $shield = "Aucun")
    {
        $this->name = $name;
        $this->damage = $this->damage + 2;
        $this->armor = $this->armor + 6;
        $this->class = 'Chevalier';
        if ($weapon != "Aucune") {
            $this->weapon = $weapon;
        }
        if ($shield != "Aucun") {
            $this->shield = $shield;
        }
    }
}
