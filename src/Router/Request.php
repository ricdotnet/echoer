<?php

namespace App\Router;

class Request {

  static function getBody() {
    var_dump(http_get_request_body());
  }

}