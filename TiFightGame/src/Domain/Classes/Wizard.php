<?php
require_once('/laragon/www/TiFightGame/src/Domain/Classes/Classes.php');
class Wizard extends Classes
{
    public function __construct(string $name, $weapon = "Aucune")
    {
        $this->name = $name;
        if ($weapon != "Aucune") {
            $this->weapon = $weapon;
        }
        $this->mana = $this->mana + 50;
        $this->attack_speed = $this->attack_speed - 1;
        $this->class = 'Sorcier';
    }
}
