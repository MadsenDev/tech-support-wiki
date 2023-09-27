<?php
// api/themes/options/read_single.php

// Include database connection
include_once '../../db.php';

// Get ID from URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Prepare SQL query
    $query = "SELECT * FROM theme_options WHERE id = ?";
    $stmt = $db->prepare($query);

    // Bind ID and execute query
    $stmt->execute([$id]);

    // Fetch data
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return as JSON
    if ($row) {
        echo json_encode($row);
    } else {
        echo json_encode(["message" => "Theme option not found."]);
    }
} else {
    echo json_encode(["message" => "Missing ID."]);
}
?>