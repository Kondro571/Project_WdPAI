<?php
require_once "Product.php";

Class Notebook extends Product {
    public function __construct($id, $name, $producer, $price, $quantity,$type,$pages,$size,$images) {

        $this->id = $id;
        $this->name = $name;
        $this->producer = $producer;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->type = $type;
        $this->pages = $pages;
        $this->size=$size;
        $this->images = $images;
    }
}