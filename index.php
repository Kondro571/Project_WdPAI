<?php
require "Routing.php"



$path = trim($_REQUEST["REQUEST_URI",'/']);
$path = parse_url($path, PHP_URL_PATH)

Routing::get('index','DefaultController')
Routing::get('project','DefaultController')
Routing:::run($path)