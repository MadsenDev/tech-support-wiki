<?php
// api/permissions/create.php

include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (!empty($data->name)) {
    $name = $data->name;
    $description = !empty($data->description) ? $data->description : null;

    // Prepare SQL query
    $stmt = $db->prepare("INSERT INTO permissions (name, description) VALUES (?, ?)");
    $stmt->execute([$name, $description]);

    echo json_encode(["message" => "Permission created successfully"]);
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>