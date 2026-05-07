<?php
session_start();

$host = 'localhost';
$db   = 'supplement_store';
$user = 'root'; // Default XAMPP user
$pass = '';     // Default XAMPP password

try {
    // We use PDO because it's secure against SQL injection and easy to use
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection failed: " . $e->getMessage());
}
