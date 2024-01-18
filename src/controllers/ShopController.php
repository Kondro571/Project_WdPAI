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

    public function dlugopisy(){
        
        $products = $this->shopRepository->getPens();
        $this-> render("dlugopisy",["produkty" => $products]);

    }

    public function koszyk(){
        
        $this-> render("koszyk");

    }

    public function add_to_cart(){
        if (isset($_POST['productId']) && isset($_POST['quantity'])) {
            // Odczytaj przesyłane wartości
            $productId = $_POST['productId'];
            $quantity = $_POST['quantity'];
            print($productId);
            print($quantity);
            

        }
        print("aaa");
    }

}