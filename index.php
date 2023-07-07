<?php

require ("router/router.php");
require ("controllers/controllers.php");
require ("function.php");

session_start();

$controller = new Controller();
$router = new router();
unset($_SESSION['Artist']);
unset($_SESSION['Album']);
$router->get('/','list');
$router->post('/login','login');
$router->post('/logout','logout');
$router->post('/addmusic','addmusic');
$router->post('/addartist','addartist');
$router->post('/musiclist','musiclist');
$router->post('/artistlist','artistlist');
$router->post('/addplaylist','addplaylist');







$router->routing();
