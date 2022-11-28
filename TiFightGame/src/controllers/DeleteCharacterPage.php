<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

class DeleteCharacterPage extends Controller
{

  protected string $view = "deletecharacter.php";
  protected DataBase $db;
  protected User $user;
  protected GamePage $character;

  public function __construct()
  {
    $this->user = new User;
    $this->character = new GamePage;
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
      if (isset($_SESSION['characterSelectedId']) && (isset($_POST["deletecharacter"]))) {
        $this->deleteCharacter($_SESSION['characterSelectedId']);
        unset($_SESSION['characterSelectedId']);
        $mycharacters = $this->getMyCharacter();
        if (empty($mycharacters)) {
          header('Location: mycharacters');
        }
      }
      if (isset($_SESSION['characterSelectedId']) && (isset($_POST["keepcharacter"]))) {
        unset($_SESSION['characterSelectedId']);
      }
    } catch (Exception $error) {
    };
    include('views/' . $this->view);
  }

  public function deleteCharacter($characterselected)
  {
    $db = DataBase::getInstance();
    $sqlQuery = 'DELETE FROM characters WHERE id_character =:id_character AND id_user =:id_user';
    $deletecharacter = $db->prepare($sqlQuery);
    $deletecharacter->execute(
      [
        'id_character' => $characterselected,
        'id_user' =>  $_SESSION['user']['id_user'],
      ]
    );
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
}
