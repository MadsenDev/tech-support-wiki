<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Handbook</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="/assets/css/guide.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <nav class="bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="flex items-center">
                        <img src="/assets/images/handbook_logo.png" alt="Logo" class="h-8 mr-2">
                    </a>
                </div>
                <!-- Navigation Links -->
                <div id="navMenu" class="nav-menu hidden md:flex items-center space-x-4">
                    <!-- Fetch and build categories here -->
                </div>
                <!-- Login Button -->
                <div>
                    <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <style>
    /* Additional styling for dropdown menus */
    .nav-menu .sub-menu {
        display: none; /* Initially hidden */
        position: absolute; /* Position absolutely within the relative parent */
        left: 0; /* Align to the left of the parent item */
        top: 100%; /* Position just below the parent item */
        min-width: 100%; /* Minimum width to match the parent item */
    }
    .nav-menu .menu-item:hover .sub-menu {
        display: block; /* Show on hover */
    }
</style>

<script>
    fetch('/api/categories/get.php')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.categories) {
                const navMenu = document.getElementById('navMenu');
                // Extract the language code from the URL
                const pathSegments = window.location.pathname.split('/').filter(Boolean);
                const langCode = pathSegments[0]; // Assuming the first segment is the language code

                data.categories.forEach(category => {
                    // Main menu item
                    const menuItem = document.createElement('div');
                    menuItem.classList.add('group', 'relative');
                    menuItem.classList.add('menu-item');
                    
                    const menuLink = document.createElement('a');
                    // Prepend the language code to the href
                    menuLink.href = `/${langCode}/guides/${category.slug}`; // Now includes the language code
                    menuLink.classList.add('text-gray-300', 'hover:bg-gray-700', 'hover:text-white', 'px-3', 'py-2', 'rounded-md', 'text-sm', 'font-medium', 'inline-block');
                    menuLink.textContent = category.name;
                    menuItem.appendChild(menuLink);

                    if (category.sub_categories && category.sub_categories.length > 0) {
                        // Sub-menu for sub-categories
                        const subMenu = document.createElement('div');
                        subMenu.classList.add('absolute', 'group-hover:block', 'bg-gray-700', 'min-w-full', 'rounded-md', 'shadow-lg');
                        subMenu.classList.add('sub-menu');

                        category.sub_categories.forEach(subCategory => {
                            const subMenuItem = document.createElement('a');
                            // Prepend the language code to the sub-category link as well
                            subMenuItem.href = `/${langCode}/guides/${category.slug}/${subCategory.slug}`;
                            subMenuItem.classList.add('block', 'px-4', 'py-2', 'text-sm', 'text-gray-300', 'hover:bg-gray-600', 'hover:text-white');
                            subMenuItem.textContent = subCategory.name;
                            subMenu.appendChild(subMenuItem);
                        });
                        
                        menuItem.appendChild(subMenu);
                    }

                    navMenu.appendChild(menuItem);
                });
            }
        })
        .catch(error => console.error('Error loading categories:', error));
</script>