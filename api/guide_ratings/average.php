<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->guide_id)) {
    $query = "SELECT AVG(rating) as average_rating FROM guide_ratings WHERE guide_id = :guide_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":guide_id", $data->guide_id);
    $stmt->execute();

    $average = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(["average_rating" => $average['average_rating']]);
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>