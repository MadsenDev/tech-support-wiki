<?php

// Include the routing logic to determine the content file
require 'router.php';

// Include the global site header
include 'partials/header.php'; // Contains the top navigation bar, etc.

echo '<div class="container mx-auto px-4 py-8 flex flex-wrap">';

// Optionally include a sidebar
//include 'partials/sidebar.php'; // Adjust based on your site's structure

// Dynamically include the content based on the router's output
if (file_exists("views/{$contentFile}")) {
    include "views/{$contentFile}";
} else {
    // Fallback in case the content file doesn't exist
    echo '<p>Sorry, the page you are looking for could not be found.</p>';
}

echo '</div>'; // Close the main content container

// Include the global site footer
include 'partials/footer.php'; // Contains footer content, closing HTML tags, etc.

?>