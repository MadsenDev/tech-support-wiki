<?php
// api/languages/read.php

// Include database connection
include_once '../db.php';

// Prepare SQL query
$query = 'SELECT * FROM languages';
$stmt = $db->prepare($query);

// Execute query
$stmt->execute();

// Fetch results
$languages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return results as JSON
echo json_encode($languages);
?>