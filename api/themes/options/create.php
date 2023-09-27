<?php
// api/themes/options/create.php

// Include database connection
include_once '../../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if all required fields are set
if (
    isset($data->label) &&
    isset($data->type) &&
    isset($data->name) &&
    isset($data->group_name)
) {
    // Prepare SQL query
    $query = "INSERT INTO theme_options (label, type, name, group_name) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    // Bind parameters and execute query
    $stmt->execute([$data->label, $data->type, $data->name, $data->group_name]);

    // Check if theme option was created
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Theme option created successfully."]);
    } else {
        echo json_encode(["message" => "Theme option creation failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>