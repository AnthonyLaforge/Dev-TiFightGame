<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../Domain/User/User.php');
$user = new User;
if ((isset($_GET["disconnect"]) && $user->isConnected())) {
    $logout = new User;
    $logout->logout();
    header("Location: /index.php");
    die();
}
if (isset($_GET["register"]) && isset($_POST["name"]) && isset($_POST["mail"]) && isset($_POST["password"])) {
    if ($_POST["password"] == $_POST["confirmpassword"]) {
        $register = new User;
        $register->register($_POST["name"], $_POST["mail"], $_POST['password']);
        $register->login($_POST["name"], $_POST["password"]);
        header("Location: /index.php");
        die();
    } else {
        header("Location:/views/connexion.php?register&diffpassword");
    }
}
if (!isset($_GET["register"])) {
    $connexion = new User;
    if (isset($_POST["name"]) && isset($_POST["password"])) {
        if ($connexion->login($_POST["name"], $_POST["password"])) {
            header("Location: /index.php");
            die();
        } else {
            header("Location: /views/connexion.php?error=1");
            die();
        }
    } else {
        header("Location: /index.php");
        die();
    }
}
