<?php

/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 04.03.2016
 * Time: 12:10
 */
class Errors {

  public static function error404() {
    $path = ROOT . '/views/error/404.php';
    include ($path);
  }

  public static function error403() {
    $path = ROOT . '/views/error/403.php';
    include ($path);
  }
}