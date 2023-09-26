<?php
// api/users/delete.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID is set
if (isset($data->id)) {
    // Prepare SQL query
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $db->prepare($query);

    // Bind parameters and execute query
    $stmt->execute([$data->id]);

    // Check if user was deleted
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "User deleted successfully."]);
    } else {
        echo json_encode(["message" => "User deletion failed."]);
    }
} else {
    echo json_encode(["message" => "User ID is required."]);
}
?>