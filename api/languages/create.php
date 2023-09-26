<?php
// api/languages/create.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if data is valid
if (!empty($data->language) && !empty($data->language_code)) {
    $language = $data->language;
    $language_code = $data->language_code;

    // Prepare SQL query
    $query = "INSERT INTO languages (language, language_code) VALUES (?, ?)";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$language, $language_code])) {
        echo json_encode(["message" => "Language was created."]);
    } else {
        echo json_encode(["message" => "Unable to create language."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>