<?php
// api/permissions/read_single.php

include_once '../db.php';

$id = $_GET['id'];

$stmt = $db->prepare("SELECT * FROM permissions WHERE id = ?");
$stmt->execute([$id]);

$permission = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($permission);
?>