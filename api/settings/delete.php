<?php
// api/settings/delete.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID is set
if (isset($data->id)) {
    // Prepare SQL query
    $query = "DELETE FROM settings WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute the query
    if ($stmt->execute([$data->id])) {
        echo json_encode(["message" => "Setting deleted successfully."]);
    } else {
        echo json_encode(["message" => "Setting deletion failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>