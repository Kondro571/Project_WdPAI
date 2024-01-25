<?php

require_once "AppController.php";
require_once __DIR__.'/../repository/ShopRepository.php';

class ShopController extends AppController {  

    private $shopRepository;
    private $products =[];

    public function __construct()
    {
        parent::__construct();
        $this->shopRepository = new ShopRepository();
    }
    public function main(){
        $products = $this->shopRepository->getAllProduct();
        $this-> render("zabawki",["produkty" => $products]);

    }

    public function zabawki(){
        $products = $this->shopRepository->getProduct("zabawka");
        $this-> render("zabawki",["produkty" => $products]);

    }

    public function pluszaki(){
        $products = $this->shopRepository->getProduct("pluszak");
        $this-> render("zabawki",["produkty" => $products]);

    }
    public function karciane(){
        $products = $this->shopRepository->getProduct("karty");
        $this-> render("zabawki",["produkty" => $products]);

    }
    public function papiernicze(){
        $products = $this->shopRepository->getProduct("papiernicze");
        $this-> render("zabawki",["produkty" => $products]);

    }
    public function bloki(){
        $products = $this->shopRepository->getProduct("bloki");
        $this-> render("zabawki",["produkty" => $products]);

    }
    public function inne(){
        $products = $this->shopRepository->getProduct("inne");
        $this-> render("zabawki",["produkty" => $products]);

    }

    public function baterie(){
        $products = $this->shopRepository->getProduct("baterie");
        $this-> render("zabawki",["produkty" => $products]);

    }

    public function kartki(){
        $products = $this->shopRepository->getProduct("kartki");
        $this-> render("zabawki",["produkty" => $products]);

    }

    public function zeszyty(){
        
        $products = $this->shopRepository->getNotebooks();
        $this-> render("zeszyty",["produkty" => $products]);

    }

    public function dlugopisy(){
        
        $products = $this->shopRepository->getPens();
        $this-> render("dlugopisy",["produkty" => $products]);

    }


    


}