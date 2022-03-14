<?php

require __DIR__ . '/vendor/autoload.php';

use App\Database\Connection;
use App\Router\Router;

$db = new Connection();

try {
  $db->tryConnect();
} catch (PDOException $e) {
  print "Error: " . $e->getMessage() . "\n";
}

$router = new Router();

$router->registerEndpoint("/home", function () {
  echo "sum shit or smt homepage";
});
$router->registerEndpoint("/about", function () {
  echo "about page then";
});
$router->registerEndpoint("/contact", function () {
  echo "now its time to contact";
});

$router->run();
$router->checkRequestPath();
$router->getEndpoints();