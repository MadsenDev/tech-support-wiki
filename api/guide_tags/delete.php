<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->guide_id) && isset($data->tag_id)) {
    $query = "DELETE FROM guide_tags WHERE guide_id = :guide_id AND tag_id = :tag_id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":guide_id", $data->guide_id);
    $stmt->bindParam(":tag_id", $data->tag_id);

    if($stmt->execute()) {
        echo json_encode(["message" => "Tag removed from guide successfully."]);
    } else {
        echo json_encode(["message" => "Failed to remove tag from guide."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>