<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once('src/AutoLoad.php');
AutoLoad::autoLoader();

// require_once('/laragon/www/TiFightGame/src/Domain/Weapon/Sword.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Weapon/MagicWand.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Classes/Warrior.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Classes/Knight.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Classes/Wizard.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Classes/Striker.php');
// require_once('/laragon/www/TiFightGame/src/Domain/User/User.php');
// require_once('/laragon/www/TiFightGame/src/DataBase.php');
// require_once('src/controllers/HomePage.php');
// require_once('src/controllers/ConnexionPage.php');
// require_once('src/controllers/MyCharactersPage.php');
// require_once('src/controllers/CreateCharacterPage.php');
// require_once('src/controllers/DeleteCharacterPage.php');
// require_once('src/controllers/GamePage.php');
// require_once('src/controllers/FightPage.php');


$controller = new Controller();

$page = strtolower($_GET["controller"] ?? "");

switch ($page) {
  case 'home':
    $controller = new HomePage();
    break;
  case 'connexion':
    $controller = new ConnexionPage();
    break;
  case 'connexion&register':
    $controller = new ConnexionPage();
    break;
  case 'mycharacters':
    $controller = new MyCharactersPage();
    break;
  case 'createcharacter':
    $controller = new CreateCharacterPage();
    break;
  case 'deletecharacter':
    $controller = new DeleteCharacterPage();
    break;
  case 'game':
    $controller = new GamePage();
    break;
  case 'fight':
    $controller = new FightPage();
    break;
  case '':
    $controller = new HomePage();
    break;
}
if ($controller instanceof Controller) {
  $controller->render();
}
