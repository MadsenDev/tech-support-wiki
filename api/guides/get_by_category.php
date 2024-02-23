<?php

require '../db.php'; // Adjust the path as necessary

header('Content-Type: application/json');

$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

if (!$categoryId) {
    echo json_encode(['success' => false, 'message' => 'Category ID is required']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM guides WHERE category_id = :categoryId");
$stmt->execute(['categoryId' => $categoryId]);
$guides = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($guides) {
    echo json_encode(['success' => true, 'guides' => $guides]);
} else {
    echo json_encode(['success' => false, 'message' => 'No guides found for this category']);
}
