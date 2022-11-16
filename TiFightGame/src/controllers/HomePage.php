<?php
require_once 'Controller.php';

class HomePage extends Controller
{

    protected string $view = "home.php";

    public function render()
    {
        if (isset($_SESSION['characterSelectedId']) || isset($_SESSION['opponentSelectedId'])) {
            Classes::unloadClasse();
        }

        $user = new User;
        if ($user->isConnected()) {
            $userInformation = $user->getInformations();
        };
        include('views/' . $this->view);
    }
}
