<?php
// api/tags/read.php

// Include database connection
include_once '../db.php';

// Prepare SQL query
$query = 'SELECT * FROM tags';
$stmt = $db->prepare($query);

// Execute query
$stmt->execute();

// Fetch results
$tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return results as JSON
echo json_encode($tags);
?>