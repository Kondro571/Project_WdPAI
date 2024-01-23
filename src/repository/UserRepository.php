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
        INSERT INTO uzytkownik (email, haslo, poprzednie_haslo, isadmin)
        VALUES (?,?,?,?);
        ');
        $isadmin= $user->isAdmin() ? 1:0;
        $stat->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getPassword(),
            $isadmin,
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

    private function updateExistingDetails(int $userId, array $info) {
        // Tutaj dodaj kod aktualizacji szczegółów użytkownika w bazie danych

            // Przygotuj zapytanie UPDATE
            $updateQuery = "UPDATE szcegoly_uzytkownika 
                            SET imie = :name, 
                                nazwisko = :surname, 
                                telefon = :phone, 
                                miasto = :city, 
                                ulica = :street, 
                                numer = :number, 
                                kod_pocztowy = :postcode 
                            WHERE uzytkownik_id = :user_id";

            // Utwórz przygotowane zapytanie
            $stmt = $this->database->connect()->prepare($updateQuery);

            // Bindeuj parametry
            $stmt->bindParam(':name', $info['name']);
            $stmt->bindParam(':surname', $info['surname']);
            $stmt->bindParam(':phone', $info['phone']);
            $stmt->bindParam(':city', $info['city']);
            $stmt->bindParam(':street', $info['street']);
            $stmt->bindParam(':number', $info['number']);
            $stmt->bindParam(':postcode', $info['postcode']);
            $stmt->bindParam(':user_id', $userId);

            // Wykonaj zapytanie
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