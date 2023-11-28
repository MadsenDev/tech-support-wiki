<?php
include_once '../db.php';
include_once '../authenticate.php';

// Redirect to login page if not authenticated, and to no access page if the user role is not allowed.
$userData = isAuthenticated('#', '#', ['admin']);

$data = json_decode(file_get_contents("php://input"));

if(isset($data->name) && !empty($data->name)) {
    $query = "INSERT INTO categories (name, parent_id, description) VALUES (:name, :parent_id, :description)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":parent_id", $data->parent_id);
    $stmt->bindParam(":description", $data->description);

    if($stmt->execute()) {
        echo json_encode(["message" => "Category created successfully."]);
    } else {
        echo json_encode(["message" => "Category creation failed."]);
    }
} else {
    echo json_encode(["message" => "Invalid data."]);
}
?>