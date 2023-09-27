<?php
// api/settings/read_single.php

// Include database connection
include_once '../db.php';

// Check if ID is set in URL
if (isset($_GET['id'])) {
    // Prepare SQL query
    $query = "SELECT * FROM settings WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute the query
    $stmt->execute([$_GET['id']]);

    // Fetch row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return setting as JSON
    if ($row) {
        echo json_encode($row);
    } else {
        echo json_encode(["message" => "Setting not found."]);
    }
} else {
    echo json_encode(["message" => "Missing setting ID."]);
}
?>