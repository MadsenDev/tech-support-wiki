<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->title) && isset($data->content)) {
    $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($data->title)));

    $query = "INSERT INTO guides (title, slug, content, category_id) VALUES (:title, :slug, :content, :category_id)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":title", $data->title);
    $stmt->bindParam(":slug", $slug);
    $stmt->bindParam(":content", $data->content);
    $stmt->bindParam(":category_id", $data->category_id);

    if($stmt->execute()) {
        echo json_encode(["message" => "Guide created successfully."]);
    } else {
        echo json_encode(["message" => "Guide creation failed."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>