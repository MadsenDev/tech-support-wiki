<?php
// api/categories/read.php

// Include database connection
include_once '../db.php';

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