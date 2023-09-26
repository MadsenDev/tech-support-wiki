<?php
// api/tags/create.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if data is valid
if (!empty($data->name)) {
    $name = $data->name;

    // Prepare SQL query
    $query = "INSERT INTO tags (name) VALUES (?)";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$name])) {
        echo json_encode(["message" => "Tag was created."]);
    } else {
        echo json_encode(["message" => "Unable to create tag."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>