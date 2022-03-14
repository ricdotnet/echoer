<?php

namespace App\Router;

class Router {

  private array $paths = [];

  /**
   *
   */
  function registerEndpoint(string $path, $fn) {
    $this->paths[] = $path;
  }

  /**
   * Checks the path of the request
   *
   * @return void
   */
  function checkRequestPath() {
    $requestPath = $_SERVER["REQUEST_URI"];

    print $requestPath;
  }

  /**
   * Run the route...
   *
   * @return void
   */
  function run() {
    echo "running.... <br />";

    $this->checkRequestPath();
  }




  /**
   * Test function
   */
  function getEndpoints() {
    echo count($this->paths);
    foreach ($this->paths as $path) {
      echo $path;
    }
  }

}