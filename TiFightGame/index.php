<!-- <html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiFightGame</title>
</head> 
</html> -->
<?php

/*spl_autoload_register(function ($class) {
    $base_path = "./src/Domain/";

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

// require_once('/laragon/www/TiFightGame/src/Domain/Weapon/Sword.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Weapon/MagicWand.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Classes/Warrior.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Classes/Knight.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Classes/Wizard.php');
// require_once('/laragon/www/TiFightGame/src/Domain/Classes/Striker.php');
// require_once('/laragon/www/TiFightGame/src/Domain/User/User.php');
require_once('/laragon/www/TiFightGame/src/DataBase.php');
require_once('src/controllers/HomePage.php');
require_once('src/controllers/ConnexionPage.php');
require_once('src/controllers/MyCharactersPage.php');
require_once('src/controllers/CreateCharacterPage.php');
require_once('src/controllers/DeleteCharacterPage.php');
require_once('src/controllers/GamePage.php');
require_once('src/controllers/FightPage.php');


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
