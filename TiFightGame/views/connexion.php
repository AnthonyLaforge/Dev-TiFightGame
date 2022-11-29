<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='/css/connexion.css'>
    <title>TiFightGame</title>
</head>

<body>

    <?php if (isset($error)) : ?>
        <div class="error"> <?php echo $error->getMessage(); ?></div>
    <?php endif ?>
    <?php if (!isset($_GET["register"])) : ?>
        <div id="back"><a href="home">Retour</a></div>
        <div id="connexion">
            <form action="connexion" method="post">
                <label for="name">Nom d'utilisateur</label>
                <input type="text" name="name" id="name" required>
                <label for="password">Mot de passe</label>
                <input type="text" name="password" id="password" required>
                <input type="submit" value="Connexion">
            </form>
            <span class="noaccount"> <a href="register">Je n'ai pas de compte</a></div>
        </div>
    <?php endif ?>

    <?php if (isset($_GET["register"])) : ?>
        <div id="back"><a href="connexion">Retour</a></div>
        <div id="register">
            <form action="register" method="post">
                <label for="name">Nom d'utilisateur</label>
                <input type="text" name="name" id="name" required>
                <label for="mail">Adresse mail</label>
                <input type="email" name="mail" id="mail" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <label for="password">Confirmer Mot de passe</label>
                <input type="password" name="confirmpassword" id="confirmpassword" required>
                <input type="submit" value="S'inscrire">
            </form>
        </div>
    <?php endif ?>
</body>

</html>