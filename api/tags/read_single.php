<?php
// api/tags/read_single.php

// Include database connection
include_once '../db.php';

// Get POST data or Query String
$data = json_decode(file_get_contents("php://input"));
$id = isset($data->id) ? $data->id : (isset($_GET['id']) ? $_GET['id'] : null);

// Check if ID is provided
if (!empty($id)) {
    // Prepare SQL query
    $query = "SELECT * FROM tags WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    $stmt->execute([$id]);

    // Fetch result
    $tag = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tag) {
        // Return result as JSON
        echo json_encode($tag);
    } else {
        echo json_encode(["message" => "Tag not found."]);
    }
} else {
    echo json_encode(["message" => "Tag ID is required."]);
}
?>