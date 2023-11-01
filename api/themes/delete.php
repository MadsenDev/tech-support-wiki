<?php
// api/themes/delete.php

include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $id = $data->id;

    $stmt = $db->prepare("DELETE FROM themes WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(["message" => "Theme deleted successfully."]);
} else {
    echo json_encode(["message" => "Missing required fields or invalid data."]);
}
?>