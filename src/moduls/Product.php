<?php

class Product {
    protected $id;
    
    protected $name;
    protected $producer;
    protected $price;
    protected $quantity;
    protected $images =[];

    function __construct($id, $name, $producer, $price, $quantity, $images) {
        $this->id = $id;
        $this->name = $name;
        $this->producer = $producer;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->images = $images;
    }

    public function getId() {  
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getProducer() {
        return $this->producer;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getImages() {
        return $this->images;
    }

    public function addPhoto($photo) {
        $this->images[] = $photo;
    }
}

