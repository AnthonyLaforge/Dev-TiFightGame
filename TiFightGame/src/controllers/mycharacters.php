<?php
require_once('/laragon/www/TiFightGame/src/model.php');

$user = new User;
if ($user->isConnected()) {
    $userCharacters = $user->getCharacter();
    require('views/mycharacters.php');
}

// $sqlQuery = 'SELECT * FROM `characters` WHERE id_user =:id_user';
// $characterinformation = dbConnect()->prepare($sqlQuery);
// $characterinformation->execute(
//     [
//         'id_user' => $_SESSION['user']['id_user'],
//     ]
// );
// $charactersinformations = $characterinformation->fetch(PDO::FETCH_ASSOC);

// var_dump($charactersinformations);

// if($charactersinformations['classe'] == 'warrior') {
//     $characterWeapon = new Sword ("Demacia");
//     $characterClasse = new Warrior($charactersinformations['name'],$characterWeapon);
// }