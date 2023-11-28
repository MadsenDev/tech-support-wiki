<?php
include_once '../db.php';

$query = "SELECT * FROM guides";
$stmt = $db->prepare($query);
$stmt->execute();

$guides = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($guides);
?>