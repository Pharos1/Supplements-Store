<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json');

// Limit searching scope to active session admins if needed for enterprise hardening
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$query = "SELECT id, name, email, is_admin FROM users WHERE 1=1";
$params = [];

if ($search !== '') {
    $query .= " AND (name LIKE :search OR email LIKE :search)";
    $params['search'] = '%' . $search . '%';
}

$query .= " ORDER BY is_admin DESC, name ASC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
