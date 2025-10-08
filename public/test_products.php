<?php
require_once __DIR__ . '/../src/controllers/ProductController.php';

$controller = new ProductController();
$result = $controller->listProducts();

while ($row = $result->fetch_assoc()) {
    echo $row['name'] . " - $" . $row['price'] . "<br>";
}
