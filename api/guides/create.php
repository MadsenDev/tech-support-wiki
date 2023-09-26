<?php
// api/guides/create.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if data is valid
if (!empty($data->title) && !empty($data->creator_id) && !empty($data->content)) {
    $title = $data->title;
    $creator_id = $data->creator_id;
    $category_id = isset($data->category_id) ? $data->category_id : NULL;
    $content = $data->content;
    $full_page = isset($data->full_page) ? $data->full_page : 0;
    $tags = isset($data->tags) ? $data->tags : [];

    // Prepare SQL query for guides
    $query = "INSERT INTO guides (title, creator_id, category_id, content, full_page) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$title, $creator_id, $category_id, $content, $full_page])) {
        $guide_id = $db->lastInsertId();

        // Associate tags with the new guide
        foreach ($tags as $tag_id) {
            $query = "INSERT INTO guide_tags (guide_id, tag_id) VALUES (?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$guide_id, $tag_id]);
        }

        echo json_encode(["message" => "Guide was created.", "guide_id" => $guide_id]);
    } else {
        echo json_encode(["message" => "Unable to create guide."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>