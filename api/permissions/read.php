<?php
// api/permissions/read.php

include_once '../db.php';

$stmt = $db->prepare("SELECT * FROM permissions");
$stmt->execute();

$permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($permissions);
?>