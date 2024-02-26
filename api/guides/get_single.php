<?php

require '../db.php'; // Adjust according to your actual path
require '../../vendor/autoload.php'; // Adjust the path to Composer's autoload file as necessary

header('Content-Type: application/json; charset=UTF-8');

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Initialize Parsedown
$parsedown = new Parsedown();

if (empty($slug)) {
    echo json_encode(['success' => false, 'message' => 'Guide slug is required.']);
    exit;
}

try {
    $guide = null;
    // Include the author (creator's username) in the SELECT clause
    if ($lang !== 'en') {
        $stmt = $pdo->prepare("SELECT gt.title, gt.content, g.slug, g.full_page, g.id, u.username AS updater, gu.updated_at, creator.username AS author
                               FROM guide_translations gt
                               INNER JOIN guides g ON gt.guide_id = g.id
                               LEFT JOIN guide_updates gu ON g.id = gu.guide_id
                               LEFT JOIN users u ON gu.updater_id = u.id
                               LEFT JOIN users creator ON g.creator_id = creator.id
                               WHERE g.slug = :slug AND gt.language = :lang
                               ORDER BY gu.updated_at DESC LIMIT 1");
        $stmt->execute(['slug' => $slug, 'lang' => $lang]);
        $guide = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (empty($guide) || $lang === 'en') {
        $stmt = $pdo->prepare("SELECT g.title, g.content, g.slug, g.created_at, g.id, u.username AS updater, gu.updated_at, creator.username AS author
                               FROM guides g
                               LEFT JOIN guide_updates gu ON g.id = gu.guide_id
                               LEFT JOIN users u ON gu.updater_id = u.id
                               LEFT JOIN users creator ON g.creator_id = creator.id
                               WHERE g.slug = :slug
                               ORDER BY gu.updated_at DESC LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $guide = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($guide) {
        // Convert Markdown content to HTML
        $guide['content'] = $parsedown->text($guide['content']);
        echo json_encode(['success' => true, 'guide' => $guide]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Guide not found.']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}