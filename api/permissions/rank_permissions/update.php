<?php
// api/ranks/rank_permissions/update.php

// Include database connection
include_once '../../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (!empty($data->old_rank_id) && !empty($data->old_permission_id) &&
    !empty($data->new_rank_id) && !empty($data->new_permission_id)) {

    // Delete old rank-permission relationship
    $stmt = $db->prepare("DELETE FROM rank_permissions WHERE rank_id = ? AND permission_id = ?");
    $stmt->execute([$data->old_rank_id, $data->old_permission_id]);

    // Insert new rank-permission relationship
    $stmt = $db->prepare("INSERT INTO rank_permissions (rank_id, permission_id) VALUES (?, ?)");
    $stmt->execute([$data->new_rank_id, $data->new_permission_id]);

    // Check if update was successful
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Rank-permission relationship updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update rank-permission relationship"]);
    }

} else {
    echo json_encode(["message" => "Missing or invalid data"]);
}
?>