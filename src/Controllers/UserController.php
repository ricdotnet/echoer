<?php

namespace App\Controllers;

class UserController {

  function register(): string {
    $response           = (object)[];
    $response->username = "ricdotnet";
    $response->password = "123456789";
    $response->email    = "me@rrocha.uk";
    $response->message  = "registered!!!";
    return json_encode($response);
  }

  function login(): string {
    $response           = (object)[];
    $response->username = "ricdotnet";
    $response->password = "123456789";
    $response->message  = "logged in!!!";
    return json_encode($response);
  }

  function getUser(): string {
    $response = (object)[];
    $response->username = "ricdotnet";
    $response->email = "me@rrocha.uk";
    $response->message = "here is the user data";
    return json_encode($response);
  }

}