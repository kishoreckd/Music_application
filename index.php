<?php

require ("router/router.php");
require ("controllers/controllers.php");
require ("function.php");

session_start();

$controller = new Controller();
$router = new router();

$router->get('/','list');
$router->post('/login','login');
$router->post('/logout','logout');




$router->routing();
