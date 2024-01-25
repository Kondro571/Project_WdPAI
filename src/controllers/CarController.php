<?php

require_once "AppController.php";
require_once __DIR__.'/../repository/CarRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';


class CarController extends AppController {  

    private $carRepository;
    private $products =[];

    public function __construct()
    {
        parent::__construct();
        $this->carRepository = new CarRepository();
        $this->userRepository = new UserRepository();
    }

    public function koszyk(){
        $products = $this->carRepository->getCar( $_SESSION['user_ID']);
        $this-> render("koszyk",["produkty" => $products]);

    }
    public function order(){
        $info=$this->userRepository->getUserDetailsId($_SESSION["user_ID"]);
        $total=$this->carRepository->getTotal($_SESSION["user_ID"]);
        $this-> render("order",["user"=>$info,"total"=>$total["calculateCartTotals"]]);

    }

    public function add_to_cart(){

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {

            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $productId = $decoded['productId'];
            $quantity = $decoded['quantity'];

            $this->carRepository->addToCart($_SESSION["user_ID"],$productId,$quantity);

            
            http_response_code(200);
        }

        
    }


    public function remove_from_cart(){


        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            
       
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $productId = $decoded['productId'];


            $this->carRepository->removeFromCart($_SESSION["user_ID"],$productId);

            $total=$this->carRepository->getTotal($_SESSION["user_ID"]);
            echo json_encode([ 'total' => $total["calculateCartTotals"]]);

            
            http_response_code(200);
        }


    }


    public function add_order(){

        if (!$this->isPost()) {
            $info=$this->userRepository->getUserDetailsId($_SESSION["user_ID"]);
            $total=$this->carRepository->getTotal($_SESSION["user_ID"]);
            $this-> render("order",["user"=>$info,"total"=>$total["calculateCartTotals"]]);
        }else{
                
                // 'email' => $_POST['email'],
                // 'name' => $_POST['imie'],
                // 'surname' => $_POST['nazwisko'],
                // 'phone'=> $_POST['telefon'],
                // 'number' => $_POST['numer'],
                $city= $_POST['miasto'];
                $street= $_POST['ulica'];
                
                $postalCode = $_POST['kod_pocztowy'];

             
                    $total=$this->carRepository->getTotal($_SESSION["user_ID"]);
        $this->carRepository->addOrder($_SESSION["user_ID"],$city,$street, $postalCode, $total["calculateCartTotals"]);
        print("order");

        }
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
