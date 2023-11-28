<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id) && isset($data->comment)) {
    $query = "UPDATE guide_comments SET comment = :comment WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":comment", $data->comment);
    $stmt->bindParam(":id", $data->id);

    if($stmt->execute()) {
        echo json_encode(["message" => "Comment updated successfully."]);
    } else {
        echo json_encode(["message" => "Comment update failed."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>