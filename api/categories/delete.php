<?php
// api/categories/delete.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID is provided
if (!empty($data->id)) {
    $id = $data->id;

    // Prepare SQL query
    $query = "DELETE FROM categories WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$id])) {
        echo json_encode(["message" => "Category was deleted."]);
    } else {
        echo json_encode(["message" => "Unable to delete category."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}