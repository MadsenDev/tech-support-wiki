<?php
// api/ranks/rank_permissions/delete.php

// Include database connection
include_once '../../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (!empty($data->rank_id) && !empty($data->permission_id)) {

    // Prepare SQL query to delete rank-permission relationship
    $stmt = $db->prepare("DELETE FROM rank_permissions WHERE rank_id = ? AND permission_id = ?");
    $stmt->execute([$data->rank_id, $data->permission_id]);

    // Check if deletion was successful
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Rank-permission relationship deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete rank-permission relationship"]);
    }

} else {
    echo json_encode(["message" => "Missing or invalid data"]);
}
?>