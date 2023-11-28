<?php
include_once '../db.php';

$query = "SELECT * FROM categories";
$stmt = $db->prepare($query);
$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($categories);
?>