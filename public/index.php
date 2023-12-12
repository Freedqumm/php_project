<?php

require_once '../vendor/autoload.php';
require '../controller/Router.php';
require '../model/data.php';

$loader = new \Twig\Loader\FilesystemLoader("../view");
$twig = new \Twig\Environment($loader);


$router = new Router($twig);
$router->route();
