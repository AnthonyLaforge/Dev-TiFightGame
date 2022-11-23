<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class ConnexionPage extends Controller
{
    protected string $view = "connexion.php";
    protected User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function render()
    {
        try {
            if (isset($_GET["disconnect"])) {

                $this->disconnect();
            }

            if ((!isset($_GET["register"]) && isset($_POST["name"]) && isset($_POST["password"]))) {

                $this->connexion();
            }

            if (isset($_GET["register"]) && (isset($_POST["name"])) && (isset($_POST["mail"]) && (isset($_POST["password"])))) {
                $this->register();
            }

        } catch (Exception $error) {}

        include('views/' . $this->view);
    }
    public function connexion()
    {
        if ($this->user->login($_POST["name"], $_POST["password"]) == false) {
            throw new Exception("L'utilisateur et/ou le mot de passe est incorrect");
            header("Location: index.php?controller=connexion");
        } else {
            $this->user->login($_POST["name"], $_POST["password"]);
            header("Location: index.php");
        }
    }

    public function disconnect()
    {
        if ($this->user->isConnected()) {
            $this->user->logout();
        }
        header("Location: index.php");
    }

    public function register()
    {
        if ((!$this->user->isNameExist($_POST["name"])) && (!$this->user->isMailExist($_POST["mail"]))) {
            if ($_POST["password"] == $_POST["confirmpassword"]) {
                $this->user->register($_POST["name"], $_POST["mail"], $_POST['password']);
                $this->user->login($_POST["name"], $_POST["password"]);
                header("Location: index.php");
            } else {
                throw new Exception("Les mots de passes doivent être identique");
                header("Location: index.php?controller=connexion");
            }
        } else {
            throw new Exception("Nom d'utilisateur et/ou adresse mail déja utilisé");
            header("Location: index.php?controller=connexion");
        }
    }
}
