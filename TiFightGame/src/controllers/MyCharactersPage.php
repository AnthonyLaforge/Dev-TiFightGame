<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class MyCharactersPage extends Controller
{
    protected string $view = "mycharacters.php";
    protected Shield $shield;


    public function render()
    {
        if (isset($_SESSION['characterCreation-classe']) || isset($_SESSION['characterCreation-weapon']) || isset($_SESSION['characterCreation-shield']) || isset($_SESSION['characterCreation-name'])) {

            unset($_SESSION['characterCreation-weapon']);
            unset($_SESSION['characterCreation-shield']);
            unset($_SESSION['characterCreation-name']);
            unset($_SESSION['characterCreation-classe']);
        }
        try {
            if (!empty($this->getMyCharacters())) {
                $this->getMyCharacters();
            } else {
                throw new Exception("Vous n'avez aucun personnage");
            }
        } catch (Exception $error) {
        }
        include('views/' . $this->view);
    }


    public function getMyCharacters()
    {
        $user = new User;
        $userCharacters = $user->getCharacter();
        return $userCharacters;
    }

    public function displayMyCharacters()
    {
        $this->shield = new Shield();
        foreach ($this->getMyCharacters() as $character) {
            echo "Nom : " . $character['name'] . "<br>";
            echo "Classe : " . $character['classe'] . " <br>";
            echo "Arme : " . $character['weapon'] . " <br>";
            if ($character['shield'] != "null") {
                echo "Bouclier : " . $character['shield'] . " <br>";
            }
            echo "<br>";
        }
    }
}

