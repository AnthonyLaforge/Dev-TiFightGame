<?php
require_once('C:/laragon/www/TiFightGame/src/controllers/mycharacters.php')
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ti-Fight-Game</title>
</head>

<body>
    <h1>Mes personnages</h1>
    <div id="mycharacters">
        <?php foreach ($userCharacters as $character) {
            echo "Nom : ".$character['name']."<br>";
            echo "Classe : ".$character['classe']." <br>";
            echo "Arme : ".$character['weapon']." <br><br>";
        }
        var_dump($userCharacters);
        var_dump($_SESSION) ?>
    </div>
    <a href="/views/createcharacter.php">Créer un nouveau personnage</a>
</body>

</html>