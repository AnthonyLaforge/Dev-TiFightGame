<?php
require_once('C:\laragon\www\TiFightGame\src\Domain\User\User.php');
require_once('/laragon/www/TiFightGame/src/model.php');
class User
{
    public $id_user;
    public $name;
    public $mail;
    public $password;

    public function __construct()
    {
        dbConnect();
    }
    public function isMailExist($mail)
    {
        $sqlQuery = 'SELECT * FROM `users` WHERE mail = :mail';
        $mailStatement = dbConnect()->prepare($sqlQuery);
        $mailStatement->execute(
            [
                'mail' => $mail
            ]
        );
        $emailExist = $mailStatement->fetch(PDO::FETCH_ASSOC);
        return !empty($emailExist);
    }

    public function isNameExist($name)
    {
        $sqlQuery = 'SELECT * FROM `users` WHERE name = :name';
        $nameStatement = dbConnect()->prepare($sqlQuery);
        $nameStatement->execute(
            [
                'name' => $name
            ]
        );
        $nameExist = $nameStatement->fetch(PDO::FETCH_ASSOC);
        return !empty($nameExist);
    }

    public function register($name, $mail, $password)
    {
        if ((!self::isNameExist($name)) && (!self::isMailExist($mail))) {

            $sqlQuery = 'INSERT INTO users(name, mail, password) VALUES (:name, :mail, :password)';
            $user = dbConnect()->prepare($sqlQuery);
            $user->execute(
                [
                    'name' => $name,
                    'mail' => $mail,
                    'password' => $password,
                ]
            );
        } else {
            header("Location:/views/connexion.php?register&error=name");
            die();
        }
    }


    public function login($name, $password)
    {
        $sqlQuery = 'SELECT * FROM `users` WHERE name =:name AND password = :password';
        $usersStatement = dbConnect()->prepare($sqlQuery);
        $usersStatement->execute(
            [
                'name' => $name,
                'password' => $password,
            ]
        );
        $user = $usersStatement->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            $_SESSION['user'] = $user;
            return true;
        } else {
            return false;
        }
    }
    public function logout()
    {
        unset($_SESSION["user"]);
        header("Location: /index.php");
        die();
    }

    public function isConnected()
    {
        return !empty($_SESSION["user"]);
    }

    public function getInformations()
    {
        $sqlQuery = 'SELECT * FROM `users` WHERE id_user = ' . $_SESSION['user']['id_user'] . '';
        $informationStatement = dbConnect()->prepare($sqlQuery);
        $informationStatement->execute();
        $user = $informationStatement->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            return $user;
        } else {
            return [];
        }
    }
    public function getCharacter()
    {
        $sqlQuery = 'SELECT name, classe, weapon FROM `characters` WHERE id_user =:id_user';
        $characterinformation = dbConnect()->prepare($sqlQuery);
        $characterinformation->execute(
            [
                'id_user' => $_SESSION['user']['id_user'],
            ]
        );
        $character = $characterinformation->fetchALL(PDO::FETCH_ASSOC);
        if (!empty($character)) {
            return $character;
        } else {
            return [];
        }
    }
}