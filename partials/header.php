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
                    <a href="/" class="flex items-center">
                        <img src="/assets/images/handbook_logo.png" alt="Logo" class="h-8 mr-2">
                    </a>
                </div>
                <!-- Navigation Links -->
                <div id="navMenu" class="nav-menu hidden md:flex items-center space-x-4">
                    <!-- Fetch and build categories here -->
                </div>
                <!-- Language Picker -->
                <div class="ml-4 relative">
                    <select id="languagePicker" class="bg-gray-900 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" onchange="changeLanguage(this.value)">
                        <option value="en">English</option>
                        <option value="no">Norsk</option>
                        <option value="es">Español</option>
                        <!-- Add more languages as needed -->
                    </select>
                </div>
                <!-- Login Button -->
                <div>
                    <a id="loginButton" href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-sign-in-alt mr-2"></i><?php echo $translations['login']; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <style>
    /* Additional styling for multi-level dropdown menus */
    .nav-menu .menu-item {
        position: relative;
    }

    .nav-menu .sub-menu {
        display: none;
        position: absolute;
        left: 0;
        top: 100%;
        z-index: 1000; /* Ensure the submenu appears above other content */
    }

    .nav-menu .menu-item:hover > .sub-menu {
        display: block !important;
    }
</style>

<script>
    let currentLangCode = null; // Default language code
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname.split('/');
        currentLangCode = currentPath[1]; // Assuming language code is the first segment after the host
        const languagePicker = document.getElementById('languagePicker');
        
        if (languagePicker && currentLangCode) {
            languagePicker.value = currentLangCode;
        }

        // Set login href
        const loginButton = document.getElementById('loginButton');
        if (loginButton) {
            loginButton.href = `/${currentLangCode}/login`;
        }

    });
    function createMenuItem(category, langCode, isNested = false) {
        const menuItem = document.createElement('div');
        menuItem.classList.add('group', 'relative', 'menu-item');
        
        const menuLink = document.createElement('a');
        menuLink.href = `/${langCode}/guides/${category.slug}`;
        menuLink.classList.add('text-gray-300', 'hover:bg-gray-700', 'hover:text-white', 'px-3', 'py-2', 'rounded-md', 'text-sm', 'font-medium', 'inline-block');
        menuLink.textContent = category.name;
        menuItem.appendChild(menuLink);
        
        if (category.sub_categories && category.sub_categories.length > 0) {
            const subMenu = document.createElement('div');
            subMenu.classList.add('hidden', 'group-hover:block', 'bg-gray-700', 'min-w-full', 'rounded-md', 'shadow-lg', 'sub-menu', 'absolute');
            if (isNested) {
                // For nested submenus, adjust the position to appear to the right
                subMenu.style.left = '100%'; // Position to the right of the parent item
                subMenu.style.top = '0'; // Align the top with the parent item
            } else {
                // For top-level submenus, appear directly below the parent item
                subMenu.style.left = '0';
                subMenu.style.top = '100%';
            }
            category.sub_categories.forEach(subCategory => {
                const subMenuItem = createMenuItem(subCategory, langCode, true); // Pass true for isNested for subcategories
                subMenu.appendChild(subMenuItem);
            });
            menuItem.appendChild(subMenu);
        }
        
        return menuItem;
    }

    fetch(`/api/categories/get.php?lang=${currentLangCode}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.categories) {
                const navMenu = document.getElementById('navMenu');
                data.categories.forEach(category => {
                    const menuItem = createMenuItem(category, currentLangCode);
                    navMenu.appendChild(menuItem);
                });
            }
        })
        .catch(error => console.error('Error loading categories:', error));

        function changeLanguage(languageCode) {
            const currentUrl = window.location.href;
            const pathArray = currentUrl.split('/');
            const protocol = pathArray[0];
            const host = pathArray[2];
            const newPathArray = pathArray.slice(3); // Remove the first three elements (protocol, "", host)
            
            // Check if the first path segment is an existing language code and replace it; if not, add the language code
            const existingLangCode = /^(en|no|es)$/; // Add to this regex pattern based on your available languages
            if (existingLangCode.test(newPathArray[0])) {
                newPathArray[0] = languageCode; // Replace existing language code
            } else {
                newPathArray.unshift(languageCode); // Add language code as the first segment
            }

            const newUrl = `${protocol}//${host}/${newPathArray.join('/')}`;
            window.location.href = newUrl;
        }
</script>