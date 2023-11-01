<?php
// api/users/login.php

include_once '../db.php';

session_start();

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (!empty($data->username) && !empty($data->password)) {
    $username = $data->username;
    $password = $data->password;

    // Prepare SQL query to fetch user
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Validate password
    if ($user && password_verify($password, $user['password'])) {
        // Start session and set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        echo json_encode(["message" => "Login successful", "user_id" => $user['id']]);
    } else {
        echo json_encode(["message" => "Invalid username or password"]);
    }
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>