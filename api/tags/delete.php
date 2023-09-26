<?php
// api/tags/delete.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID is provided
if (!empty($data->id)) {
    $id = $data->id;

    // Prepare SQL query
    $query = "DELETE FROM tags WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$id])) {
        // Remove associated tags from guide_tags table
        $stmt = $db->prepare("DELETE FROM guide_tags WHERE tag_id = ?");
        $stmt->execute([$id]);

        echo json_encode(["message" => "Tag was deleted."]);
    } else {
        echo json_encode(["message" => "Unable to delete tag."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>