<?php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='/css/mycharacters.css'>
    <title>Ti-Fight-Game</title>
</head>

<body>
    <a href="index.php">Retour</a>
    <h1>Mes personnages</h1>
    <?php if (isset($error)) : ?>
        <span class="error"> <?php echo $error->getMessage(); ?></span>
    <?php endif ?>
    <div id="mycharacters">
        <?php echo $this->displayMyCharacters(); ?>
    </div>
    <a href="index.php?controller=createcharacter">Créer un nouveau personnage</a>
    <?php if (!isset($error)) : ?>
        <a href="index.php?controller=deletecharacter">Supprimer un personnage</a>
    <?php endif; ?>
</body>

</html>