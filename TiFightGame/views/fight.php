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
  <div id="fight">
    <?php if (isset($_SESSION['characterSelectedId']) && (isset($_SESSION['opponentSelectedId']))) {
      echo $this->startFight();
    } ?>
  </div>
</body>

</html>