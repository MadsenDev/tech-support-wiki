<?php
// api/languages/update.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID and data are provided
if (!empty($data->id) && !empty($data->language) && !empty($data->language_code)) {
    $id = $data->id;
    $language = $data->language;
    $language_code = $data->language_code;

    // Prepare SQL query
    $query = "UPDATE languages SET language = ?, language_code = ? WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$language, $language_code, $id])) {
        echo json_encode(["message" => "Language was updated."]);
    } else {
        echo json_encode(["message" => "Unable to update language."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>