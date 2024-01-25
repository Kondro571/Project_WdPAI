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
Routing::post('pluszaki','ShopController');
Routing::post('pluszaki','ShopController');
Routing::post('karciane','ShopController');
Routing::post('papiernicze','ShopController');
Routing::post('bloki','ShopController');
Routing::post('inne','ShopController');
Routing::post('baterie','ShopController');
Routing::post('kartki','ShopController');
Routing::post('main','ShopController');




Routing::post('zeszyty','ShopController');
Routing::post('dlugopisy','ShopController');

Routing::post('koszyk','CarController');
Routing::post('order','CarController');

Routing::post('add_to_cart','CarController');
Routing::post('remove_from_cart','CarController');

Routing::post('admin_staf','AdminController');



Routing::post('profil','ProfilController');
Routing::post('edytuj_profil','ProfilController');







#Routing::post('addProject','ProjectController');

Routing::run($path);