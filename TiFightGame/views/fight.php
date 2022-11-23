<?php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TiFightGame</title>
  <link rel='stylesheet' type='text/css' href='/css/fight.css'>

</head>

<body>
  <div id="fight">
    <?php var_dump($_SESSION); ?>
    <?php if (isset($_SESSION['characterSelectedId']) && (isset($_SESSION['opponentSelectedId']))) : ?>
      <?php if ($_SESSION['round'] < $this->fight->maxRound) : ?>
        <h1> Round <?php echo $_SESSION['round'] + 1; ?></h1>
      <?php endif; ?>
      <?php echo $this->startFight(); ?>
    <?php endif; ?>
    <div id="options">
      <?php if ($_SESSION['round'] < ($this->fight->maxRound) && (!isset($this->fight->finalWinner))) : ?>
        <div id="giveup-fight">
          <h2>
            <a href="/index.php?controller=fight&giveup=true">Abandonner le combat</a>
          </h2>
        </div>
      <?php endif; ?>
      <?php if ($_SESSION['round'] < ($this->fight->maxRound) && (!isset($this->fight->finalWinner))) : ?>
        <div id="continue-fight">
          <h2>
            <a href="/index.php?controller=fight">Continuer le combat</a>
          </h2>
        </div>
      <?php endif; ?>
      <?php if ($_SESSION['round'] == ($this->fight->maxRound)) : ?>
        <div id="end-fight">
          <h2>
            <a href="/index.php?controller=fight">Fin du combat</a>
          </h2>
        </div>
    </div>
  <?php endif; ?>
  <?php if ($_SESSION['round'] > ($this->fight->maxRound)) : ?>
    <div id="end">
      <h2>
        <a href="/index.php">Terminer</a>
      </h2>
      <div id="logo">
        <img src="/img/tifightgame.png" alt="Logo" size="10px">
      </div>
    </div>
  <?php endif; ?>
  </div>
</body>

</html>