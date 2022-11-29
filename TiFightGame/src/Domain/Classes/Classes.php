<?php
class Classes
{
    public string $name = '';
    public string $class;
    public float $health = 100;
    public float $damage = 2;
    public float $armor = 0;
    public float $mana = 5;
    public float $attack_speed = 3;

    protected Weapon $weapon;
    protected Shield $shield;


    public function __construct()
    {
        $this->weapon = new Weapon;
        $this->shield = new Shield;
    }

    public function attack($enemy)
    {
        if (isset($weapon) && !($this->weapon instanceof Weapon)) {
            echo "Tu ne peux pas attaquer " . $enemy->getName() . "<br/>";
        } else if (!isset($this->weapon)) {
            echo $this->getName() . " donne un coup de poing à " . $enemy->getName() . "<br/>";
            $enemy->takeDamage($this->getPlayerDamage());
        } else if (isset($this->weapon) && (!$this->weapon instanceof MagicWand)) {
            echo $this->getName() . " attaque " . $enemy->getName() . "<br/>";
            $enemy->takeDamage($this->getPlayerDamage());
        } else if ($this->weapon instanceof MagicWand) {
            $this->magicAttack($enemy);
        }
        if (rand(1, 100) <= $this->getPlayerAttackSpeed()) {
            if (isset($this->weapon) && (!$this->weapon instanceof MagicWand)) {
                echo $this->getName() . " réattaque directement " . $enemy->getName() . " grâce à sa vitesse d'attaque ! <br/>";
                $enemy->takeDamage($this->getPlayerDamage());
            }
            if (isset($this->weapon) && ($this->weapon instanceof MagicWand)) {
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
        if (isset($this->weapon)  && ($this->weapon instanceof Weapon)) {
            return $this->attack_speed + $this->weapon->getAttackSpeed();
        } else {
            return $this->attack_speed;
        }
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

    public function getArmor()
    {
        // return $this->armor;

        if (isset($this->shield)  && ($this->shield instanceof Shield)) {
            return $this->armor + $this->shield->getShieldArmor();
        } else {
            return $this->armor;
        }
    }

    public function getMana()
    {
        return $this->mana;
    }

    public function getClassName()
    {
        return $this->class;
    }

    public function getWeaponName()
    {
        if (isset($this->weapon)) {
            return $this->weapon->getWeaponName();
        } else {
            return $this->weaponName = "Aucune";
        }
    }
    public function getShieldName()
    {
        if (isset($this->shield)) {
            return $this->shield->getShieldName();
        } else {
            return $this->shieldName = "Aucun";
        }
    }

    public function getSelectedCharacter($idCharacter)
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT id_user, name_user, name, classe, weapon, shield FROM `characters` WHERE id_character = :id_character';
        $character = $db->prepare($sqlQuery);
        $character->execute(
            [
                'id_character' => $idCharacter,
            ]
        );
        $characterStats = $character->fetch(PDO::FETCH_ASSOC);
        if (!empty($characterStats)) {
            return $characterStats;
        } else {
            return [];
        }
    }
    public function getWeapon($idCharacter)
    {
        $character = $this->getSelectedCharacter($idCharacter);
        if ($character['weapon'] == 'Épée') {
            $characterWeapon = new Sword();
            return $characterWeapon;
        } elseif ($character['weapon'] == 'Baguette basique') {
            $characterWeapon = new MagicWand();
            return $characterWeapon;
        } else {
            throw new Exception("Une erreur est survenue lors du chargement de votre arme");
        }
    }
    public function getShield($idCharacter)
    {
        $character = $this->getSelectedCharacter($idCharacter);
        if ($character['shield'] != "null") {
            $characterShield = new BasicShield();
            return $characterShield;
        }
    }

    public function getClasse($idCharacter)
    {
        $character = $this->getSelectedCharacter($idCharacter);
        if ($character['weapon'] != "Aucune") {
            if ($character['classe'] == 'Combattant') {
                $characterClasse = new Warrior($character['name'], $this->getWeapon($idCharacter));
                return $characterClasse;
            } elseif ($character['classe'] == 'Sorcier') {
                $characterClasse = new Wizard($character['name'], $this->getWeapon($idCharacter));
                return $characterClasse;
            } elseif ($character['classe'] == 'Chevalier') {
                $characterClasse = new Knight($character['name'], $this->getWeapon($idCharacter), $this->getShield($idCharacter));
                return $characterClasse;
            } elseif ($character['classe'] == 'Percuteur') {
                $characterClasse = new Striker($character['name'], $this->getWeapon($idCharacter));
                return $characterClasse;
            }
        }
        if ($character['weapon'] == "Aucune") {
            if ($character['classe'] == 'Combattant') {
                $characterClasse = new Warrior($character['name']);
                return $characterClasse;
            } elseif ($character['classe'] == 'Sorcier') {
                $characterClasse = new Wizard($character['name']);
                return $characterClasse;
            } elseif ($character['classe'] == 'Chevalier') {
                $characterClasse = new Knight($character['name']);
                return $characterClasse;
            } elseif ($character['classe'] == 'Percuteur') {
                $characterClasse = new Striker($character['name']);
                return $characterClasse;
            }
        }
    }

    public function getIdUserCharacter($characterName)
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT id_user, id_character  FROM `characters` WHERE name = :name';
        $characterId = $db->prepare($sqlQuery);
        $characterId->execute(
            [
                'name' => $characterName,
            ]
        );
        $IdUserCharacter = $characterId->fetch(PDO::FETCH_ASSOC);
        if (!empty($IdUserCharacter)) {
            return $IdUserCharacter;
        } else {
            return [];
        }
    }
    public static function unLoadClasse()
    {
        unset($_SESSION['characterSelectedId']);
        unset($_SESSION['opponentSelectedId']);
    }

    public static function isClassExist($class)
    {
        $existingClass = array(
            "Combattant",
            "Sorcier",
            "Percuteur",
            "Chevalier",
        );
        if (in_array($class, $existingClass)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isWeaponExist($weapon)
    {
        $existingWeapon = array(
            "Aucune",
            "Épée",
            "Baguette Basique",
        );
        if (in_array($weapon, $existingWeapon)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isShieldExist($shield)
    {
        $existingShield = array(
            "Bouclier en boid",
        );
        if (in_array($shield, $existingShield)) {
            return true;
        } else {
            return false;
        }
    }
}
