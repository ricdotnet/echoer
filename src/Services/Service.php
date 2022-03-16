<?php

namespace App\Services;

use App\Database\Connection;
use PDO;
use PDOException;

class Service {

  private ?Connection $client = null;

  private function doConnect(): Service {
    if ($this->client == null) {
      $this->client = new Connection();
    }

    try {
      $this->client->tryConnect();
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    return $this;
  }

  public function conn(): PDO {
    return $this->doConnect()
      ->client
      ->conn();
  }

}