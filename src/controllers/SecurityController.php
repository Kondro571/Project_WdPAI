<?php

require_once "AppController.php";
require_once __DIR__.'/../moduls/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login() {
        if (!$this->isPost()) {
            return $this->render('login');
        }
    
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->userRepository->getUser($email);
    
        if (!$user) {
            return $this->render('login', ['messages' => ['User with this email does not exist']]);
        }
    
        // Użyj password_verify do porównania podanego hasła z zapisanym w bazie danych
        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Incorrect password']]);
        }
    
        // Tutaj masz pewność, że e-mail i hasło są poprawne
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location:{$url}/project");
        #return $this->render('project');
    }
    
    public function register() {
        $userRepository = new UserRepository();
    
        if (!$this->isPost()) {
            return $this->render("register");
        }
    
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeat_password"];
    
        if ($password !== $repeatPassword) {
            return $this->render("register", ["messages" => ["Hasła są różne od siebie"]]);
        }
    
        // Sprawdź, czy użytkownik o danym e-mailu już istnieje
        $existingUser = $userRepository->getUser($email);
        if ($existingUser !== null) {
            return $this->render("register", ["messages" => ["Użytkownik o podanym e-mailu już istnieje"]]);
        }
    
        // Twórz nowego użytkownika i dodaj do bazy danych
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $user = new User($email, $hashedPassword, "imie", "nazwisko");
        $userRepository->addUser($user);
    
        return $this->render('register', ['messages' => ['Udało się zarejestrować pomyślnie']]);
    }
    

}