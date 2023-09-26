<?php
// api/tags/update.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID and name are provided
if (!empty($data->id) && !empty($data->name)) {
    $id = $data->id;
    $name = $data->name;

    // Prepare SQL query
    $query = "UPDATE tags SET name = ? WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$name, $id])) {
        echo json_encode(["message" => "Tag was updated."]);
    } else {
        echo json_encode(["message" => "Unable to update tag."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>