<?php

require '../vendor/autoload.php';

use Core\Router;

$router = new Router;

$uri = trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');

Router::load('routes.php')->direct($uri,$_SERVER['REQUEST_METHOD']);
