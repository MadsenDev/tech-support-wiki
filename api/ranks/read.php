<?php
// api/ranks/read.php

include_once '../db.php';

$stmt = $db->prepare("SELECT * FROM ranks");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rows);
?>
