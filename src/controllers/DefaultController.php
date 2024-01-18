<?php

require_once "AppController.php";
class DefaultController extends AppController{

    public function login(){
        $this-> render("login");
    }

    public function project(){
        $this-> render("project");

    }
    public function profil(){
        $this-> render("profil");

    }
    public function edytuj_profil(){
        $this-> render("edytuj_profil");

    }
    
}