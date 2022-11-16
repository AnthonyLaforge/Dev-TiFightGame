<?php
class Controller {

  protected string $view = "error.php";

  public function render()
  {
    $error = "Une erreur est survenue, cette page n'existe pas";

    include ('views/' . $this->view);
  }
}