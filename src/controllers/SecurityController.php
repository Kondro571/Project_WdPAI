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
        
        $messages=[];
        if (!$user) {
            $messages[]='User with this email does not exist';
        }else if (!password_verify($password, $user->getPassword())) {
            $messages[]='Incorrect password';
            
        }
        if(!empty($messages)){
            return $this->render('login', ['messages'=> $messages]);
        }
        $_SESSION['loggedin'] = True;
        
        $_SESSION['user_ID'] = $user->getId();
        $_SESSION['user_email'] = $user->getEmail();
        $_SESSION['isAdmin'] = $user->isAdmin();
        $amount = $this->userRepository->carCount($_SESSION["user_ID"]);
        $_SESSION["car"]= $amount;

        header("Location: /main"); 
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
    
        $existingUser = $userRepository->getUser($email);
        if ($existingUser !== null) {
            return $this->render("register", ["messages" => ["Użytkownik o podanym e-mailu już istnieje"]]);
        }
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $user = new User($email, $hashedPassword, 0);
        $userRepository->addUser($user);
    
        return $this->render('login', ['messages' => ['Udało się zarejestrować pomyślnie']]);
    }
    
    public function logout()
    {
        session_unset();
        session_destroy();
        

        header("Location: /login"); 
    }

}