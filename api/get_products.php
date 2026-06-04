<?php
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

// Get query parameters
$search   = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort     = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Base Query
$query = "SELECT * FROM products WHERE 1=1";
$params = [];

// 1. Filter by Search Query (Name or Description)
if ($search !== '') {
    $query .= " AND (name LIKE :search OR description LIKE :search)";
    $params['search'] = '%' . $search . '%';
}

// 2. Filter by Category (Creatine, Protein, BCAA, etc.)
if ($category !== 'all') {
    $query .= " AND category = :category";
    $params['category'] = $category;
}

// 3. Sorting Mechanics
switch ($sort) {
    case 'price_low_high':
        $query .= " ORDER BY price ASC";
        break;
    case 'price_high_low':
        $query .= " ORDER BY price DESC";
        break;
    case 'name_asc':
        $query .= " ORDER BY name ASC";
        break;
    default:
        // Default sorting (e.g., newest or by ID)
        $query .= " ORDER BY id DESC";
        break;
}

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($products);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database query failed: ' . $e->getMessage()]);
}
