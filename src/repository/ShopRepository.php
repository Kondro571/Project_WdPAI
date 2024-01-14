<?php

require_once "Repository.php";
require_once __DIR__.'/../moduls/Product.php';
require_once __DIR__.'/../moduls/Pen.php';
require_once __DIR__.'/../moduls/Notebook.php';


class ShopRepository extends Repository {

    
    public function getToys($category,$subCatehory="") :array{
        $stmt = $this->database->connect()->prepare('
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
                zdjecia_produktow z ON p.id= z.produkt_id
            LEFT JOIN
                kategoria k ON p.kategoria_id = k.id
            WHERE 
                k.nazwa = :category
        ');
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();

        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $products = [];
        foreach ($productsData as $productData) {
            $productId = $productData['id'];
        
            // Sprawdź, czy produkt już istnieje w tablicy $products
            $existingProduct = null;
            foreach ($products as $existingProduct) {
                if ($existingProduct->getId() == $productId) {
                    break;
                }
            }
        
            // Jeśli produkt nie istnieje, dodaj nowy produkt do tablicy $products
            if (!$existingProduct) {
                $existingProduct = new Product(
                    $productData['id'],
                    $productData['nazwa'],
                    $productData['producent'],
                    $productData['cena'],
                    $productData['ilosc'],
                    []
                );
                $products[] = $existingProduct;
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
                p.id AS produkt_id, 
                p.nazwa AS produkt_nazwa, 
                p.producent AS produkt_producent, 
                p.cena AS produkt_cena, 
                p.ilosc AS produkt_ilosc, 
                z.id AS zeszyt_id,
                z.rodzaj AS zeszyt_rodzaj,
                z.ilosc_kartek AS zeszyt_ilosc_kartek,
                z.rozmiar AS zeszyt_rozmiar,
                zd.sciezka_do_zdjecia AS zdjecie_sciezka
            FROM 
                produkty p
            LEFT JOIN 
                zeszyty z ON p.id = z.produkt_id
            LEFT JOIN
                zdjecia_produktow zd ON p.id = zd.produkt_id
        ');
    
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $notebooks = [];
        foreach ($productsData as $productData) {
            $productId = $productData['produkt_id'];

            // Sprawdź, czy produkt już istnieje w tablicy $products
            $existingProduct = null;
            foreach ($notebooks as $existingProduct) {
                if ($existingProduct->getId() == $productId) {
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
                p.id AS produkt_id, 
                p.nazwa AS produkt_nazwa, 
                p.producent AS produkt_producent, 
                p.cena AS produkt_cena, 
                p.ilosc AS produkt_ilosc, 
                z.id AS zeszyt_id,
                z.rodzaj AS zeszyt_rodzaj,
                z.ilosc_kartek AS zeszyt_ilosc_kartek,
                z.rozmiar AS zeszyt_rozmiar,
                zd.sciezka_do_zdjecia AS zdjecie_sciezka
            FROM 
                produkty p
            LEFT JOIN 
                dlugopisy d ON p.id = d.produkt_id
            LEFT JOIN
                zdjecia_produktow zd ON p.id = zd.produkt_id
        ');
    
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pens = [];
        foreach ($productsData as $productData) {
            $productId = $productData['produkt_id'];

            // Sprawdź, czy produkt już istnieje w tablicy $products
            $existingProduct = null;
            foreach ($pens as $existingProduct) {
                if ($existingProduct->getId() == $productId) {
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