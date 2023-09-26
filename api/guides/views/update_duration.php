<?php
// api/guides/views/update_duration.php

include_once '../../db.php';

$identifier = $_COOKIE['unique_user'];
$guide_id = $_GET['guide_id'];
$duration = $_GET['duration'];  // Duration in seconds

// Update the duration
$stmt = $db->prepare("UPDATE guide_views SET duration = ? WHERE identifier = ? AND guide_id = ?");
$stmt->execute([$duration, $identifier, $guide_id]);
echo json_encode(["message" => "Duration updated"]);
?>