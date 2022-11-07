<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('src/controllers/game.php');
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
    <div id="game">
        <form action="/src/controllers/game.php" method="post">
            <label for="character-name">Choix du personnage</label>
            <select name="character-select">
                <option value="">--Choisir un personnage--</option>
                <?php foreach ($userCharacters as $character) : ?>
                    <option value="<?php $character['name'] ?>"><?php echo $character['name'] ?></option>
                <?php endforeach; ?>
            </select> </br>
            <input type="submit" value="Valider">
            <?php var_dump($character) ?>
    </div>
</body>

</html>