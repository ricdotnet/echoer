<?php

namespace App\Services;

use App\Router\Request;
use PDO;

class UserService extends Service {

  function createUser(): string|bool {
    $username = Request::getData("username");
    $password = Request::getData("password");
    $email    = Request::getData("email");

    $db = $this->conn();

    if ($this->valueExists($db, "username", $username)) {
      return "USERNAME_EXISTS";
    }

    if ($this->valueExists($db, "email", $email)) {
      return "EMAIL_EXISTS";
    }

    $db->prepare("INSERT INTO user (username, password, email) VALUES (?,?,?)")
       ->execute([$username, $password, $email]);

    return true;
  }

  function loginUser() {

  }

  private function valueExists(PDO $db, string $column, string $value): bool {
    $stmt = $db->prepare("SELECT $column FROM user WHERE $column = ?");
    $stmt->execute([$value]);

//    var_dump($stmt->fetchAll());

    return $stmt->rowCount() > 0;
  }

}