<?php
// api/guides/read_single.php

// Include database connection
include_once '../db.php';

// Get POST data or Query String
$data = json_decode(file_get_contents("php://input"));
$id = isset($data->id) ? $data->id : (isset($_GET['id']) ? $_GET['id'] : null);

// Check if ID is provided
if (!empty($id)) {
    // Prepare SQL query
    $query = "SELECT * FROM guides WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    $stmt->execute([$id]);

    // Fetch result
    $guide = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($guide) {
        echo json_encode($guide);
    } else {
        echo json_encode(["message" => "Guide not found."]);
    }
} else {
    echo json_encode(["message" => "Guide ID is required."]);
}
?>