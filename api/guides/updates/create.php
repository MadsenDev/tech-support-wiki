<?php
// api/guides/updates/create.php

include_once '../../db.php';

$guide_id = $_GET['guide_id'];
$updater_id = $_GET['updater_id']; // This would ideally come from the session
$updated_at = date("Y-m-d H:i:s");

$stmt = $db->prepare("INSERT INTO guide_updates (guide_id, updater_id, updated_at) VALUES (?, ?, ?)");
$stmt->execute([$guide_id, $updater_id, $updated_at]);
echo json_encode(["message" => "Update recorded"]);
?>