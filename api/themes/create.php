<?php
// api/themes/create.php

include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->title) && isset($data->filename)) {
    $title = $data->title;
    $filename = $data->filename;

    $stmt = $db->prepare("INSERT INTO themes (title, filename) VALUES (?, ?)");
    $stmt->execute([$title, $filename]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Theme created successfully."]);
    } else {
        echo json_encode(["message" => "Theme creation failed."]);
    }
} else {
    echo json_encode(["message" => "Missing required fields."]);
}
?>