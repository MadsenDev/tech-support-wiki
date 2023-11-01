<?php
// api/themes/update.php

include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id) && isset($data->title) && isset($data->filename)) {
    $id = $data->id;
    $title = $data->title;
    $filename = $data->filename;

    $stmt = $db->prepare("UPDATE themes SET title = ?, filename = ? WHERE id = ?");
    $stmt->execute([$title, $filename, $id]);

    echo json_encode(["message" => "Theme updated successfully."]);
} else {
    echo json_encode(["message" => "Missing required fields or invalid data."]);
}
?>