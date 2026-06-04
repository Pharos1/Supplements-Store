<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // 1. Fetch user data (make sure you are selecting 'is_admin')
    $stmt = $pdo->prepare("SELECT id, name, email, password, created_at, is_admin FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Verify password
    if ($user && password_verify($password, $user['password'])) {
        
        // 3. MAP THE DATA TO THE SESSION HERE 
        // We cast is_admin to a boolean (true/false) for easier handling
        $_SESSION['user'] = [
            'id'       => $user['id'],
            'name'     => $user['name'],
            'email'    => $user['email'],
            'created_at'    => $user['created_at'],
            'is_admin' => (bool)$user['is_admin']
        ];

        // Redirect to homepage or user dashboard
        header("Location: ../index.php");
        exit();
    } else {
        // Handle invalid credentials
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: ../login_route.php");
        exit();
    }
}
