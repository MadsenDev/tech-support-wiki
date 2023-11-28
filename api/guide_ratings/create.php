<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->guide_id) && isset($data->rater_name) && isset($data->rating)) {
    $query = "INSERT INTO guide_ratings (guide_id, rater_name, rating) VALUES (:guide_id, :rater_name, :rating)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":guide_id", $data->guide_id);
    $stmt->bindParam(":rater_name", $data->rater_name);
    $stmt->bindParam(":rating", $data->rating);

    if($stmt->execute()) {
        echo json_encode(["message" => "Rating added successfully."]);
    } else {
        echo json_encode(["message" => "Failed to add rating."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>