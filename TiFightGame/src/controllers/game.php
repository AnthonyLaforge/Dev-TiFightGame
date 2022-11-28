<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['character-select'])) {;
    $sqlQuery = 'SELECT id_user, name_user, name, classe, weapon FROM characters WHERE id_user =:id_user AND name =:name';
    $character = dbConnect()->prepare($sqlQuery);
    $character->execute(
        [
            'id_user' => $_SESSION['user']['id_user'],
            'name' =>  $_SESSION['user']['name'],
        ]
    );
    var_dump($character);
    require('views/game.php');
}


if (!isset($_SESSION['characters'])) {
    $user = new User;
    if ($user->isConnected()) {
        $userCharacters = $user->getCharacter();
        $_SESSION['characters'] = $userCharacters;
        require('views/game.php');
    }
};
