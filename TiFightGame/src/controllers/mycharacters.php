<?php
require_once('/laragon/www/TiFightGame/src/model.php');

$user = new User;
if ($user->isConnected()) {
    $userCharacters = $user->getCharacter();
    require('views/mycharacters.php');
}
