<?php

namespace App\Controllers;

use App\Router\Request;
use App\Router\Response;
use App\Services\UserService;

class UserController extends Controller {

  function register(): string {
    $user     = new UserService();
    $response = $user->createUser();

    if ($response === "USERNAME_EXISTS") {
      Response::setStatus(400);
      return $this->json()
                  ->append("code", 400)
                  ->append("message", "username already exists")
                  ->send();
    }

    if ($response === "EMAIL_EXISTS") {
      Response::setStatus(400);
      return $this->json()
                  ->append("code", 400)
                  ->append("message", "email already exists")
                  ->send();
    }

    return $this->json()
                ->append("code", "200")
                ->append("message", "user registered with success")
                ->send();
  }

  function login(): string {
    $username = Request::getData("username");
    $password = Request::getData("password");

    if ($username != "ricdotnet") {
      Response::setStatus(404);
      return $this->json()
                  ->append("code", 404)
                  ->append("message", "wrong username")
                  ->send();
    }

    if ($password != "12345") {
      Response::setStatus(404);
      return $this->json()
                  ->append("code", 404)
                  ->append("message", "wrong password")
                  ->send();
    }

    Response::setStatus(200);
    return $this->json()
                ->append("code", 200)
                ->append("message", "logged in")
                ->send();
  }

  // get user data
  function getUser(): string {
    $response           = (object)[];
    $response->username = "hello user";
    return json_encode($response);
  }

  // testOne
  function testOne() {
    return "hello from test one";
  }

  // testTwo
  function testTwo() {
    return "hello from test two";
  }

}