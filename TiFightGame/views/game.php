<?php
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
    <a href="/index.php">Retour</a>
    <?php if (!isset($_SESSION['opponentSelectedId']) && !isset($_SESSION['characterSelectedId'])) : ?>
        <div id="choose-character">
            <form action="index.php?controller=game" method="post">
                <label for="character-name">Choix du personnage</label>
                <select name="character-select">
                    <option value="">--Choisir un personnage--</option>
                    <?php foreach ($mycharacters as $mycharacter) : ?>
                        <option id="name" value="<?php echo $mycharacter['name'] ?>"><?php echo $mycharacter['name'] ?></option>
                    <?php endforeach; ?>
                </select> </br>
                <input type="submit" value="Valider">
            </form>
        </div>
    <?php endif; ?>
    <div id="character-stats">
        <div id="player-stats">
            <?php if (isset($_SESSION['characterSelectedId'])) {
                var_dump($charactersStats = $this->getCharacterStats($_SESSION['characterSelectedId']));
                echo $this->displayCharacterStats($_SESSION['characterSelectedId']);
            } ?>
        </div>
        <div id="opponent-stats">
            <?php
            if (isset($_SESSION['opponentSelectedId'])) {
                echo $this->displayCharacterStats($_SESSION['opponentSelectedId']);
            } ?>
        </div>

    </div>
    <?php if (isset($_SESSION['characterSelectedId']) && !isset($_SESSION['opponentSelectedId'])) : ?>
        <div id="choose-opponent">
            <form action="index.php?controller=game" method="post">
                <label for="opponent-name">Choix de l'adversaire</label>
                <select name="opponent-select">
                    <option value="">--Choisir un adversaire--</option>
                    <?php foreach ($myopponents as $myopponent) : ?>
                        <option id="name" value="<?php echo $myopponent['name'] ?>"><?php echo $myopponent['name'] ?></option>
                    <?php endforeach; ?>
                </select> </br>
                <input type="submit" value="Valider">
            </form>
        </div>
    <?php endif; ?>
    <?php if ((isset($_SESSION['characterSelectedId'])) && isset($_SESSION['opponentSelectedId'])) : ?>
        <a href="index.php?controller=fight">Lancer le combat</a>
    <?php endif; ?>
</body>

</html>