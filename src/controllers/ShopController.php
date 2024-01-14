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
    public function zabawki(){
        $products = $this->shopRepository->getToys("zabawka");
        $this-> render("zabawki",["produkty" => $products]);

    }
    public function zeszyty(){
        
        $products = $this->shopRepository->getNotebooks();
        $this-> render("zeszyty",["produkty" => $products]);

    }

}