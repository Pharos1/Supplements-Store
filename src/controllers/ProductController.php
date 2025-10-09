<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function listProducts() {
        return $this->productModel->getAll();
    }

    public function addProduct($name, $price, $image) {
        return $this->productModel->create($name, $price, $image);
    }
}

