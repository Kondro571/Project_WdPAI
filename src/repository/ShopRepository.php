<?php

require_once "Repository.php";
require_once __DIR__.'/../moduls/Product.php';
require_once __DIR__.'/../moduls/Pen.php';
require_once __DIR__.'/../moduls/Notebook.php';


class ShopRepository extends Repository {

    
    public function getAllProduct() :array{
        $stmt = $this->database->connect()->query('
            SELECT 
                p.id, 
                p.nazwa, 
                p.producent, 
                p.cena, 
                p.ilosc, 
                z.sciezka_do_zdjecia
            FROM 
                produkty p
            LEFT JOIN 
                zdjecia_produktow z ON p.id = z.produkt_id
        ');
  

        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = [];
        foreach ($productsData as $productData) {
            $productId = $productData['id'];

            $existingProduct = null;
            for ($i = 0; $i < count($products); $i++) {
                if ($products[$i]->getId() == $productId) {
                    $existingProduct = $products[$i];
                    break;
                }
            }
            
            if (!$existingProduct) {

                $existingProduct = new Product(
                    $productData['id'],
                    $productData['nazwa'],
                    $productData['producent'],
                    $productData['cena'],
                    $productData['ilosc'],
                    []
                );

                array_push($products,$existingProduct);
            }
        
            if ($productData['sciezka_do_zdjecia']) {
                $existingProduct->addPhoto($productData['sciezka_do_zdjecia']);
            }

        }

        return $products;

    }
    public function getProduct($category,$subCatehory="") :array{
        $stmt = $this->database->connect()->prepare('
            SELECT 
                p.id, 
                p.nazwa, 
                p.producent, 
                p.cena, 
                p.ilosc, 
                z.sciezka_do_zdjecia,
                k.nazwa AS nazwa_kategorii
            FROM 
                produkty p
            LEFT JOIN 
                zdjecia_produktow z ON p.id = z.produkt_id
            LEFT JOIN
                produkty_kategorie pk ON p.id = pk.produkt_id
            LEFT JOIN
                kategoria k ON pk.kategoria_id = k.id
            WHERE 
                k.nazwa = :category;
        
        ');
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();

        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = [];
        foreach ($productsData as $productData) {
            $productId = $productData['id'];

            // Sprawdź, czy produkt już istnieje w tablicy $products
            $existingProduct = null;
            for ($i = 0; $i < count($products); $i++) {
                if ($products[$i]->getId() == $productId) {
                    $existingProduct = $products[$i];
                    break;
                }
            }
            
            if (!$existingProduct) {

                $existingProduct = new Product(
                    $productData['id'],
                    $productData['nazwa'],
                    $productData['producent'],
                    $productData['cena'],
                    $productData['ilosc'],
                    []
                );

                array_push($products,$existingProduct);
            }
        
            // Dodaj ścieżkę do zdjęcia do odpowiedniego produktu
            if ($productData['sciezka_do_zdjecia']) {
                $existingProduct->addPhoto($productData['sciezka_do_zdjecia']);
            }
            // if ($productData['zdjecie_sciezka']) {
            //     $photo = new Photo(
            //         $productData['zdjecie_sciezka'],
            //         $productData['opis_zdjecia'] // zakładając, że masz opis zdjęcia w wyniku zapytania
            //     );
            //     $existingProduct->addPhoto($photo);
            // }
        }

        return $products;
        


    }

    public function getNotebooks($subCatehory="") :array{
        $stmt = $this->database->connect()->query('
            SELECT 
                *
            FROM
            widok_zeszyty
        ');
    
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $notebooks = [];
        foreach ($productsData as $productData) {
            $productId = $productData['produkt_id'];

            // Sprawdź, czy produkt już istnieje w tablicy $products
            $existingProduct = null;
         for ($i = 0; $i < count($notebooks); $i++) {
                if ($notebooks[$i]->getId() == $productId) {
                    $existingProduct = $notebooks[$i];
                    break;
                }
            }

            // Jeśli produkt nie istnieje, dodaj nowy produkt do tablicy $products
            if (!$existingProduct) {
                $existingProduct = new Notebook(
                    $productId,
                    $productData['produkt_nazwa'],
                    $productData['produkt_producent'],
                    $productData['produkt_cena'],
                    $productData['produkt_ilosc'],
                    $productData['zeszyt_rodzaj'],
                    $productData['zeszyt_ilosc_kartek'],
                    $productData['zeszyt_rozmiar'],
                    []
                );
                $notebooks[] = $existingProduct;
            }

            // Dodaj ścieżki do zdjęć do odpowiedniego produktu
            if ($productData['zdjecie_sciezka']) {
                $existingProduct->addPhoto($productData['zdjecie_sciezka']);
            }
        }
        
        return $notebooks;
        


    }

    public function getPens($subCatehory="") :array{
        $stmt = $this->database->connect()->query('
            SELECT 
            *
            FROM
            widok_produkty_dlugopisy
        ');
    
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pens = [];
        foreach ($productsData as $productData) {
            $productId = $productData['produkt_id'];

            // Sprawdź, czy produkt już istnieje w tablicy $products
            $existingProduct = null;
            for ($i = 0; $i < count($pens); $i++) {
                if ($pens[$i]->getId() == $productId) {
                    $existingProduct = $pens[$i];
                    break;
                }
            }

            // Jeśli produkt nie istnieje, dodaj nowy produkt do tablicy $products
            if (!$existingProduct) {
                $existingProduct = new Pen(
                    $productId,
                    $productData['produkt_nazwa'],
                    $productData['produkt_producent'],
                    $productData['produkt_cena'],
                    $productData['produkt_ilosc'],
                    $productData['kolor'],
                    []
                );
                $pens[] = $existingProduct;
            }

            // Dodaj ścieżki do zdjęć do odpowiedniego produktu
            if ($productData['zdjecie_sciezka']) {
                $existingProduct->addPhoto($productData['zdjecie_sciezka']);
            }
        }
        
        return $pens;
        


    }




}