<?php
// api/categories/read.php

// Include database connection
include_once '../db.php';

// Include API key functions
include_once '../api_key.php';

// Validate internal API key
if (!validateInternalApiKey($db)) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);
    exit;
}

// Set Content-Type
header('Content-Type: application/json');

// Prepare SQL query
$query = 'SELECT * FROM categories';
$stmt = $db->prepare($query);

// Execute query
$stmt->execute();

// Fetch results
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return results as JSON
echo json_encode($categories);
?>