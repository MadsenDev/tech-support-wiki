<?php
// api/users/update.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID and other fields are set
if (
    isset($data->id) &&
    isset($data->username) &&
    isset($data->email)
) {
    // Prepare SQL query
    $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $stmt = $db->prepare($query);

    // Bind parameters and execute query
    $stmt->execute([$data->username, $data->email, $data->id]);

    // Check if user was updated
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "User updated successfully."]);
    } else {
        echo json_encode(["message" => "User update failed or no changes made."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>