<?php

require '../db.php'; // Adjust the path as necessary

header('Content-Type: application/json; charset=UTF-8');

$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

if (!$categoryId) {
    echo json_encode(['success' => false, 'message' => 'Category ID is required']);
    exit;
}

// Adjust the query to left join the guide_translations table and use COALESCE to prioritize translated content
$stmt = $pdo->prepare("
    SELECT g.id, g.slug, g.category_id,
           COALESCE(gt.title, g.title) AS title,
           COALESCE(gt.content, g.content) AS content,
           g.creator_id, g.created_at
    FROM guides g
    LEFT JOIN guide_translations gt ON g.id = gt.guide_id AND gt.language = :lang
    WHERE g.category_id = :categoryId
");
$stmt->execute(['categoryId' => $categoryId, 'lang' => $lang]);
$guides = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($guides) {
    echo json_encode(['success' => true, 'guides' => $guides]);
} else {
    echo json_encode(['success' => false, 'message' => 'No guides found for this category']);
}
