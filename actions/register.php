<?php
// 1. Load config (which safely handles the database connection and session_start)
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation safety check
    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../signup_route.php");
        exit();
    }

    // 2. Check if the email address is already taken
    $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->execute([$email]);
    
    if ($checkStmt->fetch()) {
        $_SESSION['error'] = "An account with this email already exists.";
        header("Location: ../signup_route.php");
        exit();
    }

    // 3. Securely hash the password before saving it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // 4. Insert the new user into the database
        // 'is_admin' defaults to FALSE natively based on our database schema update
        $insertStmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insertStmt->execute([$name, $email, $hashedPassword]);

        // Grab the newly created User ID to log them in automatically
        $newUserId = $pdo->lastInsertId();

        // 5. Automatically log the new user into an active session
        $_SESSION['user'] = [
            'id'       => $newUserId,
            'name'     => $name,
            'email'    => $email,
            'is_admin' => false // New signups are standard customers by default
        ];

        // Redirect to shop homepage
        header("Location: ../index.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: ../signup_route.php");
        exit();
    }
} else {
    // Redirect back if accessed directly without POST
    header("Location: ../signup_route.php");
    exit();
}
