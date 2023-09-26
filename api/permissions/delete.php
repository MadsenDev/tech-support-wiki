<?php
// api/permissions/delete.php

include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (!empty($data->id)) {
    $id = $data->id;

    // Prepare SQL query
    $stmt = $db->prepare("DELETE FROM permissions WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(["message" => "Permission deleted successfully"]);
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>