<?php
// Załóżmy, że masz odpowiednią konfigurację połączenia z bazą danych

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];

    // Tutaj dodaj kod PHP do zapisywania danych do bazy danych
    // Należy używać parametryzowanych zapytań SQL w celu zabezpieczenia przed SQL Injection
    // Poniżej znajdziesz jedynie ogólny przykład - dostosuj go do swojej struktury bazy danych

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=twoja_baza_danych", "uzytkownik", "haslo");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO koszyk (produkt_id, ilosc) VALUES (?, ?)");
        $stmt->execute([$productId, $quantity]);

        echo "Produkt dodany do koszyka.";
    } catch (PDOException $e) {
        echo "Błąd podczas dodawania do koszyka: " . $e->getMessage();
    }
} else {
    echo "Nieprawidłowe żądanie.";
}
?>
