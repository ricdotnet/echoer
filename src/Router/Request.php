<?php

namespace App\Router;

use http\Message\Body;

class Request {

  private static $requestBody;

  static function setRequestBody() {
    self::$requestBody = file_get_contents("php://input");
  }

  static function getBody() {
    return self::$requestBody;
  }

  static function getData(string $key) {
    $body = json_decode(self::$requestBody);
    return $body->$key;
  }

}