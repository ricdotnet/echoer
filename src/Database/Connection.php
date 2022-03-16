<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection {

  private string $username = "ricdotnet";
  private string $password = "12345";

  private ?PDO $conn = null;

  /**
   * Test and start the db connection
   */
  function tryConnect() {
    try {
      $this->conn = new PDO("mysql:host=127.0.0.1;dbname=comp1", $this->username, $this->password);
    } catch (PDOException $e) {
      print "Error: " . $e->getMessage() . "\n";
    }
  }

  /**
   * Return a connection object to use on queries
   *
   * @return PDO
   */
  function conn(): PDO {
    return $this->conn;
  }
}