<?php
require_once __DIR__ . '/../database/Database.php';

class Product {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $sql = "SELECT * FROM products";
        return $this->conn->query($sql);
    }

    public function create($name, $price, $image) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $name, $price, $image);
        return $stmt->execute();
    }

}
