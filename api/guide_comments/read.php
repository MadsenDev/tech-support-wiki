<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->guide_id)) {
    $query = "SELECT * FROM guide_comments WHERE guide_id = :guide_id ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":guide_id", $data->guide_id);
    $stmt->execute();

    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($comments);
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>