<?php
// api/users/create.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if all required fields are set
if (
    isset($data->username) &&
    isset($data->password) &&
    isset($data->email)
) {
    // Prepare SQL query
    $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);

    // Bind parameters and execute query
    $stmt->execute([$data->username, password_hash($data->password, PASSWORD_DEFAULT), $data->email]);

    // Check if user was created
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "User created successfully."]);
    } else {
        echo json_encode(["message" => "User creation failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>