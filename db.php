<?php
require_once('./config.php');

class KudosDB extends SQLite3 {
  function __construct() {
    $this->open(DB_LOCATION);
  }
}
