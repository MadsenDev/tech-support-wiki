<?php
// api/ranks/update.php

include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->title) && !empty($data->permissions)) {
    $id = $data->id;
    $title = $data->title;
    $permissions = $data->permissions;

    $stmt = $db->prepare("UPDATE ranks SET title = ? WHERE id = ?");
    $stmt->execute([$title, $id]);

    // Clear existing permissions
    $stmt = $db->prepare("DELETE FROM rank_permissions WHERE rank_id = ?");
    $stmt->execute([$id]);

    // Assign new permissions
    foreach ($permissions as $permission_id) {
        $stmt = $db->prepare("INSERT INTO rank_permissions (rank_id, permission_id) VALUES (?, ?)");
        $stmt->execute([$id, $permission_id]);
    }

    echo json_encode(["message" => "Rank updated successfully"]);
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>