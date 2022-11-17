<?php

/*spl_autoload_register(function ($class) {
    $base_path = "../Domain/";

    if(file_exists($base_path . "Classes/" . $class . ".php")) {
        include_once $base_path . "Classes/" . $class . ".php";
    } else if(file_exists($base_path . "Fight/" . $class . ".php")) {
        include_once $base_path . "Fight/" . $class . ".php";
    } else if(file_exists($base_path . "User/" . $class . ".php")) {
        include_once $base_path . "User/" . $class . ".php";
    } else if(file_exists($base_path . "Weapon/" . $class . ".php")) {
        include_once $base_path . "Weapon/" . $class . ".php";
    }
});*/
require_once('./src/Domain/Weapon/Sword.php');
require_once('./src/Domain/Shield/BasicShield.php');
require_once('./src/Domain/Weapon/MagicWand.php');
require_once('./src/Domain/Classes/Warrior.php');
require_once('./src/Domain/Classes/Knight.php');
require_once('./src/Domain/Classes/Wizard.php');
require_once('./src/Domain/Classes/Striker.php');
require_once('./src/Domain/User/User.php');
require_once('./src/DataBase.php');
require_once 'Controller.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class GamePage extends Controller
{
    protected string $view = 'game.php';
    protected DataBase $db;
    protected User $user;
    protected Classes $character;
    protected $playerCharacter;

    public function __construct()
    {
        $this->user = new User();
        $this->character = new Classes();
    }

    public function render()
    {

        try {
            if (!isset($mycharacters)) {
                $mycharacters = $this->getMyCharacter();
            }
            if (isset($_POST['character-select'])) {
                $characterselected = $this->setMyCharacter();
                $_SESSION['characterSelectedId'] = $characterselected['id_character'];
            }
            if (!isset($myopponents) && isset($characterselected)) {
                $myopponents = $this->getMyOpponent();
            }
            if (isset($_POST['opponent-select'])) {
                $opponentselected = $this->setMyOpponent();
                $_SESSION['opponentSelectedId'] = $opponentselected['id_character'];
            }
            if (isset($_SESSION['characterSelectedId'])) {
                $playerCharacter = $this->getCharacterStats($_SESSION['characterSelectedId']);
            }
            if (isset($_SESSION['opponentSelectedId'])) {
                $opponentCharacter = $this->getCharacterStats($_SESSION['opponentSelectedId']);
            }
        } catch (Exception $error) {
        };
        include('views/' . $this->view);
    }


    public function getMyCharacter()
    {
        $mycharacters = $this->user->getCharacter();
        return $mycharacters;
    }


    public function setMyCharacter()
    {
        $db = DataBase::getInstance();
        if ((isset($_POST["character-select"]))) {
            $sqlQuery = 'SELECT id_character, id_user, name_user, name, classe, weapon, shield FROM characters WHERE id_user =:id_user AND name =:name';
            $character = $db->prepare($sqlQuery);
            $character->execute(
                [
                    'id_user' => $_SESSION['user']['id_user'],
                    'name' =>  $_POST['character-select'],
                ]
            );
            $characterselected = $character->fetch(PDO::FETCH_ASSOC);
            if (!empty($characterselected)) {
                return $characterselected;
            } else {
                throw new Exception("Une erreur s'est produite lors de la sélection de votre personnage");
            }
        }
    }

    public function getMyOpponent()
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT id_character, id_user, name_user, name, classe, weapon, shield FROM characters WHERE id_user !=:id_user';
        $myopponent = $db->prepare($sqlQuery);
        $myopponent->execute(
            [
                'id_user' => $_SESSION['user']['id_user'],
            ]
        );
        $myopponents = $myopponent->fetchALL(PDO::FETCH_ASSOC);
        if (!empty($myopponents)) {
            return $myopponents;
        } else {
            throw new Exception("Une erreur s'est produite lors du chargement de vos potentiels adversaires");
        }
    }


    public function setMyOpponent()
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT id_character, id_user, name_user, name, classe, weapon, shield FROM characters WHERE name =:name';
        $opponent = $db->prepare($sqlQuery);
        $opponent->execute(
            [
                'name' =>  $_POST['opponent-select'],
            ]
        );
        $opponentselected = $opponent->fetch(PDO::FETCH_ASSOC);
        if (!empty($opponentselected)) {
            return $opponentselected;
        } else {
            throw new Exception("Une erreur s'est produite lors de la sélection de votre adversaire");
        }
    }
    public function getCharacterStats($id)
    {
        $character = $this->character->loadClasse($id);
        return $character;
        //$character_id;

        /*$class = Classes::load($character_id);
    
        $class->getPlayerDamage();
        $class->getweapon()->getname();*/

        // $_SESSION['characterSelectedId'];
    }
    public function displayCharacterStats($id)
    {
        $charactersStats = $this->getCharacterStats($id);

        echo "Nom: " . $charactersStats->getName() . "</br>";
        echo "Classe: " . $charactersStats->getClassName() . "</br>";
        echo "Arme: " . $charactersStats->getWeaponName() . "</br>";
        echo "Bouclier: " . $charactersStats->getShieldName() . "</br>";
        echo "Dégats: " . $charactersStats->getPlayerDamage() . "</br>";
        echo "Vitesse d'attaque: " . $charactersStats->getPlayerAttackSpeed() . "</br>";
        echo "Points de vie: " . $charactersStats->getHealth() . "</br>";
        echo "Points d'armure: " . $charactersStats->getArmor() . "</br>";
        echo "Points de mana: " . $charactersStats->getMana() . "</br></br>";
    }
}

  



// function getCharacterStats()
// {
//     //$character_id;

//     /*$class = Classes::load($character_id);

//     $class->getPlayerDamage();
//     $class->getweapon()->getname();*/


//     var_dump($_SESSION['user']['character-use-stats']);
//     echo "Nom: " . $_SESSION['user']['character-use']['name'] . "</br>";
//     echo "Classe: " . $_SESSION['user']['character-use']['classe'] . "</br>";
//     echo "Arme: " . $_SESSION['user']['character-use']['weapon'] . "</br>";
//     echo "Dégats: " . $_SESSION['user']['character-use-stats']->getPlayerDamage() . "</br>";
//     echo "Vitesse d'attaque: " . $_SESSION['user']['character-use-stats']->getPlayerAttackSpeed() . "</br>";
//     echo "Points de vie: " . $_SESSION['user']['character-use-stats']->getHealth() . "</br>";
//     echo "Points d'armure: " . $_SESSION['user']['character-use-stats']->getArmor() . "</br>";
//     echo "Points de mana: " . $_SESSION['user']['character-use-stats']->getMana() . "</br>";
// }

// #SELECTION DU PERSONNAGE ADVERSAIRE
// if (isset($_SESSION['user']['character-use']) && (isset($_GET['fight'])) && (isset($_POST["opponent-select"]))) {
//     if ($_POST["opponent-select"] == "") {
//         echo "L'adversaire n'existe pas/plus";
//     } else {
//         $sqlQuery = 'SELECT id_user, name_user, name, classe, weapon, shield FROM characters WHERE name =:name';
//         $opponent = dbConnect()->prepare($sqlQuery);
//         $opponent->execute(
//             [
//                 'name' =>  $_POST['opponent-select'],
//             ]
//         );
//         $opponentselected = $opponent->fetch(PDO::FETCH_ASSOC);
//         $_SESSION['opponent-selected'] = $opponentselected;

//         #OPPONENT 
//         if ($_SESSION['opponent-selected']['shield'] == 'null' && ($_SESSION['opponent-selected']['weapon'] == 'Aucune')) {
//             $opponent = new $_SESSION['opponent-selected']['classe']($_SESSION['opponent-selected']['name']);
//         } elseif ($_SESSION['opponent-selected']['shield'] == 'null' && ($_SESSION['opponent-selected']['weapon'] != 'Aucune')) {
//             $opponentWeapon = new $_SESSION['opponent-selected']['weapon']();
//             $opponent = new $_SESSION['opponent-selected']['classe']($_SESSION['opponent-selected']['name'], $opponentWeapon);
//         } elseif ($_SESSION['opponent-selected']['shield'] != 'null' && ($_SESSION['opponent-selected']['weapon'] != 'Aucune')) {
//             $opponentWeapon = new $_SESSION['opponent-selected']['weapon']();
//             $opponentShield = new $_SESSION['opponent-selected']['shield']();
//             $opponent = new $_SESSION['opponent-selected']['classe']($_SESSION['opponent-selected']['name'], $opponentWeapon, $opponentShield);
//         }

//         #PLAYER
//         if ($_SESSION['user']['character-use']['shield'] == 'null' && ($_SESSION['user']['character-use']['weapon'] == 'Aucune')) {
//             $player = new $_SESSION['user']['character-use']['classe']($_SESSION['user']['character-use']['name']);
//         } elseif ($_SESSION['user']['character-use']['shield'] == 'null' && ($_SESSION['user']['character-use']['weapon'] != 'Aucune')) {
//             $playerWeapon = new $_SESSION['user']['character-use']['weapon']();
//             $player = new $_SESSION['user']['character-use']['classe']($_SESSION['user']['character-use']['name'], $playerWeapon);
//         } elseif ($_SESSION['user']['character-use']['shield'] != 'null' && ($_SESSION['user']['character-use']['weapon'] != 'Aucune')) {
//             $playerWeapon = new $_SESSION['user']['character-use']['weapon']();
//             $playerShield = new $_SESSION['user']['character-use']['shield']();
//             $player = new $_SESSION['user']['character-use']['classe']($_SESSION['user']['character-use']['name'], $playerWeapon, $playerShield);
//         }
//         $combat = new Fight;

        /*
        $combat = new Fight();
        $combat->setCombattant1($classe1);
        $combat->setCombattant2($classe2);

        $combat->start();
        */
//     }
// }


# SELECTION DU PERSONNAGE JOUEUR
// if ((isset($_POST["character-select"]))) {
//     $sqlQuery = 'SELECT id_user, name_user, name, classe, weapon, shield FROM characters WHERE id_user =:id_user AND name =:name';
//     $character = dbConnect()->prepare($sqlQuery);
//     $character->execute(
//         [
//             'id_user' => $_SESSION['user']['id_user'],
//             'name' =>  $_POST['character-select'],
//         ]
//     );
//     $characterselected = $character->fetch(PDO::FETCH_ASSOC);
//     $_SESSION['user']['character-use'] = $characterselected;
//     require('./index.php');
// } else {
//     require('./views/game.php');
//     // require('./index.php');
// }
