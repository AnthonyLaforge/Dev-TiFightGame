<?php
class Fight
{
    public int $maxRound = 5;
    protected Classes $character;
    protected User $user;

    public function __construct()
    {
        $this->character = new Classes;
        $this->user = new User;
    }

    public function setPlayer()
    {
        $player = $this->character->getClasse($_SESSION['characterSelectedId']);
        return $player;
    }
    public function setOpponent()
    {
        $opponent = $this->character->getClasse($_SESSION['opponentSelectedId']);
        return $opponent;
    }
    public function startFight($player, $opponent)
    {
        $fight = new Fight();
        $fight->systemFight($player, $opponent);
    }

    function systemFight($player1, $player2)
    {
        if ($_SESSION['round'] != $this->maxRound) {
            if (!isset($_SESSION["player1"])) {
                $_SESSION["player1"] = 0;
            }
            if (!isset($_SESSION["player2"])) {
                $_SESSION["player2"] = 0;
            }
            $_SESSION['round'] += 1;
            $numberAction = 1;
            while ($player1->isAlive() && $player2->isAlive()) {
                echo "<br/>Action " . $numberAction++ . "<br/>";
                $actualAction = $numberAction - 1;
                $chance_attaque = rand(0, 1);
                if ($chance_attaque === 1) {
                    $player1->attack($player2);
                } else {
                    $player2->attack($player1);
                }
            }
            if ($player1->isAlive()) {
                $winner = $player1;
                $_SESSION["player1"] += 1;
            } else {
                $winner = $player2;
                $_SESSION["player2"] += 1;
            }

            echo "<br/><br/>== Fin du round ! ==<br/><br/>";
            echo "Round terminé en $actualAction actions<br/><br/>";

            echo "### Résultat ###<br/>";
            echo "Vainqueur: " . $winner->getName() . " avec " . $winner->getHealth() . " points de vie restants<br/>";
            echo "######################<br/>";
            echo "### Score ###<br/>";
            echo $player1->getName() . " a gagné " . $_SESSION["player1"] . " rounds<br/>";
            echo $player2->getName() . " a gagné " . $_SESSION["player2"] . " rounds<br/>";
        } else {
            if ($_SESSION["player1"] == $this->maxRound) {
                $finalWinner = $player1;
                $finalLooser = $player2;
            } else {
                $finalWinner = $player2;
                $finalLooser = $player1;
            }
            echo "Combat terminé</br>";
            echo "Vainqueur : " . $finalWinner->getName() . "";
            $winnerId = $this->character->getIdUserCharacter($finalWinner->getName());
            $looserId = $this->character->getIdUserCharacter($finalLooser->getName());
            user::addGamePlayed($winnerId['id_user']);
            user::addGameWon($winnerId['id_user']);
            user::addGamePlayed($looserId['id_user']);
            user::addGameLost($looserId['id_user']);
            $_SESSION['round'] += 1;
        }
    }

    public function playerGiveUp($player)
    {
        $player = $this->setPlayer();
        $opponent = $this->setOpponent();
        $playerID = $this->character->getIdUserCharacter($player->getName());
        $opponentID = $this->character->getIdUserCharacter($opponent->getName());
        user::addGamePlayed($opponentID['id_user']);
        user::addGameWon($opponentID['id_user']);
        user::addGamePlayed($playerID['id_user']);
        user::addGameLost($playerID['id_user']);
    }

    public static function unloadFight()
    {
        unset($_SESSION['player1']);
        unset($_SESSION['player2']);
        unset($_SESSION['round']);
    }
}
