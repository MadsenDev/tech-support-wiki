<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->name)) {
    $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($data->name)));

    $query = "INSERT INTO tags (name, slug) VALUES (:name, :slug)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":slug", $slug);

    if($stmt->execute()) {
        echo json_encode(["message" => "Tag created successfully."]);
    } else {
        echo json_encode(["message" => "Tag creation failed."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>