<?php
class Fight
{
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
            // $_SESSION["test"] -= 1;
        } else {
            $winner = $player2;
            $_SESSION["player2"] += 1;
            // $_SESSION["test"] -= 1;
        }

        echo "<br/><br/>== Fin du combat ! ==<br/><br/>";
        echo "Combat terminé en $actualAction actions<br/><br/>";

        echo "### Résultat ###<br/>";
        echo "Vainqueur: " . $winner->getName() . " avec " . $winner->getHealth() . " points de vie restants<br/>";
        echo "######################<br/>";
        echo "Titigre a " . ($_SESSION["player1"] ?? 0) . "WIN <br/>";
        echo "Picman a " . ($_SESSION["player2"] ?? 0) . "WIN <br/>";
        // echo "Test a " . ($_SESSION["test"] ?? 0) . "WIN <br/>";
    }
}
