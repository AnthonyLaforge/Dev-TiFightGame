<?php
require_once('src/model.php');

$user = new User;
if ($user->isConnected()) {
    $userInformation = $user->getInformations();
}
require('views/home.php');
