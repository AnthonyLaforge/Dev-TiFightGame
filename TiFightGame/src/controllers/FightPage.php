<?php
require_once 'Controller.php';
require_once('./src/Domain/Fight/Fight.php');

class FightPage extends Controller
{

  protected string $view = "fight.php";
  protected Fight $fight;

  public function __construct()
  {
    $this->fight = new Fight();
  }

  public function render()
  {
    if (isset($_SESSION['characterSelectedId']) && isset($_SESSION['opponentSelectedId'])) {
      $this->fight->setPlayer();
      $this->fight->setOpponent();
      if (!isset($_SESSION['round'])) {
        $_SESSION['round'] = 0;
      }
      // if (($_SESSION['round'] == $this->fight->maxRound)) {
      //   header("Location: index.php");
      // }
    } else {
      header("Location: index.php");
    }
    if ($_SESSION['round'] > ($this->fight->maxRound)) {
      header("Location: index.php");
    }
    include('views/' . $this->view);
  }
  public function startFight()
  {
    $this->fight->startFight($this->fight->setPlayer(), $this->fight->setOpponent());
  }
}
