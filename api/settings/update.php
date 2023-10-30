<?php
// api/settings/update.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID and value are set
if (isset($data->id) && isset($data->value)) {
    // Prepare SQL query
    $query = "UPDATE settings SET value = ? WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute the query
    if ($stmt->execute([$data->value, $data->id])) {
        echo json_encode(["message" => "Setting updated successfully."]);
    } else {
        echo json_encode(["message" => "Setting update failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>