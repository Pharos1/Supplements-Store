<?php
require 'config.php';

// Simple Security: Only let logged-in users see this (In a real app, you'd check for an 'is_admin' column)
if (!isset($_SESSION['user_id'])) {
    header("Location: login_route.php");
    exit();
}

$content = 'pages/admin_panel.php';
include 'layout.php';
