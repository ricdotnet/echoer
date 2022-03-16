<?php

require __DIR__ . '/vendor/autoload.php';

use App\Database\Connection;
use App\Router\Router;
use App\Controllers\UserController;

//$db = new Connection();

//try {
//  $db->tryConnect();
//} catch (PDOException $e) {
//  print "Error: " . $e->getMessage() . "\n";
//}

$router = new Router();

//$router->use("/user", UserController::class);

$router->post("/user/register", [UserController::class, "register"]);
$router->post("/user/login", [UserController::class, "login"]);
$router->get("/user/get", [UserController::class, "getUser"]);

$router->run();