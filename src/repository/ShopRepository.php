<?php

require_once "Repository.php";
require_once __DIR__.'/../moduls/Product.php';

class ShopRepository extends Repository {

    
    public function getToys($subCatehory="") :array{
        $stmt = $this->database->connect()->query('SELECT * FROM produkty');
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($productsData as $productData) {
            $products[] = new Product(
                $productData['id'],
                $productData['nazwa'],
                $productData['producent'],
                $productData['cena'],
                $productData['ilosc'],
                $productData['zdjecie_id']
            );
        }

        return $products;


    }


}