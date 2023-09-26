<?php
// api/categories/create.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if data is valid
if (!empty($data->name)) {
    $name = $data->name;
    $parent_id = isset($data->parent_id) ? $data->parent_id : NULL;
    $description = isset($data->description) ? $data->description : NULL;

    // Prepare SQL query
    $query = "INSERT INTO categories (name, parent_id, description) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$name, $parent_id, $description])) {
        echo json_encode(["message" => "Category was created."]);
    } else {
        echo json_encode(["message" => "Unable to create category."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>