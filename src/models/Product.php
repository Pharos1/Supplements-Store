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

    public function create($name, $description, $price, $image) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        
        $stmt = $this->conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $description, $price, $image);
        return $stmt->execute();
    }

}
