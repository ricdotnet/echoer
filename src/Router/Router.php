<?php

namespace App\Router;

use ReflectionClass as reflect;
use ReflectionException as reflectException;
use ReflectionMethod as reflectMethod;

class Router extends RouterMethods {

  private string $requestPath;
  private string $requestMethod;

  /**
   * Checks the path of the request
   *
   * @return void
   */
  function checkRequestPath() {
    foreach ($this->getRoutes() as $path) {

      $isMatch = $this->matchRoute($path[0]);

      if ($isMatch) {
//        if ($this->requestPath == $path[0]) {
        if ($this->requestMethod != $path[1]) break;

        try {
          $reflector = new reflect($path[2][0]);
          if ($reflector->hasMethod($path[2][1])) {
            $method = new reflectMethod($reflector->getName(), $path[2][1]);
            $data   = $method->invoke($reflector->newInstance());
            Response::setResponse($data);

          } else {
            die("method not found...");
          }
        } catch (reflectException $e) {
          die($e);
        }
        return;
      }
//      }
    }
    $this->set404();
  }

  // TODO: Refactor
  function matchRoute($route): bool|int|null {
//    $route = preg_replace("/\/{(.*?)}/", "/(.*?)", $route);
    $route = preg_replace("/\/[{][a-zA-Z0-9]+[}]/", "/[a-zA-Z0-9]+", $route);
    $uri   = $_SERVER["REQUEST_URI"];
    return boolval(preg_match_all('#^' . $route . '$#', $uri, $matches, PREG_OFFSET_CAPTURE));
  }

//  function checkRequestPath() {
//    foreach ($this->getTop() as $top) {
//      if (!$this->matchTop($top[0])) break;
//
//      foreach ($this->getRoutes() as $path) {
//
////        if ($this->requestMethod != $path[1]) break;
//
//        $this->matchParam();
//
//        $class = new $path[2][0];
//        $fn    = $path[2][1];
//
//        $data = call_user_func(array($class, $fn));
//        Response::setResponse($data);
//
//        return;
//      }
//    }
//
//    $this->set404();
//  }

  // TODO: Refactor
  function getCurrentUri(): string {
    $uri = substr(rawurldecode($_SERVER['REQUEST_URI']), strlen("http://127.0.0.1"));

    // Don't take query params into account on the URL
    if (str_contains($uri, '?')) {
      $uri = substr($uri, 0, strpos($uri, '?'));
    }

    // Remove trailing slash + enforce a slash at the start
    return '/' . trim($uri, '/');
  }

  function matchTop(string $path): bool {
    $requestExploded = explode("/", $this->requestPath);
    $pathExploded    = explode("/", $path);

    return $requestExploded[0] == $pathExploded[0];
  }

  function matchParam() { // (/.*)
    $params = explode("/", $this->requestPath);
  }

  /**
   * Send a 404
   *
   * @return void
   */
  function set404() {
    Response::setStatus(404);
    $response          = (object)[];
    $response->code    = 404;
    $response->message = "page not found";
    $body              = json_encode($response);
    Response::setResponse($body);
  }

  /**
   * Check if the request method is valid
   *
   * @return bool
   */
  function isValidRequestMethod(): bool {
    return preg_match("/(GET)|(POST)|(PUT)|(PATCH)|(DELETE)|(OPTIONS)/", $this->requestMethod);
  }

  /**
   * Run the route...
   *
   * @return void
   */
  function run() {
    // we can also use the Response::header();
//    header("content-type: application/json");
    header("X-Powered-By: Echoer.app");

    $this->requestPath   = $_SERVER["REQUEST_URI"];
    $this->requestMethod = $_SERVER["REQUEST_METHOD"];

    Request::setRequestBody();

    if (!$this->isValidRequestMethod()) {
      $this->set404();
    } else {
      $this->checkRequestPath();
    }

    echo Response::getResponse();
  }
}