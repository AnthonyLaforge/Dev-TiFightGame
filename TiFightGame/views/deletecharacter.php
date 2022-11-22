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

  <form action="index.php?controller=deletecharacter" method="post">
    <label for="character-name">Choix du personnage à supprimer</br></label>
    <select name="character-select">
      <option value="">--Choisir un personnage--</option>
      <?php foreach ($mycharacters as $mycharacter) : ?>
        <option id="name" value="<?php echo $mycharacter['name'] ?>"><?php echo $mycharacter['name'] ?></option>
      <?php endforeach; ?>
    </select> </br>
    <input type="submit" value="Valider">
  </form>
  <?php var_dump($mycharacters) ?>
  <?php if (isset($_SESSION['characterSelectedId'])) : ?>
    <h1>Personne à supprimer</h1>
    <?php echo $this->character->displayCharacterStats($_SESSION['characterSelectedId']); ?>
    <form action="index.php?controller=deletecharacter" method="post">
      <label for="deletecharacter">Êtes-vous sur de vouloir supprimer ce personnage ?</br></label>
      <input type="submit" name="deletecharacter" id="deletecharacter" value="Oui">
      <input type="submit" name="keepcharacter" id="keepcharacter" value="Non">
    </form>
  <?php endif; ?>
</body>

</html>