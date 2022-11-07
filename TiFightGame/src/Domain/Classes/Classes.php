<?php
require_once('src/Domain/Classes/Warrior.php');
require_once('src/Domain/Classes/Striker.php');
require_once('src/Domain/Classes/Knight.php');
require_once('src/Domain/Classes/Wizard.php');
class Classes
{
    public string $name = '';
    public float $health = 100;
    public float $damage = 2;
    public float $armor = 0;
    public float $mana = 5;
    public float $attack_speed = 3;

    protected Weapon $weapon;

    public function attack($enemy)
    {
        if (isset($weapon) && !($this->weapon instanceof Weapon)) {
            echo "Tu ne peux pas attaquer " . $enemy->getName() . "<br/>";
        } else if (!isset($this->weapon)) {
            echo $this->getName() . " donne un coup de poing à " . $enemy->getName() . "<br/>";
            $enemy->takeDamage($this->getPlayerDamage());
        } else if (isset($this->weapon) && (!$this->weapon instanceof MagicWand)) {
            echo $this->getName() . " attaque " . $enemy->getName() . " avec " . $this->weapon->getName() . "<br/>";
            $enemy->takeDamage($this->getPlayerDamage());
        } else if ($this->weapon instanceof MagicWand) {
            $this->magicAttack($enemy);
        }
        if (rand(1, 100) <= $this->getPlayerAttackSpeed()) {
            if (!$this->weapon instanceof MagicWand) {
                echo $this->getName() . " réattaque directement " . $enemy->getName() . " grâce à sa vitesse d'attaque ! <br/>";
                $enemy->takeDamage($this->getPlayerDamage());
            }
            if ($this->weapon instanceof MagicWand) {
                echo $this->getName() . " relance un sort directement sur " . $enemy->getName() . " grâce à sa vitesse d'attaque ! <br/>";
                $this->magicAttack($enemy);
            }
        };
    }

    public function takeDamage($damage)
    {
        $chance_block = rand(0, 5);
        $actualhealth = $this->health;
        $health = $this->health;
        $damagereceived = ($damage - $this->armor);
        $health -= $damagereceived;

        if ($health <= 0) {
            $this->health = 0;
            echo $this->getName() . " est mort ! <br/>";
        } else if (isset($this->shield) && ($chance_block === 1)) {
            $this->getBlockAttack();
        } else {
            $this->health = $health;
            echo $this->getName() . " reçoit " . $damagereceived . " de dégats ! ($actualhealth Points de vie - $damagereceived dégats reçus) <br/>";
            echo $this->getName() . " a survécu à l'attaque <br/>";
            echo "Il lui reste " . $this->health . " point(s) de vie<br/>";
        }
    }

    public function getPlayerDamage()
    {
        if ((isset($this->weapon)) && ($this->weapon instanceof Weapon)) {
            return $this->damage + $this->weapon->getDamage();
        } else {
            return $this->damage;
        }
    }

    public function getBlockAttack()
    {
        echo $this->getName() . " pare l'attaque grâce à son bouclier !<br/>";
    }

    public function getPlayerAttackSpeed()
    {
        return $this->attack_speed + $this->weapon->getAttackSpeed();
    }
    public function magicAttack($enemy)
    {
        $mana = $this->mana;

        if ($mana >= 25) {
            echo $this->getName() . " lance un sort sur " . $enemy->getName() . "<br/>";
            $enemy->takeDamage(rand(15, 25));
            $this->mana -= 10;
        } else {
            echo $this->getName() . " tente d'attaquer mais est à cours de mana. Impossible de lancer un sort <br/>";
        }
        $this->regenMana();
    }
    public function regenMana()
    {
        $regenManaAmount = rand(1, 10);
        $mana = $this->mana;
        $this->mana += $regenManaAmount;
        echo "" . $this->getName() . " récupère $regenManaAmount de mana. Mana total = " . $this->mana . " <br/>";
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function isAlive()
    {
        return ($this->health > 0);
    }
}
