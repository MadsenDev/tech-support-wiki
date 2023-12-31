<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id)) {
    $query = "DELETE FROM tags WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $data->id);

    if($stmt->execute()) {
        echo json_encode(["message" => "Tag deleted successfully."]);
    } else {
        echo json_encode(["message" => "Tag deletion failed."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>