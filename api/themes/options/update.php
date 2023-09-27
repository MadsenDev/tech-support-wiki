<?php
// api/themes/options/update.php

// Include database connection
include_once '../../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if all required fields are set
if (isset($data->id) && isset($data->label) && isset($data->type) && isset($data->name) && isset($data->group_name)) {
    // Prepare SQL query
    $query = "UPDATE theme_options SET label = ?, type = ?, name = ?, group_name = ? WHERE id = ?";
    $stmt = $db->prepare($query);

    // Bind parameters and execute query
    $stmt->execute([$data->label, $data->type, $data->name, $data->group_name, $data->id]);

    // Check if theme option was updated
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Theme option updated successfully."]);
    } else {
        echo json_encode(["message" => "Theme option update failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>