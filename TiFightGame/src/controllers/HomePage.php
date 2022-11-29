<?php

class HomePage extends Controller
{

    protected string $view = "home.php";

    public function render()
    {
        try{
        if (isset($_SESSION['characterSelectedId']) || isset($_SESSION['opponentSelectedId'])) {
            Classes::unloadClasse();
        }
        if (isset($_SESSION['round']) || isset($_SESSION['player1']) || isset($_SESSION['player2'])) {
            Fight::unloadFight();
        }

        $user = new User;
        if ($user->isConnected()) {
            $userInformation = $user->getInformations();
            $userGames = User::getGamesAmount($userInformation['id_user']);
        };
    } catch(GamesPlayedError $error) {}
        include('views/' . $this->view);
    }
}
