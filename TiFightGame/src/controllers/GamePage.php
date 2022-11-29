<?php
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
        } catch (CharactersError $error) {
            $myopponents = $this->getMyOpponent();
            $mycharacters = $this->getMyCharacter();
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
                throw new CharactersError("Une erreur s'est produite lors de la sélection de votre personnage");
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
            throw new CharactersError("Une erreur s'est produite lors du chargement de vos potentiels adversaires");
        }
    }


    public function setMyOpponent()
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT id_character, id_user, name_user, name, classe, weapon, shield FROM characters WHERE name =:name AND id_user !=:id_user';
        $opponent = $db->prepare($sqlQuery);
        $opponent->execute(
            [
                'name' =>  $_POST['opponent-select'],
                'id_user' => $_SESSION['user']['id_user'],
            ]
        );
        $opponentselected = $opponent->fetch(PDO::FETCH_ASSOC);
        if (!empty($opponentselected)) {
            return $opponentselected;
        } else {
            $myopponents = $this->getMyOpponent();
            throw new CharactersError("Une erreur s'est produite lors de la sélection de votre adversaire");
        }
    }
    public function getCharacterStats($id)
    {
        $character = $this->character->getClasse($id);
        return $character;
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

