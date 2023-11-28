<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->guide_id) && isset($data->commenter_name) && isset($data->comment)) {
    $query = "INSERT INTO guide_comments (guide_id, commenter_name, comment) VALUES (:guide_id, :commenter_name, :comment)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":guide_id", $data->guide_id);
    $stmt->bindParam(":commenter_name", $data->commenter_name);
    $stmt->bindParam(":comment", $data->comment);

    if($stmt->execute()) {
        echo json_encode(["message" => "Comment added successfully."]);
    } else {
        echo json_encode(["message" => "Failed to add comment."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>