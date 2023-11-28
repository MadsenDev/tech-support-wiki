<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id) && isset($data->name)) {
    $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($data->name)));

    $query = "UPDATE tags SET name = :name, slug = :slug WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":slug", $slug);
    $stmt->bindParam(":id", $data->id);

    if($stmt->execute()) {
        echo json_encode(["message" => "Tag updated successfully."]);
    } else {
        echo json_encode(["message" => "Tag update failed."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>