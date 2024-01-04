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
            $user["imie"],
            $user["nazwisko"]
        );
    }

    public function addUser(User $user): void {
        $stat = $this->database->connect()->prepare('
        INSERT INTO uzytkownik (imie, nazwisko, email, haslo, poprzednie_haslo)
        VALUES (?,?,?,?,?);
        ');
        $stat->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPassword()
        ]);

    }
    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM uzytkownik WHERE imie = :name AND nazwisko = :surname AND eamil = :email
        ');
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }
}