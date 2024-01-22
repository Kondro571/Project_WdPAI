<?php
require "Routing.php";



$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('','DefaultController');
Routing::get('project','DefaultController');

Routing::post('login','SecurityController');
Routing::post('register','SecurityController');
Routing::post('logout','SecurityController');

Routing::post('zabawki','ShopController');
Routing::post('zeszyty','ShopController');
Routing::post('dlugopisy','ShopController');
Routing::post('koszyk','CarController');
Routing::post('add_to_cart','CarController');

Routing::post('profil','ProfilController');
Routing::post('edytuj_profil','ProfilController');







#Routing::post('addProject','ProjectController');

Routing::run($path);