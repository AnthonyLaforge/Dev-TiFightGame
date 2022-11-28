<?php
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
            <a href="connexion">Se connecter</a>
        <?php endif; ?>
        <?php if ($user->isConnected()) : ?>
            Bonjour <?php echo $userInformation['name']; ?>
            <div id="games-stats">
                <h3>Statistiques Parties</h3>
                Jouées➤<?php echo $userGames['games_played'] ?><br>
                Gagnées➤<?php echo $userGames['games_won'] ?><br>
                Perdues➤<?php echo $userGames['games_lost'] ?><br><br>
            </div>
            <a href="mycharacters">Mes personnages</a>
            <a href="index.php?controller=connexion&disconnect">Se déconnecter</a>

    </div>
    <div id="launchgame">
        <h1><a href="game">Jouer</a></h1>
    </div>
<?php endif; ?>

</body>

</html>