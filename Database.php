<?php
require_once "config.php";

class Database{
    private $user;
    private $password;
    private $database;
    private $host;
    public function __construct(){
        $this->user = user;
        $this->password = password;
        $this->database = database;
        $this->host = host;

    }

    public function connect(){
        try{

            $pdo = new PDO("pgsql:host=$this->host;port=5432;dbname=$this->database",
            $this->user,
            $this->password,
            ["sslmode"=>"prefet"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){

            die("wyjatek: ". $e->getMessage());

        }
    }
}