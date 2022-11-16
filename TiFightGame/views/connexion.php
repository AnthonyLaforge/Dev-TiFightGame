<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiFightGame</title>
</head>

<body>

    <?php if (isset($error)) : ?>
        <span class="error"> <?php echo $error->getMessage(); ?></span>
    <?php endif ?>
    <?php if (!isset($_GET["register"])) : ?>
        <span class="back"><a href="index.php">Retour</a></span>
        <form action="index.php?controller=connexion" method="post">
            <label for="name">Nom d'utilisateur</label>
            <input type="text" name="name" id="name" required>
            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="password" required>
            <input type="submit" value="Connexion">
        </form>
        <span class="noaccount"> <a href="index.php?controller=connexion&register">Je n'ai pas de compte</a></span>
    <?php endif ?>
    <?php if (isset($_GET["register"])) : ?>
        <form action="index.php?controller=connexion&register" method="post">
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
        <span class="back"><a href="index.php?controller=connexion">Retour</a></span>
    <?php endif ?>
</body>

</html>