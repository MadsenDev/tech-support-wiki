<?php

require '../db.php'; // Adjust the path as necessary to where your db.php is located

header('Content-Type: application/json; charset=UTF-8');

// Assuming the language code is passed as a query parameter. Default to 'en' if not specified.
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

try {
    // Modify the query to join with the category_translations table and fetch the translated name and description based on the specified language
    $sql = "SELECT c.id, c.parent_id, c.slug, 
                   IFNULL(ct.name, c.name) AS name, 
                   IFNULL(ct.description, c.description) AS description 
            FROM categories c
            LEFT JOIN category_translations ct ON c.id = ct.category_id AND ct.language = :lang
            ORDER BY c.parent_id ASC, c.id ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['lang' => $lang]);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Function to build a nested array of categories and sub-categories
    function buildCategoryHierarchy($categories, $parentId = null) {
        $output = [];
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $children = buildCategoryHierarchy($categories, $category['id']);
                if ($children) {
                    $category['sub_categories'] = $children;
                }
                $output[] = $category;
            }
        }
        return $output;
    }

    // Build the hierarchy
    $categoryHierarchy = buildCategoryHierarchy($categories);

    // Output the categories in JSON format
    echo json_encode(['success' => true, 'categories' => $categoryHierarchy]);

} catch (PDOException $e) {
    // Handle errors
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
