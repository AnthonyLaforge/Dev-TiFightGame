<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ti-Fight-Game</title>
</head>

<body>
    <a href="/index.php?controller=mycharacters">Retour</a>

</body>

<?php if (isset($error)) : ?>
    <span class="error"> <?php echo $error->getMessage(); ?></span>
<?php endif ?>

<div id="character-resume">
    <?php if (isset($_SESSION['characterCreation-classe'])) : ?>
        <h1> Résumé </h1>
        <p> Classe du personnage: <?php echo $_SESSION['characterCreation-classe'] ?> </p> <?php endif ?>
    <?php if (isset($_SESSION['characterCreation-weapon'])) : ?>
        <p> Arme du personnage: <?php echo $_SESSION['characterCreation-weapon'] ?> </p> <?php endif ?>
    <?php if (isset($_SESSION['characterCreation-shield'])) : ?>
        <p> Bouclier du personnage: <?php echo $_SESSION['characterCreation-shield'] ?> </p> <?php endif ?>
    <?php if (isset($_SESSION['characterCreation-name'])) : ?>
        <p> Nom du personnage <?php echo $_SESSION['characterCreation-name'] ?> </p> <?php endif ?>
</div>


<div id="character-creation">
    <?php if (!isset($_SESSION['characterCreation-classe'])) : ?>
        <form action="index.php?controller=createcharacter" method="post">
            <label for="class-select">Classe du personnage</label>
            <select name="class-select">
                <option value="">--Choisir une classe--</option>
                <option value="Combattant">Combattant</option>
                <option value="Chevalier">Chevalier</option>
                <option value="Percuteur">Percuteur</option>
                <option value="Sorcier">Sorcier</option>
            </select>
            <input type="submit" value="Suivant">
        </form></br>
    <?php endif ?>



    <?php if (isset($_SESSION['characterCreation-classe']) && (!isset($_SESSION['characterCreation-weapon']) && ($_SESSION['characterCreation-classe'] != 'Knight'))) : ?>
        <form action="index.php?controller=createcharacter" method="post">
            <label for="weapon-select">Arme du personnage</label>
            <select name="weapon-select">
                <option value="">--Choisir une arme--</option>
                <option value="Aucune">Aucune</option>
                <?php if (isset($_SESSION['characterCreation-classe']) && ($_SESSION['characterCreation-classe'] != 'Wizard')) : ?>
                    <option value="Épée">Épée</option>
                <?php endif ?>
                <?php if (isset($_SESSION['characterCreation-classe']) && ($_SESSION['characterCreation-classe'] == 'Wizard')) : ?>
                    <option value="Baguette Magique">Baguette Magique</option>
                <?php endif ?>
            </select>
            <input type="submit" value="Suivant">
        </form></br>
    <?php endif ?>


    <?php if (isset($_SESSION['characterCreation-classe']) && (!isset($_SESSION['characterCreation-weapon']) && ($_SESSION['characterCreation-classe'] == 'Knight'))) : ?>
        <form action="index.php?controller=createcharacter" method="post">
            <label for="weapon-select">Arme du personnage</label>
            <select name="weapon-select">
                <option value="">--Choisir une arme--</option>
                <option value="Aucune">Aucune</option>
                <?php if (isset($_SESSION['characterCreation-classe']) && ($_SESSION['characterCreation-classe'] != 'Wizard')) : ?>
                    <option value="Épée">Épée</option>
                <?php endif ?>
                <?php if (isset($_SESSION['characterCreation-classe']) && ($_SESSION['characterCreation-classe'] == 'Wizard')) : ?>
                    <option value="Baguette Magique">Baguette Magique</option>
                <?php endif ?>
            </select></br>
            <label for="shield-select">Bouclier de votre chevalier</label>
            <select name="shield-select">
                <option value="">--Choisir un bouclier--</option>
                <option value="Bouclier en bois">Bouclier en bois</option>
            </select>
            <input type="submit" value="Suivant">
        </form></br>
    <?php endif ?>

    <?php if (isset($_SESSION['characterCreation-weapon']) && (!isset($_SESSION['characterCreation-name'])) && (isset($_SESSION['characterCreation-classe']))) : ?>
        <form action="index.php?controller=createcharacter" method="post">
            <label for="character-name">Nom du personnage</label>
            <input type="text" name="character-name" id="character-name">
            <input type="submit" value="Créer mon personnage">
        </form>
    <?php endif; ?>
</div>

</html>