<?php
// api/settings/read.php

// Include database connection
include_once '../db.php';

// Prepare SQL query
$query = "SELECT * FROM settings";
$stmt = $db->prepare($query);

// Execute query
$stmt->execute();

// Initialize an array to hold the results
$settings_array = [];

// Fetch all rows
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract row
    extract($row);

    // Create setting item
    $setting_item = [
        "id" => $id,
        "name" => $name,
        "value" => $value
    ];

    // Push to settings_array
    array_push($settings_array, $setting_item);
}

// Return settings as JSON
echo json_encode(["settings" => $settings_array]);
?>