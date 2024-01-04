<?php
require "Routing.php";



$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('','DefaultController');
Routing::get('project','DefaultController');
Routing::post('login','SecurityController');
Routing::post('register','SecurityController');
Routing::post('zabawki','ShopController');
#Routing::post('addProject','ProjectController');

Routing::run($path);