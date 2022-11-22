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

    public function isCharacterNameExist($characterName)
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT * FROM `characters` WHERE name = :name';
        $characterNameStatement = $db->prepare($sqlQuery);
        $characterNameStatement->execute(
            [
                'name' => $characterName
            ]
        );
        $characterNameExist = $characterNameStatement->fetch(PDO::FETCH_ASSOC);
        return !empty($characterNameExist);
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

    public static function getGamesAmount($id_user)
    {
        $db = DataBase::getInstance();
        $sqlQuery = 'SELECT games_played, games_won, games_lost FROM `users` WHERE id_user = :id_user';
        $userGames = $db->prepare($sqlQuery);
        $userGames->execute(
            [
                'id_user' => $id_user,
            ]
        );
        $userGamesPlayed = $userGames->fetch();
        if (empty($userGamesPlayed)) {
            throw new Exception("Une erreur c'est produite en mettant à jour votre nombre de game. Contactez un administrateur");
        } else {
            return $userGamesPlayed;
        }
    }

    public static function addGamePlayed($id_user)
    {
        $db = DataBase::getInstance();
        $userGamesPlayed = user::getGamesAmount($id_user);
        $sqlQuery = 'UPDATE `users` SET `games_played`=:games_played WHERE id_user =:id_user';
        $games = $db->prepare($sqlQuery);
        $games->execute(
            [
                'games_played' => $userGamesPlayed['games_played'] + 1,
                'id_user' => $id_user
            ]
        );
    }

    public static function addGameWon($id_user)
    {
        $db = DataBase::getInstance();
        $userGamesWon = user::getGamesAmount($id_user);
        $sqlQuery = 'UPDATE `users` SET `games_won`=:games_won WHERE id_user =:id_user';
        $games = $db->prepare($sqlQuery);
        $games->execute(
            [
                'games_won' => $userGamesWon['games_won'] + 1,
                'id_user' => $id_user
            ]
        );
    }

    public static function addGameLost($id_user)
    {
        $db = DataBase::getInstance();
        $userGamesLost = user::getGamesAmount($id_user);
        $sqlQuery = 'UPDATE `users` SET `games_lost`=:games_lost WHERE id_user =:id_user';
        $games = $db->prepare($sqlQuery);
        $games->execute(
            [
                'games_lost' => $userGamesLost['games_lost'] + 1,
                'id_user' => $id_user
            ]
        );
    }
}
