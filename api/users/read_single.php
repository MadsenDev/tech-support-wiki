<?php
// api/users/read_single.php

// Include database connection
include_once '../db.php';

// Get POST data or Query String
$data = json_decode(file_get_contents("php://input"));
$id = isset($data->id) ? $data->id : (isset($_GET['id']) ? $_GET['id'] : null);

// Check if ID is provided
if (!empty($id)) {
    // Prepare SQL query
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    $stmt->execute([$id]);

    // Fetch result
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(["message" => "User not found."]);
    }
} else {
    echo json_encode(["message" => "User ID is required."]);
}
?>