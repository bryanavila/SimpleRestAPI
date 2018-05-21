<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../src/config/config.php';
require '../vendor/autoload.php';

$app = new \Slim\App;

require '../src/routes/user.php';
$app->run();
