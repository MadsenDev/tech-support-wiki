<?php
// api/categories/read_single.php

// Include database connection
include_once '../db.php';

// Get POST data or Query String
$data = json_decode(file_get_contents("php://input"));
$id = isset($data->id) ? $data->id : (isset($_GET['id']) ? $_GET['id'] : null);

// Check if ID is provided
if (!empty($id)) {
    // Prepare SQL query
    $query = "SELECT * FROM categories WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    $stmt->execute([$id]);

    // Fetch result
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        echo json_encode($category);
    } else {
        echo json_encode(["message" => "Category not found."]);
    }
} else {
    echo json_encode(["message" => "Category ID is required."]);
}
?>