<?php
// api/guides/delete.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID is provided
if (!empty($data->id)) {
    $id = $data->id;

    // Prepare SQL query for guides
    $query = "DELETE FROM guides WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$id])) {
        // Remove associated tags from guide_tags table
        $stmt = $db->prepare("DELETE FROM guide_tags WHERE guide_id = ?");
        $stmt->execute([$id]);

        echo json_encode(["message" => "Guide was deleted."]);
    } else {
        echo json_encode(["message" => "Unable to delete guide."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>