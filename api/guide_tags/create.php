<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->guide_id) && isset($data->tag_id)) {
    $query = "INSERT INTO guide_tags (guide_id, tag_id) VALUES (:guide_id, :tag_id)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":guide_id", $data->guide_id);
    $stmt->bindParam(":tag_id", $data->tag_id);

    if($stmt->execute()) {
        echo json_encode(["message" => "Tag added to guide successfully."]);
    } else {
        echo json_encode(["message" => "Failed to add tag to guide."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>