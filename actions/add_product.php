<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $target_dir = __DIR__ . '/../uploads/';
    $filename = time() . '_' . basename($_FILES["product_image"]["name"]);
    $target_file = $target_dir . $filename;

    // Path to save in the database (starting from the root)
    $db_path = "uploads/" . $filename;

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        // 2. Save to Database
        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $price, $description, $db_path]);

            header("Location: ../index.php?success=product_added");
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
