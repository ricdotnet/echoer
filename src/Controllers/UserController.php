<?php

namespace App\Controllers;

use App\Router\Request;
use App\Router\Response;

class UserController extends Controller {

  function register(): string {
    $response           = (object)[];
    $response->username = "ricdotnet";
    $response->password = "123456789";
    $response->email    = "me@rrocha.uk";
    $response->message  = "registered!!!";
    return json_encode($response);
  }

  function login(): string {
    $username = Request::getData("username");
    $password = Request::getData("password");

    if ($username != "ricdotnet") {
      Response::setStatus(404);
      return $this->append("code", 404)
                  ->append("message", "wrong username")
                  ->send();
    }

    if ($password != "12345") {
      Response::setStatus(404);
      return $this->append("code", 404)
                  ->append("message", "wrong password")
                  ->send();
    }

    Response::setStatus(200);
    return $this->append("code", 200)
                ->append("message", "logged in")
                ->send();
  }

  function getUser(): string {
    $response           = (object)[];
    $response->username = "ricdotnet";
    $response->email    = "me@rrocha.uk";
    $response->message  = "here is the user data";
    return json_encode($response);
  }

}