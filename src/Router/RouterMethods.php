<?php

namespace App\Router;

class RouterMethods {

  private array $top = array();
  private array $routes = array();

  function use(string $path, mixed $class) {
    $this->top[] = [$path, $class];
  }

  function get(string $path, mixed $fn) {
    $this->routes[] = [$path, "GET", $fn];
  }

  function post(string $path, mixed $fn) {
    $this->routes[] = [$path, "POST", $fn];
  }

  function delete(string $path, mixed $fn) {
    $this->routes[] = [$path, "DELETE", $fn];
  }

  function patch(string $path, mixed $fn) {
    $this->routes[] = [$path, "PATCH", $fn];
  }

  function options(string $path, mixed $fn) {
    $this->routes[] = [$path, "OPTIONS", $fn];
  }

  function getTop(): array {
    return $this->top;
  }

  function getRoutes(): array {
    return $this->routes;
  }

}