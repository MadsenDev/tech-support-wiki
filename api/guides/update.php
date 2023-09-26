<?php
// api/guides/update.php

// Include database connection
include_once '../db.php';

// Get POST data
$data = json_decode(file_get_contents("php://input"));

// Check if ID and other essential fields are provided
if (!empty($data->id) && !empty($data->title) && !empty($data->content)) {
    $id = $data->id;
    $title = $data->title;
    $content = $data->content;
    $category_id = isset($data->category_id) ? $data->category_id : NULL;
    $full_page = isset($data->full_page) ? $data->full_page : 0;
    $tags = isset($data->tags) ? $data->tags : [];

    // Prepare SQL query for guides
    $query = "UPDATE guides SET title = ?, content = ?, category_id = ?, full_page = ? WHERE id = ?";
    $stmt = $db->prepare($query);

    // Execute query
    if ($stmt->execute([$title, $content, $category_id, $full_page, $id])) {
        // Update tags for this guide
        // First, delete existing tags
        $stmt = $db->prepare("DELETE FROM guide_tags WHERE guide_id = ?");
        $stmt->execute([$id]);

        // Then, add new tags
        foreach ($tags as $tag_id) {
            $query = "INSERT INTO guide_tags (guide_id, tag_id) VALUES (?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$id, $tag_id]);
        }

        echo json_encode(["message" => "Guide was updated."]);
    } else {
        echo json_encode(["message" => "Unable to update guide."]);
    }
} else {
    echo json_encode(["message" => "Data is incomplete."]);
}
?>