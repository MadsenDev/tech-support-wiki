<?php

require 'api/db.php'; // Adjust the path as necessary

// Default language
$defaultLang = 'en';

// Extract the full path from the URL
$fullPath = trim($_SERVER['REQUEST_URI'], '/');

// Split the path into segments for more granular control
$pathSegments = explode('/', $fullPath);

// Extract the language code as the first segment
$lang = array_shift($pathSegments);
$lang = in_array($lang, ['en', 'no', 'fr']) ? $lang : $defaultLang;

$translations = @include "translations/{$lang}.php";
$translations = $translations ?: [];

// Check for the presence of guide category and guide slugs
if (!empty($pathSegments) && $pathSegments[0] === 'guides') {
    if (isset($pathSegments[3])) {
        // A specific guide within a category is requested
        $categorySlug = $pathSegments[1]; // The category slug
        $guideSlug = $pathSegments[3]; // The guide slug
        $contentFile = 'guides/view_guide.php'; // Script to display a specific guide
    } elseif (isset($pathSegments[1])) {
        // Only a category is specified, list guides within this category
        $categorySlug = $pathSegments[1];
        $contentFile = 'categories/list_guides.php'; // Script to list guides in a category
    } else {
        // General guides page, possibly listing all categories or featured guides
        $contentFile = 'guides/index.php'; // Script to show general guides page
    }
} else {
    // Default routing for home, contact, etc., based on the modified $pathSegments
    switch ($pathSegments[0] ?? '') {
        case '':
            $contentFile = 'home.php';
            break;
        case 'contact':
            $contentFile = 'contact.php';
            break;
        default:
            $contentFile = '404.php';
            break;
    }
}