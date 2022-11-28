<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once('src/AutoLoad.php');
AutoLoad::autoLoader();

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
