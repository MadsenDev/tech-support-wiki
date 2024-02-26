<?php

require '../db.php'; // Adjust the path as necessary

header('Content-Type: application/json');

// Change the request to expect a 'slug' parameter instead of 'name'
$categorySlug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (!$categorySlug) {
    echo json_encode(['success' => false, 'message' => 'Category slug is required']);
    exit;
}

// Update the query to select the category by 'slug' instead of 'name'
$stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = :slug LIMIT 1");
$stmt->execute(['slug' => $categorySlug]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if ($category) {
    echo json_encode(['success' => true, 'category' => $category]);
} else {
    echo json_encode(['success' => false, 'message' => 'Category not found']);
}