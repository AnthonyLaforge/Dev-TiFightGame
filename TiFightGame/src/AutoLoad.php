<?php

class AutoLoad
{
  public static function autoLoader()
  {
    spl_autoload_register(function ($class) {
      $base_path = "src/";

      if (file_exists($base_path . "Domain/Classes/" . $class . ".php")) {
        require_once $base_path . "Domain/Classes/" . $class . ".php";
      } else if (file_exists($base_path . "/Domain/Fight/" . $class . ".php")) {
        require_once $base_path . "Domain/Fight/" . $class . ".php";
      } else if (file_exists($base_path . "/Domain/User/" . $class . ".php")) {
        require_once $base_path . "Domain/User/" . $class . ".php";
      } else if (file_exists($base_path . "/Domain/Weapon/" . $class . ".php")) {
        require_once $base_path . "Domain/Weapon/" . $class . ".php";
      } else if (file_exists($base_path . "/Domain/Shield/" . $class . ".php")) {
        require_once $base_path . "Domain/Shield/" . $class . ".php";
      } elseif (file_exists($base_path . "controllers/" . $class . ".php")) {
        require_once $base_path . "controllers/" . $class . ".php";
      } elseif (file_exists($base_path . $class . ".php")) {
        require_once $base_path . $class . ".php";
      }
    });
  }
}
