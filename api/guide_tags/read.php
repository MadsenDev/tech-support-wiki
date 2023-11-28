<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->guide_id)) {
    $query = "SELECT t.* FROM tags t INNER JOIN guide_tags gt ON t.id = gt.tag_id WHERE gt.guide_id = :guide_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":guide_id", $data->guide_id);
    $stmt->execute();

    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tags);
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>