<?php

require_once "AppController.php";
require_once __DIR__.'/../moduls/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AdminController extends AppController{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function admin_staf(){
        $info=$this->userRepository->getUsersWithOrders();
        $this-> render("admin_staf",["result"=>$info]);

    }


}