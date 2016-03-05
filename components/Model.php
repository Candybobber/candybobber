<?php

class Model {

  /**
   * Hold the database connection.
   *
   * @var object
   */
  protected $db;

  public function __construct() {
    $this->db = DB::getConnection();
  }
}