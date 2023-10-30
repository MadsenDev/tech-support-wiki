<?php
// api/themes/options/read.php

// Include database connection
include_once '../../db.php';

// Prepare SQL query
$query = "SELECT * FROM theme_options";
$stmt = $db->prepare($query);

// Execute query
$stmt->execute();

// Initialize array to store theme options
$theme_options = [];

// Fetch data
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($theme_options, $row);
}

// Return as JSON
echo json_encode($theme_options);
?>