<?php
require '../config.php';

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ADD TO CART
if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];
    // Add the product ID to the session array
    $_SESSION['cart'][] = $id;
    header("Location: ../index.php?status=added");
}

// REMOVE FROM CART
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    unset($_SESSION['cart'][$index]);
    // Re-index the array so there are no gaps
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: ../cart_route.php");
}
