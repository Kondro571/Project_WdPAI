<?php

require_once "Repository.php";
require_once __DIR__.'/../moduls/User.php';
class UserRepository extends Repository {

    public function getUser(string $email): ?User {
        $stat = $this->database->connect()->prepare('select * from uzytkownik where email =:email');
        $stat->bindParam(":email", $email, PDO::PARAM_STR);
        $stat->execute();
        $user = $stat->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }
        
        return new User(
            $user["email"],
            $user["haslo"],
            $user["isadmin"],
            $user["id"],
        );
    }

    public function addUser(User $user): void {
        $stat = $this->database->connect()->prepare('
        INSERT INTO uzytkownik (email, haslo, poprzednie_haslo)
        VALUES (?,?,?);
        ');

        $stat->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getPassword(),
        ]);

    }
    public function getUserDetailsId(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM szcegoly_uzytkownika WHERE uzytkownik_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data == false) {
            return new UserInfo($id);
        }
        
        return new UserInfo(
            $id,
            $data['imie'],
            $data['nazwisko'],
            $data['telefon'],
            $data['miasto'],
            $data['ulica'],
            $data['numer'],
            $data['kod_pocztowy'],
        );

    }
    public function ifExist(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM szcegoly_uzytkownika WHERE uzytkownik_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data == false) {
            return Null;
        }
        
        return new UserInfo(
            $id,
        );

    }
   

    public function updateUser(int $userId, array $info) {
            $updateQuery = "UPDATE uzytkownik
                SET email = :email
                WHERE id = :user_id";

        $stmt = $this->database->connect()->prepare($updateQuery);

        $stmt->bindParam(':email', $info['email']);
        $stmt->bindParam(':user_id', $userId);

        $stmt->execute();

        $existingDetails = $this->ifExist($userId);
    
        if ($existingDetails) {
            $this->updateExistingDetails($userId, $info);
        } else {
            $this->createNewDetails($userId, $info);
        }
    }
    public function carCount($userId){
        $stmt=$this->database->connect()->prepare("SELECT COUNT(*) FROM koszyk WHERE uzytkownik_id = :usre_id");
        $stmt->bindParam(':usre_id', $userId, PDO::PARAM_STR);
        $stmt->execute();

        $count= $stmt->fetch(PDO::FETCH_ASSOC);

        return $count['count'];
    }

    public function getUsersWithOrders() {
        $stmt = $this->database->connect()->query('
            SELECT 
                u.id AS user_id,
                u.email AS user_email,
                u.isadmin AS user_is_admin,
                z.id AS order_id,
                z.data_ AS order_date,
                z.miejscowosc AS order_location,
                z.ulica AS order_street,
                z.kod_pocztowy AS order_postal_code,
                z.data_platnosci AS order_payment_date,
                z.kwota AS order_amount,
                z.status_ AS order_status,
                s.produkt_id AS product_id,
                s.ilosc AS product_quantity
            FROM 
                uzytkownik u
            LEFT JOIN 
                zamowienia z ON u.id = z.uzytkownik_id
            LEFT JOIN 
                szczegoly_zamowien s ON z.id = s.zamowienie_id
        ');
    
        $result = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $userId = $row['user_id'];
            if (!isset($result[$userId])) {
                $result[$userId] = [
                    'user_id' => $row['user_id'],
                    'user_email' => $row['user_email'],
                    'user_is_admin' => $row['user_is_admin'] === 't',
                    'orders' => []
                ];
            }
    
            if (!empty($row['order_id'])) {
                $result[$userId]['orders'][] = [
                    'order_id' => $row['order_id'],
                    'order_date' => $row['order_date'],
                    'order_location' => $row['order_location'],
                    'order_street' => $row['order_street'],
                    'order_postal_code' => $row['order_postal_code'],
                    'order_payment_date' => $row['order_payment_date'],
                    'order_amount' => $row['order_amount'],
                    'order_status' => $row['order_status'],
                    'product_id' => $row['product_id'],
                    'product_quantity' => $row['product_quantity']
                ];
            }
        }
    
        return $result;
    }
    
    

    private function updateExistingDetails(int $userId, array $info) {

            $updateQuery = "UPDATE szcegoly_uzytkownika 
                            SET imie = :name, 
                                nazwisko = :surname, 
                                telefon = :phone, 
                                miasto = :city, 
                                ulica = :street, 
                                numer = :number, 
                                kod_pocztowy = :postcode 
                            WHERE uzytkownik_id = :user_id";

            $stmt = $this->database->connect()->prepare($updateQuery);

            $stmt->bindParam(':name', $info['name']);
            $stmt->bindParam(':surname', $info['surname']);
            $stmt->bindParam(':phone', $info['phone']);
            $stmt->bindParam(':city', $info['city']);
            $stmt->bindParam(':street', $info['street']);
            $stmt->bindParam(':number', $info['number']);
            $stmt->bindParam(':postcode', $info['postcode']);
            $stmt->bindParam(':user_id', $userId);

            $stmt->execute();
    }
    
    private function createNewDetails(int $userId, array $info) {
        try {
            $query = "INSERT INTO szcegoly_uzytkownika (uzytkownik_id ,imie, nazwisko, telefon, miasto, ulica, numer, kod_pocztowy)
                      VALUES (:user_id, :imie, :nazwisko, :telefon, :miasto, :ulica, :numer, :kod_pocztowy)";
    
            $stmt = $this->database->connect()->prepare($query);
    
            $stmt->bindParam(':user_id', $userId);
     
            $stmt->bindParam(':imie', $info['imie']);
            $stmt->bindParam(':nazwisko', $info['nazwisko']);
            $stmt->bindParam(':telefon', $info['telefon']);
            $stmt->bindParam(':miasto', $info['miasto']);
            $stmt->bindParam(':ulica', $info['ulica']);
            $stmt->bindParam(':numer', $info['numer']);
            $stmt->bindParam(':kod_pocztowy', $info['kod_pocztowy']);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Błąd przy dodawaniu szczegółów użytkownika do bazy danych: " . $e->getMessage();
        }
    }



}