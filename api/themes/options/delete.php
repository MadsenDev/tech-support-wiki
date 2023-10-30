<?php
// api/themes/options/delete.php

// Include database connection
include_once '../../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID is set
if (isset($data->id)) {
    // Prepare SQL query
    $query = "DELETE FROM theme_options WHERE id = ?";
    $stmt = $db->prepare($query);

    // Bind ID and execute query
    $stmt->execute([$data->id]);

    // Check if theme option was deleted
    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Theme option deleted successfully."]);
    } else {
        echo json_encode(["message" => "Theme option deletion failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required field: ID."]);
}
?>