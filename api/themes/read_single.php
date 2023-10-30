<?php
// api/themes/read_single.php

include_once '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $db->prepare("SELECT * FROM themes WHERE id = ?");
    $stmt->execute([$id]);

    $theme = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($theme) {
        echo json_encode(["theme" => $theme]);
    } else {
        echo json_encode(["message" => "Theme not found."]);
    }
} else {
    echo json_encode(["message" => "Missing ID parameter."]);
}
?>