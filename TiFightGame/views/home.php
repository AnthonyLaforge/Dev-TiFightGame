<?php
require_once('src/controllers/home.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiFightGame</title>
    <link rel='stylesheet' type='text/css' href='/css/home.css'>

</head>

<body>
    <div id="title">
        <img src="/img/tifightgame.png" alt="Logo" size="10px">
    </div>
    <div class="userpanel">
        <?php if (!$user->isConnected()) : ?>
            <a href="/views/connexion.php">Se connecter</a>
        <?php endif; ?>
        <?php if ($user->isConnected()) : ?>
            Bonjour <?php echo $userInformation['name']; ?>
            <a href="/src/controllers/connexion.php?disconnect">Se déconnecter</a>
            <a href="/index.php?mycharacters">Mes personnages</a>
    </div>
    <div id="launchgame">
        <h1><a href="/index.php?game">Jouer</a></h1>
    </div>
<?php endif; ?>
<div id="game">
    <?php echo $combat->systemFight($titigre, $picman); ?></div>
</div>
</body>

</html>