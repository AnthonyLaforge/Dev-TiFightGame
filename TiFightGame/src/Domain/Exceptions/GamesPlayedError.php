<?php

class GamesPlayedError extends RuntimeException
{
  public $error = "Une erreur c'est produite en accédant à votre nombre de game. Contactez un administrateur";
}