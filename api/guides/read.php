<?php
// api/guides/read.php

// Include database connection
include_once '../db.php';

// Prepare SQL query
$query = 'SELECT * FROM guides';
$stmt = $db->prepare($query);

// Execute query
$stmt->execute();

// Fetch results
$guides = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return results as JSON
echo json_encode($guides);
?>