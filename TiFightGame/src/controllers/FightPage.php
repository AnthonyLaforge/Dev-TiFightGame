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
    }
    include('views/' . $this->view);
  }
  public function startFight()
  {
    $this->fight->startFight($this->fight->setPlayer(), $this->fight->setOpponent());
  }
}
