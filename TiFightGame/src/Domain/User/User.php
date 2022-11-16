<?php
require_once('./src/DataBase.php');
class User
{
    public $id_user;
    public $name;
    public $mail;
    public $password;

    public function isMailExist($mail)
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT * FROM `users` WHERE mail = :mail';
        $mailStatement = $db->prepare($sqlQuery);
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
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT * FROM `users` WHERE name = :name';
        $nameStatement = $db->prepare($sqlQuery);
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

        $db = DataBase::getInstance();
        $sqlQuery = 'INSERT INTO users(name, mail, password) VALUES (:name, :mail, :password)';
        $user = $db->prepare($sqlQuery);
        $user->execute(
            [
                'name' => $name,
                'mail' => $mail,
                'password' => $password,
            ]
        );
    }


    public function login($name, $password)
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT * FROM `users` WHERE name =:name AND password = :password';
        $usersStatement = $db->prepare($sqlQuery);
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
        // unset($_SESSION["user"]);
        session_destroy();
        header("Location: /index.php");
        die();
    }

    public function isConnected()
    {
        return !empty($_SESSION["user"]);
    }

    public function getInformations()
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT * FROM `users` WHERE id_user = ' . $_SESSION['user']['id_user'] . '';
        $informationStatement = $db->prepare($sqlQuery);
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
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT name, classe, weapon, shield FROM `characters` WHERE id_user =:id_user';
        $characterinformation = $db->prepare($sqlQuery);
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

    public function getAllCharacters()
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT id_user, name_user, name, classe, weapon, shield FROM `characters` WHERE id_user = :id_user';
        $charactersinformations = $db->prepare($sqlQuery);
        $charactersinformations->execute(
            [
                'id_user' => !$_SESSION['user']['id_user'],
            ]
        );
        $allCharactersDB = $charactersinformations->fetchALL(PDO::FETCH_ASSOC);
        if (!empty($allCharactersDB)) {
            return $allCharactersDB;
        } else {
            return [];
        }
    }
}
