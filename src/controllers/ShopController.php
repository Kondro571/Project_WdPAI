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
        $products = $this->shopRepository->getToys();
        $this-> render("zabawki",["zabawki" => $products]);

    }


}