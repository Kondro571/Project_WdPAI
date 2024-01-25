<?php

require_once "Repository.php";
require_once __DIR__.'/../moduls/Product.php';



class CarRepository extends Repository {

    public function getCar($suer_ID) :array{

        $stmt = $this->database->connect()->prepare('
            SELECT 
                p.id, 
                p.nazwa, 
                p.producent, 
                p.cena, 
                k.ilosc, 
                z.sciezka_do_zdjecia
            FROM 
                produkty p
            LEFT JOIN 
                zdjecia_produktow z ON p.id = z.produkt_id
            LEFT JOIN
                koszyk k ON p.id = k.produkt_id
            WHERE 
                k.uzytkownik_id = :user_id;

        ');
        $stmt->bindParam(':user_id', $suer_ID, PDO::PARAM_STR);
        $stmt->execute();

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
                $products[] = $existingProduct;
            }

            if ($productData['sciezka_do_zdjecia']) {
                $existingProduct->addPhoto($productData['sciezka_do_zdjecia']);
            }

        }

        return $products;

    }

    public function addToCart($userId,$productId, $quantity) {
        
        $stmt = $this->database->connect()->prepare('
            INSERT INTO koszyk (uzytkownik_id, produkt_id, ilosc) VALUES (:uzytkownik_id, :product_id, :quantity);
        ');
        $_SESSION["a"]="aa";
        $stmt->bindParam(':uzytkownik_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function removeFromCart($userId,$productId) {

        $stmt=$this->database->connect()->prepare("DELETE FROM koszyk WHERE uzytkownik_id=:userId AND produkt_id=:productId");

        

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();


    }

    public function getTotal($userId){
        $stmt=$this->database->connect()->prepare('SELECT public."calculateCartTotals"(:userId)');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;

    }

    public function addOrder($userId,$city,$street, $postalCode, $sum) {
        try {
            $db = $this->database->connect();
            $db->beginTransaction();
    
            // Wstawienie danych zamówienia do tabeli 'zamowienia'
            $orderSql = "INSERT INTO zamowienia (data_,uzytkownik_id,miejscowosc, ulica, kod_pocztowy,data_platnosci,kwota,status_) VALUES (?,?,?,?,?,?, ?, ?)";
            $orderStmt = $db->prepare($orderSql);
            $date=date('Y-m-d H:i:s');
            $orderStmt->execute([$date,$userId,$city, $street, $postalCode,$date,$sum,"do zapłaty"]);
    
            // Pobranie ID ostatnio wstawionego zamówienia
            $orderId = $db->lastInsertId();
    
            // Pobranie produktów z koszyka dla użytkownika
            $cartSql = "SELECT produkt_id, ilosc FROM koszyk WHERE uzytkownik_id = ?";
            $cartStmt = $db->prepare($cartSql);
            $cartStmt->execute([$userId]);
            $cartResult = $cartStmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Wstawienie danych szczegółów zamówienia do tabeli 'szczegoly_zamowien'
            foreach ($cartResult as $row) {
                $productSql = "INSERT INTO szczegoly_zamowien (zamowienie_id, produkt_id, ilosc) VALUES (?, ?, ?)";
                $productStmt = $db->prepare($productSql);
                $productStmt->execute([$orderId, $row['produkt_id'], $row['ilosc']]);
            }
    
            // Usunięcie produktów z koszyka po złożeniu zamówienia
            $deleteCartSql = "DELETE FROM koszyk WHERE uzytkownik_id = ?";
            $deleteCartStmt = $db->prepare($deleteCartSql);
            $deleteCartStmt->execute([$userId]);
    
            // Zatwierdzenie transakcji
            $db->commit();
    
            // Zwróć odpowiedź o sukcesie
            return array('status' => 'success', 'message' => 'Zamówienie zostało dodane do bazy danych');
        } catch (PDOException $e) {
            // W razie błędu cofnij transakcję
            $db->rollBack();
    
            // Zwróć odpowiedź o błędzie
            return array('status' => 'error', 'message' => 'Wystąpił błąd podczas dodawania zamówienia do bazy danych: ' . $e->getMessage());
        }
    }

    public function carCount($userId){
        $stmt=$this->database->connect()->prepare("SELECT COUNT(*) FROM koszyk WHERE uzytkownik_id = :usre_id");
        $stmt->bindParam(':usre_id', $userId, PDO::PARAM_STR);
        $stmt->execute();

        $count= $stmt->fetch(PDO::FETCH_ASSOC);

        return $count['count'];
    }
    
        
}