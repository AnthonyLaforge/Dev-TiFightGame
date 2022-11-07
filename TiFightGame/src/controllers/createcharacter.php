<?php
require_once('../model.php');
session_start();
$sqlQuery = 'INSERT INTO characters(id_user, name_user, name, classe, weapon) VALUES (:id_user, :name_user, :name, :classe, :weapon)';
$character = dbConnect()->prepare($sqlQuery);
$character->execute(
    [
        'id_user' => $_SESSION['user']['id_user'],
        'name_user' =>  $_SESSION['user']['name'],
        'name' => $_POST['character-name'],
        'classe' => $_POST['class-select'],
        'weapon' => $_POST['weapon-select'],
    ]
);
header("Location: /index.php");
