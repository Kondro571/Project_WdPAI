<?php

require_once "AppController.php";
require_once __DIR__.'/../moduls/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class ProfilController extends AppController{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function profil(){
        $info=$this->userRepository->getUserDetailsId($_SESSION["user_ID"]);
        echo $info->getName();
        $this-> render("profil",["user"=>$info]);

    }
    public function edytuj_profil(){
        if (!$this->isPost()) {
            $info=$this->userRepository->getUserDetailsId($_SESSION["user_ID"]);
            $this-> render("edytuj_profil",["user"=>$info]);
        }else{
                $dataToSave = [
                    'email' => $_POST['email'],
                    'name' => $_POST['imie'],
                    'surname' => $_POST['nazwisko'],
                    'phone'=> $_POST['telefon'],
                    'city' => $_POST['miasto'],
                    'street' => $_POST['ulica'],
                    'number' => $_POST['numer'],
                    'postcode' => $_POST['kod_pocztowy']

                ];


            $this->userRepository->updateUser($_SESSION["user_ID"], $dataToSave);
            $info=$this->userRepository->getUserDetailsId($_SESSION["user_ID"]);
            $this->render("profil",["user"=>$info]);
        }

    }

}