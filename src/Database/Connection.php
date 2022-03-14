<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection {

  private string $username = "ricdotnet";
  private string $password = "12345";

  /**
   * Test and start the db connection
   * @return PDO|null
   */
  function tryConnect(): ?PDO {
    try {
      return new PDO("mysql:host=127.0.0.1;dbname=comp1", $this->username, $this->password);
    } catch (PDOException $e) {
      print "Error: " . $e->getMessage() . "\n";
    }

    return null;
  }
}