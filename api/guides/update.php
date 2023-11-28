<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id) && isset($data->title) && isset($data->content) && isset($data->category_id)) {
    $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($data->title)));

    $query = "UPDATE guides SET title = :title, slug = :slug, content = :content, category_id = :category_id WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":title", $data->title);
    $stmt->bindParam(":slug", $slug);
    $stmt->bindParam(":content", $data->content);
    $stmt->bindParam(":category_id", $data->category_id);
    $stmt->bindParam(":id", $data->id);

    if($stmt->execute()) {
        echo json_encode(["message" => "Guide updated successfully."]);
    } else {
        echo json_encode(["message" => "Guide update failed."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>