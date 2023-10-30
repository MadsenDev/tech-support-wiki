<?php
// api/settings/create.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if all required fields are set
if (isset($data->name) && isset($data->value)) {
    // Prepare SQL query
    $query = "INSERT INTO settings (name, value) VALUES (?, ?)";
    $stmt = $db->prepare($query);

    // Bind parameters and execute query
    $stmt->execute([$data->name, $data->value]);

    // Check if setting was created
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Setting created successfully."]);
    } else {
        echo json_encode(["message" => "Setting creation failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>