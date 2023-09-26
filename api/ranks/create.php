<?php
// api/ranks/create.php

include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (!empty($data->title) && !empty($data->permissions)) {
    $title = $data->title;
    $permissions = $data->permissions;

    // Validate permission IDs
    $validPermissions = [];
    foreach ($permissions as $permission_id) {
        $stmt = $db->prepare("SELECT * FROM permissions WHERE id = ?");
        $stmt->execute([$permission_id]);
        if ($stmt->rowCount() > 0) {
            $validPermissions[] = $permission_id;
        }
    }

    if (empty($validPermissions)) {
        echo json_encode(["message" => "Invalid permission IDs"]);
        exit();
    }

    // Insert new rank
    $stmt = $db->prepare("INSERT INTO ranks (title) VALUES (?)");
    if ($stmt->execute([$title])) {
        $rank_id = $db->lastInsertId();

        // Assign permissions to rank
        foreach ($validPermissions as $permission_id) {
            $stmt = $db->prepare("INSERT INTO rank_permissions (rank_id, permission_id) VALUES (?, ?)");
            if (!$stmt->execute([$rank_id, $permission_id])) {
                echo json_encode(["message" => "Failed to assign permissions"]);
                exit();
            }
        }

        echo json_encode(["message" => "Rank and permissions created successfully"]);
    } else {
        echo json_encode(["message" => "Failed to create rank"]);
    }
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>