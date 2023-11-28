<?php
include_once '../db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id)) {
    $query = "SELECT * FROM categories WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $data->id);
    $stmt->execute();

    $category = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($category);
} else {
    echo json_encode(["message" => "Invalid ID."]);
}
?>