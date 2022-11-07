<?php
require_once('src/Domain/Classes/Classes.php');
require_once('src/Domain/Weapon/Weapon.php');
require_once('src/Domain/Fight/Fight.php');
require_once('src/Domain/User/User.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// if (!isset($_SESSION["player1"])) {
//     $_SESSION["player1"] = 0;
// }
// if (!isset($_SESSION["player2"])) {
//     $_SESSION["player1"] = 0;
// }

$combat = new Fight();

$swordtitigre = new Sword("Demacia");
$shieldtitigre = new Shield();

$titigre = new Knight("Titigre", $swordtitigre, $shieldtitigre);

$swordpicman = new Sword("Test");
$picman = new Warrior("Picman", $swordpicman);





if (isset($_GET['mycharacters'])) {
    require('src/controllers/mycharacters.php');
} elseif (isset($_GET['game'])) {
    require('src/controllers/game.php');
} else {
    require('src/controllers/home.php');
}
