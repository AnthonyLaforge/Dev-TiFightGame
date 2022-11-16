<?php
require_once('./src/Domain/Classes/Classes.php');
class Fight
{   
    public int $maxRound = 5;
    protected Classes $character;

    public function __construct()
    {
        $this->character = new Classes;
    }

    public function setPlayer()
    {
        $player = $this->character->loadClasse($_SESSION['characterSelectedId']);
        return $player;
        // $combat = new Fight();
        //     $combat->setCombattant1($classe1);
        //     $combat->setCombattant2($classe2);

        //     $combat->start();
    }
    public function setOpponent()
    {
        $opponent = $this->character->loadClasse($_SESSION['opponentSelectedId']);
        return $opponent;
    }
    public function startFight($player, $opponent)
    {
        $fight = new Fight();
        $fight->systemFight($player, $opponent);
    }

    function systemFight($player1, $player2)
    {
        if (!isset($_SESSION["player1"])) {
            $_SESSION["player1"] = 0;
        }
        if (!isset($_SESSION["player2"])) {
            $_SESSION["player2"] = 0;
        }
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

        echo "<br/><br/>== Fin du combat ! ==<br/><br/>";
        echo "Combat terminé en $actualAction actions<br/><br/>";

        echo "### Résultat ###<br/>";
        echo "Vainqueur: " . $winner->getName() . " avec " . $winner->getHealth() . " points de vie restants<br/>";
        echo "######################<br/>";
        // echo $_SESSION['user']['character-use']['name'] . " a " . ($_SESSION["player1"] ?? 0) . "WIN <br/>";
        // echo $_SESSION['opponent-selected']['name'] . " a " . ($_SESSION["player2"] ?? 0) . "WIN <br/>";
        // echo "Test a " . ($_SESSION["test"] ?? 0) . "WIN <br/>";
    }
}
