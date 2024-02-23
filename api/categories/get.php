<?php

require '../db.php'; // Adjust the path as necessary to where your db.php is located

header('Content-Type: application/json');

try {
    // Fetch all categories
    $stmt = $pdo->query('SELECT * FROM categories ORDER BY parent_id ASC, id ASC');
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
