<?php
require_once 'Controller.php';
require_once('./src/Domain/Fight/Fight.php');

class FightPage extends Controller
{

  protected string $view = "fight.php";
  protected Fight $fight;
  protected User $user;
  protected Classes $character;

  public function __construct()
  {
    $this->fight = new Fight();
    $this->user = new User();
    $this->character = new Classes;
  }

  public function render()
  {
    if (isset($_SESSION['characterSelectedId']) && isset($_SESSION['opponentSelectedId'])) {
      $this->fight->setPlayer();
      $this->fight->setOpponent();
      if (!isset($_SESSION['round'])) {
        $_SESSION['round'] = 0;
      }
      if (isset($_GET["giveup"])) {
        $this->fight->playerGiveUp($_SESSION['characterSelectedId']);
        header("Location: /index.php");
        die();
      }
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
