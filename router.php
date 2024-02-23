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

// Now, $pathSegments[0] should represent the first content segment (e.g., 'guides') if present
if (!empty($pathSegments) && $pathSegments[0] === 'guides' && isset($pathSegments[1])) {
    // The category name would now be the second segment in the original URL structure
    $categoryName = $pathSegments[1];
    // Assuming guides are further categorized, and you want to list guides within a category
    $contentFile = 'categories/list_guides.php';
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