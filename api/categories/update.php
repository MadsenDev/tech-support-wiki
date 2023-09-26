<?php
// api/categories/update.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID is set
if (isset($data->id)) {
    $id = $data->id;
    $name = $data->name;
    $parent_id = isset($data->parent_id) ? $data->parent_id : NULL;
    $description = isset($data->description) ? $data->description : NULL;

    // Prepare SQL query
    $query = "UPDATE categories SET name = ?, parent_id = ?, description = ? WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$name, $parent_id, $description, $id])) {
        echo json_encode(["message" => "Category was updated."]);
    } else {
        echo json_encode(["message" => "Unable to update category."]);
    }
} else {
    echo json_encode(["message" => "ID is required for updating."]);
}
?>