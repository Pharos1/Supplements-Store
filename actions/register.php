<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 2. Prepare the SQL statement (prevents SQL injection)
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

    // 3. Execute with data
    try {
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashed_password
        ]);

        // Redirect to a success page or login
        echo "Registration successful! <a href='../index.php'>Go Home</a>";
    } catch (PDOException $e) {
        // Simple error handling (e.g., if email already exists)
        echo "Error: " . $e->getMessage();
    }
}
