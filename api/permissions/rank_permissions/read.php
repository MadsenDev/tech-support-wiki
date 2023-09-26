<?php
// api/ranks/rank_permissions/read.php

// Include database connection
include_once '../../db.php';

// Prepare SQL query to fetch rank-permission relationships
$query = "SELECT rp.rank_id, rp.permission_id, r.title as rank_title, p.name as permission_name
          FROM rank_permissions rp
          INNER JOIN ranks r ON rp.rank_id = r.id
          INNER JOIN permissions p ON rp.permission_id = p.id";
$stmt = $db->prepare($query);

// Execute the query
$stmt->execute();

// Fetch data
$num = $stmt->rowCount();

// Check if any rank-permission relationships are found
if ($num > 0) {
    $rank_permissions_arr = [];
    $rank_permissions_arr['data'] = [];

    // Fetch the results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $rank_permission_item = [
            "rank_id" => $rank_id,
            "permission_id" => $permission_id,
            "rank_title" => $rank_title,
            "permission_name" => $permission_name
        ];

        array_push($rank_permissions_arr['data'], $rank_permission_item);
    }

    // Return the results
    echo json_encode($rank_permissions_arr);
} else {
    echo json_encode(["message" => "No rank-permission relationships found"]);
}
?>