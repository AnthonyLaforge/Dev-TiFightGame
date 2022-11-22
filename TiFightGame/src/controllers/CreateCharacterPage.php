<?php
require_once 'Controller.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CreateCharacterPage extends Controller
{
    protected User $user;

    public function __construct()
    {
        $this->user = new User;
    }

    protected string $view = "createcharacter.php";

    public function render()
    {

        try {
            if (!isset($_SESSION['characterCreation-classe']) && isset($_POST['class-select'])) {
                $this->setCharacterClasse();
            } elseif (!isset($_SESSION['characterCreation-weapon']) && isset($_POST['weapon-select'])) {
                $this->setCharacterWeapon();
            } elseif (!isset($_SESSION['characterCreation-name']) && isset($_POST['character-name'])) {
                $this->setCharacterName();
            } elseif ((isset($_SESSION['characterCreation-name']) && (isset($_SESSION['characterCreation-weapon'])) && (isset($_SESSION['characterCreation-classe'])))) {
                $this->createMyCharacter();
            }
        } catch (Exception $error) {
        };
        include('views/' . $this->view);
    }

    public function setCharacterClasse()
    {
        if (isset($_POST['class-select']) && $_POST['class-select'] != "") {

            $_SESSION['characterCreation-classe'] = $_POST['class-select'];
            header("Location: index.php?controller=createcharacter");
        } elseif ($_POST['class-select'] == "") {
            throw new Exception("Un problème est survenu en essayant de sélectionner la classe indiqué. Veuillez réessayer.");
            header("Location: index.php?controller=createcharacter");
        }
    }

    public function setCharacterWeapon()
    {
        if (isset($_POST['weapon-select'])) {
            if (isset($_POST['shield-select'])) {
                $_SESSION['characterCreation-shield'] = $_POST['shield-select'];
            }
            $_SESSION['characterCreation-weapon'] = $_POST['weapon-select'];
            header("Location: index.php?controller=createcharacter");
        } else {
            throw new Exception("Un problème est survenu en essayant de sélectionner l'arme indiqué. <br>Veuillez réessayer.");
            header("Location: index.php?controller=createcharacter");
        }
    }

    public function setCharacterName()
    {
        if (isset($_POST['character-name']) && (!$this->user->isCharacterNameExist($_POST['character-name']))) {
            $_SESSION['characterCreation-name'] = $_POST['character-name'];
            header("Location: index.php?controller=createcharacter");
        } else {
            throw new Exception("Un problème est survenu en essayant de sélectionner le nom du personnage, le nom est déja utilisé. <br>Veuillez réessayer.");
            header("Location: index.php?controller=createcharacter");
        }
    }

    public function createMyCharacter()
    {
        if (isset($_SESSION['characterCreation-classe']) && isset($_SESSION['characterCreation-weapon']) && isset($_SESSION['characterCreation-shield']) && isset($_SESSION['characterCreation-name'])) {
            $this->insertInCharacters($_SESSION['user']['id_user'], $_SESSION['user']['name'], $_SESSION['characterCreation-name'], $_SESSION['characterCreation-classe'], $_SESSION['characterCreation-weapon'], $_SESSION['characterCreation-shield']);
            unset($_SESSION['characterCreation-name']);
            unset($_SESSION['characterCreation-classe']);
            unset($_SESSION['characterCreation-weapon']);
            unset($_SESSION['characterCreation-shield']);
            header("Location: index.php?controller=mycharacters");
        } elseif (isset($_SESSION['characterCreation-classe']) && isset($_SESSION['characterCreation-weapon']) && !isset($_SESSION['characterCreation-shield']) && isset($_SESSION['characterCreation-name'])) {
            $this->insertInCharacters($_SESSION['user']['id_user'], $_SESSION['user']['name'], $_SESSION['characterCreation-name'], $_SESSION['characterCreation-classe'], $_SESSION['characterCreation-weapon'], 'null');
            unset($_SESSION['characterCreation-name']);
            unset($_SESSION['characterCreation-classe']);
            unset($_SESSION['characterCreation-weapon']);
            header("Location: index.php?controller=mycharacters");
        } else {
            throw new Exception("Un problème est survenu à la création de votre personnage. <br>Veuillez réessayer, si l'erreur persiste, contacter un administrateur.");
            header("Location: index.php?controller=mycharacters");
        }
    }

    public function insertInCharacters($id_user, $name_user, $name, $classe, $weapon, $shield)
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'INSERT INTO characters(id_user, name_user, name, classe, weapon, shield) VALUES (:id_user, :name_user, :name, :classe, :weapon, :shield)';
        $user = $db->prepare($sqlQuery);
        $user->execute(
            [
                'id_user' => $id_user,
                'name_user' => $name_user,
                'name' => $name,
                'classe' => $classe,
                'weapon' => $weapon,
                'shield' => $shield,
            ]
        );
    }
}
