<?php
// api/ranks/delete.php

include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $id = $data->id;

    // Clear existing permissions
    $stmt = $db->prepare("DELETE FROM rank_permissions WHERE rank_id = ?");
    $stmt->execute([$id]);

    // Delete rank
    $stmt = $db->prepare("DELETE FROM ranks WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(["message" => "Rank deleted successfully"]);
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>