<?php
require_once "Product.php";

Class Pen extends Product {
    public function __construct($id, $name, $producer, $price, $quantity,$color, $images) {

        $this->id = $id;
        $this->name = $name;
        $this->producer = $producer;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->color = $color;
        $this->images = $images;
    }
}