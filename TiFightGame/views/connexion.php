<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiFightGame</title>
</head>

<body>
    <?php if (!isset($_GET["register"])) : ?>
        <?php if (isset($_GET["error"])) : ?>
            <span class="error">Email/mot de passe incorrect !</span>
        <?php endif ?>
        <form action="/src/controllers/connexion.php" method="post">
            <label for="name">Nom d'utilisateur</label>
            <input type="text" name="name" id="name" required>
            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="password" required>
            <input type="submit" value="Connexion">
        </form>
        <a href="connexion.php?register">Je n'ai pas de compte</a>
    <?php endif ?>
    <?php if (isset($_GET["register"])) : ?>
        <form action="/src/controllers/connexion.php?register" method="post">
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
        <?php if (isset($_GET["error"])) : ?>
            <span class="error">Nom/Adresse mail déja utilisé !</span>
        <?php endif ?>
        <?php if (isset($_GET["diffpassword"])) : ?>
            <span class="error">Les mots de passe ne sont pas identique !</span>
        <?php endif ?>
        <spawn class="back"><a href="connexion.php">Retour</a></spawn>
    <?php endif ?>
</body>

</html>