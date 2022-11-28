<?php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='/css/game.css'>
    <title>Ti-Fight-Game</title>
</head>

<body>
    <div id="back">
        <a href="home">Retour</a>
    </div>
    <?php if (isset($error)) : ?>
        <span class="error"> <?php echo $error->getMessage(); ?></span>
    <?php endif; ?>
    <?php if (!isset($_SESSION['opponentSelectedId']) && !isset($_SESSION['characterSelectedId'])) : ?>
        <div id="choose-character">
            <form action="game" method="post">
                <label for="character-name">Choix du personnage</br></label>
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
    <?php if (isset($_SESSION['characterSelectedId']) && !isset($_SESSION['opponentSelectedId'])) : ?>
        <div id="choose-opponent">
            <form action="game" method="post">
                <label for="opponent-name">Choix de l'adversaire</br></label>
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
    <div id="character-stats">
        <div id="player-stats">
            <?php if (isset($_SESSION['characterSelectedId'])) : ?>
                <h1>Mon personnage</h1>
                <?php echo $this->displayCharacterStats($_SESSION['characterSelectedId']); ?>
            <?php endif; ?>
        </div>
        <div id="opponent-stats">
            <?php
            if (isset($_SESSION['opponentSelectedId'])) : ?>
                <h1>Mon adversaire</h1>
                <?php echo $this->displayCharacterStats($_SESSION['opponentSelectedId']); ?>
            <?php endif ?>
        </div>

    </div>
    <?php if ((isset($_SESSION['characterSelectedId'])) && isset($_SESSION['opponentSelectedId'])) : ?>
        <div id="launch-game"> <a href="fight">Lancer le combat</a> </div>
    <?php endif; ?>
</body>

</html>