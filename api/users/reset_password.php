<?php
// api/users/reset_password.php

include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (!empty($data->token) && !empty($data->new_password)) {
    $token = $data->token;
    $new_password = password_hash($data->new_password, PASSWORD_DEFAULT);

    // Fetch user by token
    $stmt = $db->prepare("SELECT * FROM password_reset_tokens WHERE token = ?");
    $stmt->execute([$token]);
    $reset_data = $stmt->fetch();

    if ($reset_data) {
        // Update the user's password
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$new_password, $reset_data['user_id']]);

        // Remove the used token
        $stmt = $db->prepare("DELETE FROM password_reset_tokens WHERE token = ?");
        $stmt->execute([$token]);

        echo json_encode(["message" => "Password reset successfully"]);
    } else {
        echo json_encode(["message" => "Invalid or expired token"]);
    }
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>