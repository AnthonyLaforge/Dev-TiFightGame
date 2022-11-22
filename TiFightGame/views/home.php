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
            <a href="index.php?controller=connexion">Se connecter</a>
        <?php endif; ?>
        <?php if ($user->isConnected()) : ?>
            Bonjour <?php echo $userInformation['name']; ?>
            <br>Parties : <br>
            Jouées:<?php echo $userGames['games_played']?>  
            Gagnées:<?php echo $userGames['games_won'] ?>  
            Perdues:<?php echo $userGames['games_lost'] ?>  
            <a href="index.php?controller=connexion&disconnect">Se déconnecter</a>
            <a href="index.php?controller=mycharacters">Mes personnages</a>
    </div>
    <div id="launchgame">
        <h1><a href="index.php?controller=game">Jouer</a></h1>
    </div>
<?php endif; ?>

</body>

</html>