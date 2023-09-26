<?php
// api/ranks/rank_permissions/create.php

// Include database connection
include_once '../../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if all required fields are set
if (isset($data->rank_id) && isset($data->permission_id)) {
    // Prepare SQL query
    $query = "INSERT INTO rank_permissions (rank_id, permission_id) VALUES (?, ?)";
    $stmt = $db->prepare($query);

    // Bind parameters and execute query
    $stmt->execute([$data->rank_id, $data->permission_id]);

    // Check if the rank-permission relationship was created
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Rank permission created successfully."]);
    } else {
        echo json_encode(["message" => "Rank permission creation failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>