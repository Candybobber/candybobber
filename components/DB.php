<?php

/**
 * Class DB
 * Component for work with the database
 */
class DB {

  /**
   * Connection to the database
   * @return \PDO
   */
  public static function getConnection() {

    // Get the connection settings file
    $paramsPath = ROOT . '/config/db_params.php';
    $params = include ($paramsPath);

    // Set connection
    $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
    $db = new PDO($dsn, $params['user'], $params['password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set encoding
    $db->exec("set names utf8");

    return $db;
  }
}