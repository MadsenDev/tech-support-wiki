<?php
include_once '../db.php';

$query = "SELECT * FROM tags";
$stmt = $db->prepare($query);
$stmt->execute();

$tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($tags);
?>