<?php

// Assuming you have a file `db.php` that initializes a PDO connection `$pdo`
require '../db.php';

header('Content-Type: application/json');

// Retrieve the guide ID from the query string
$guideId = isset($_GET['guide_id']) ? (int)$_GET['guide_id'] : 0;

if ($guideId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid guide ID.']);
    exit;
}

try {
    // Prepare SQL to select tag names by joining guide_tags and tags tables
    $sql = "SELECT t.id, t.name 
            FROM tags t
            JOIN guide_tags gt ON t.id = gt.tag_id
            WHERE gt.guide_id = :guideId";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['guideId' => $guideId]);

    // Fetch all matching records
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($tags) {
        // Tags found for the guide
        echo json_encode(['success' => true, 'tags' => $tags]);
    } else {
        // No tags found for the guide
        echo json_encode(['success' => false, 'message' => 'No tags found for the specified guide.']);
    }
} catch (PDOException $e) {
    // Handle any errors
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
