<?php
require "src/controllers/DefaultController.php";

class Routing{
    public static $route;

    public function get($url,$controller){
        self::$route[$url]=$controller;
    }


    public static function run($url){
        $action explode("/",$url)[0]:

        if(array_key_exists($action,self::$routes)){
            die("wrong url");
        }

        $controller = self::$routes[$action];
        $object = new $controller;

        $object ->$action();
    }

}