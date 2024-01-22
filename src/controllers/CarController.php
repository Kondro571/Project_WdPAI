<?php

require_once "AppController.php";
require_once __DIR__.'/../repository/CarRepository.php';

class CarController extends AppController {  

    private $carRepository;
    private $products =[];

    public function __construct()
    {
        parent::__construct();
        $this->carRepository = new CarRepository();
    }

    public function koszyk(){
        $products = $this->carRepository->getCar( $_SESSION['user_ID']);
        $this-> render("koszyk",["produkty" => $products]);

    }

    public function add_to_cart(){
        if (isset($_POST['productId']) && isset($_POST['quantity'])) {
            // Odczytaj przesyłane wartości
            $productId = $_POST['productId'];
            $quantity = $_POST['quantity'];
            $this->carRepository->addToCart($_SESSION["user_ID"],$productId,$quantity);
            print($productId);
            print($quantity);
            

        }
        print("aaa");
    }

    public function order($city,$street, $postalCode, $sum){
        $this->carRepository->addOrder($_SESSION["user_ID"],$city,$street, $postalCode, $sum);
        print("order");

    }
    



}
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $productId = $_POST["productId"];
//     $quantity = $_POST["quantity"];

//     // Tutaj dodaj kod PHP do zapisywania danych do bazy danych
//     // Należy używać parametryzowanych zapytań SQL w celu zabezpieczenia przed SQL Injection
//     // Poniżej znajdziesz jedynie ogólny przykład - dostosuj go do swojej struktury bazy danych

//     try {
//         $pdo = new PDO("mysql:host=localhost;dbname=twoja_baza_danych", "uzytkownik", "haslo");
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         $stmt = $pdo->prepare("INSERT INTO koszyk (produkt_id, ilosc) VALUES (?, ?)");
//         $stmt->execute([$productId, $quantity]);

//         echo "Produkt dodany do koszyka.";
//     } catch (PDOException $e) {
//         echo "Błąd podczas dodawania do koszyka: " . $e->getMessage();
//     }
// } else {
//     echo "Nieprawidłowe żądanie.";
// }
?>
