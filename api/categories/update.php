<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id) && isset($data->name)) {
    $query = "UPDATE categories SET name = :name, parent_id = :parent_id, description = :description WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":parent_id", $data->parent_id);
    $stmt->bindParam(":description", $data->description);
    $stmt->bindParam(":id", $data->id);

    if($stmt->execute()) {
        echo json_encode(["message" => "Category updated successfully."]);
    } else {
        echo json_encode(["message" => "Category update failed."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>