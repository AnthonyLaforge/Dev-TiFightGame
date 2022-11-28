<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' type='text/css' href='/css/deletecharacter.css'>
  <title>Ti-Fight-Game</title>
</head>

<body>
  <div id="back">
    <a href="mycharacters">Retour</a>
  </div>

  <form action="deletecharacter" method="post">
    <label for="character-name">Choix du personnage à supprimer</br></label>
    <select name="character-select">
      <option value="">--Choisir un personnage--</option>
      <?php foreach ($mycharacters as $mycharacter) : ?>
        <option id="name" value="<?php echo $mycharacter['name'] ?>"><?php echo $mycharacter['name'] ?></option>
      <?php endforeach; ?>
    </select> </br>
    <input type="submit" value="Valider">
  </form>
  <?php if (isset($_SESSION['characterSelectedId'])) : ?>
    <div id="selected-character">
      <h1 class="title">Personnage à supprimer</h1>
      <?php echo $this->character->displayCharacterStats($_SESSION['characterSelectedId']); ?>
    </div>
    <form action="deletecharacter" method="post">
      <label for="deletecharacter">Êtes-vous sur de vouloir supprimer ce personnage ?</br></label>
      <input type="submit" name="deletecharacter" id="deletecharacter" value="Oui">
      <input type="submit" name="keepcharacter" id="keepcharacter" value="Non">
    </form>

  <?php endif; ?>
</body>

</html>