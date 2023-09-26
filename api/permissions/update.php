<?php
// api/permissions/update.php

include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (!empty($data->id) && !empty($data->name)) {
    $id = $data->id;
    $name = $data->name;
    $description = !empty($data->description) ? $data->description : null;

    // Prepare SQL query
    $stmt = $db->prepare("UPDATE permissions SET name = ?, description = ? WHERE id = ?");
    $stmt->execute([$name, $description, $id]);

    echo json_encode(["message" => "Permission updated successfully"]);
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>