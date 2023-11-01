<?php
// api/themes/read.php

include_once '../db.php';

$stmt = $db->prepare("SELECT * FROM themes");
$stmt->execute();

$themes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["themes" => $themes]);
?>