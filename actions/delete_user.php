<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    // Database deletion string executing Cascade properties setup in sql tables
    $stmt = $pdo->prepare("DELETE FROM users WHERE email = ?");
    $stmt->execute([$email]);

    // Send the administrator cleanly back to the User tab
    header("Location: ../admin_route.php");
    exit();
}
