<?php
// api/guides/views/create.php

include_once '../../db.php';

// Get identifier from cookie or generate one based on IP address
$identifier = isset($_COOKIE['unique_user']) ? $_COOKIE['unique_user'] : md5($_SERVER['REMOTE_ADDR']);

$guide_id = $_GET['guide_id'];
$view_time = date("Y-m-d H:i:s");

// Check if the view already exists
$stmt = $db->prepare("SELECT * FROM guide_views WHERE identifier = ? AND guide_id = ?");
$stmt->execute([$identifier, $guide_id]);
$existingView = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$existingView) {
    // Insert new view
    $stmt = $db->prepare("INSERT INTO guide_views (identifier, guide_id, view_time) VALUES (?, ?, ?)");
    $stmt->execute([$identifier, $guide_id, $view_time]);
    echo json_encode(["message" => "New view recorded"]);
} else {
    echo json_encode(["message" => "View already recorded"]);
}
?>