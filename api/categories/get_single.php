<?php

require '../db.php'; // Adjust the path as necessary

header('Content-Type: application/json');

$categoryName = isset($_GET['name']) ? $_GET['name'] : '';

if (!$categoryName) {
    echo json_encode(['success' => false, 'message' => 'Category name is required']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM categories WHERE name = :name LIMIT 1");
$stmt->execute(['name' => $categoryName]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if ($category) {
    echo json_encode(['success' => true, 'category' => $category]);
} else {
    echo json_encode(['success' => false, 'message' => 'Category not found']);
}
