<?php
session_start();
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
    <form action="/src/controllers/createcharacter.php" method="post">
        <label for="character-name">Nom du personnage</label>
        <input type="text" name="character-name" id="character-name">
        <label for="class-select">Classe du personnage</label>
        <select name="class-select">
            <option value="">--Choisir une classe--</option>
            <option value="warrior">Combattant</option>
            <option value="knight">Chevalier</option>
            <option value="striker">Percuteur</option>
            <option value="wizard">Sorcier</option>
        </select> </br>
        <label for="weapon-select">Arme du personnage</label>
        <?php var_dump($_SESSION) ?>
        <select name="weapon-select">
            <option value="">--Choisir une arme--</option>
            <option value="none">Aucune</option>
            <option value="sword">Épée</option>
            <option value="shield">Bouclier</option>
            <option value="magic-wand">Baguette Magique</option>
        </select> </br>
        <input type="submit" value="Valider">
    </form>

</body>

</html>