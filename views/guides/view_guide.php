<div class="flex flex-wrap mx-auto">
    <!-- Main Guide Content -->
    <div id="guideContainer" class="w-full lg:w-3/4 pr-4">
        <h1 id="guideTitle" class="text-4xl font-bold text-center text-gray-900 mt-8 mb-4">Loading...</h1>
        <div id="guideContent" class="bg-white shadow-md rounded-lg overflow-hidden p-8">
            Please wait, the guide is being loaded.
        </div>
    </div>

    <!-- Sidebar for Navigation and Utilities -->
    <div id="guideSidebar" class="w-full md:w-1/4 p-6">
        <div class="sticky top-0">
            <h3 class="font-semibold text-xl mb-4">Guide Tools</h3>
            <!-- Guide Metadata -->
            <div id="guideMetadata" class="mb-4">
                <div id="createdBy" class="text-sm font-medium text-gray-700"></div>
                <div id="createdAt" class="text-sm text-gray-700"></div>
                <div id="updatedBy" class="text-sm font-medium text-gray-700 mt-2"></div>
                <div id="updatedAt" class="text-sm text-gray-700"></div>
            </div>
            <!-- Print Button -->
            <div class="mb-4">
                <button id="printButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Print Guide
                </button>
            </div>
            <!-- Placeholder for dynamic Guide Contents Navigation, potentially filled by JavaScript -->
            <h3 class="font-semibold text-xl mb-4">Guide Contents</h3>
            <ul id="guideNavigation" class="mb-4">
                <!-- Dynamically filled navigation links will go here -->
            </ul>
        </div>
    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const printButton = document.getElementById('printButton');
            printButton.addEventListener('click', printGuide);
            // Function to populate guide navigation with hierarchy
    function populateGuideNavigation() {
        const guideContent = document.getElementById('guideContent');
        const navigation = document.getElementById('guideNavigation');
        // Select both h2 and h3 headings
        const headings = guideContent.querySelectorAll('h2, h3');

        let lastH2Item = null;

        headings.forEach((heading, index) => {
            if (heading.tagName.toLowerCase() === 'h2') {
                // Create an anchor ID and link for h2 headings
                const anchorId = `section-${index}`;
                heading.id = anchorId;

                const navItem = document.createElement('li');
                const navLink = document.createElement('a');
                navLink.href = `#${anchorId}`;
                navLink.textContent = heading.textContent;
                navLink.classList.add('text-blue-500', 'hover:text-blue-700');

                navItem.appendChild(navLink);
                navigation.appendChild(navItem);

                // Update lastH2Item for subsequent h3s to nest under
                lastH2Item = navItem;
            } else if (heading.tagName.toLowerCase() === 'h3' && lastH2Item !== null) {
                // Handle h3 as a nested list under the last h2 item, if any
                const anchorId = `subsection-${index}`;
                heading.id = anchorId;

                // Check if the last H2 item already has a nested list; if not, create it
                let sublist = lastH2Item.querySelector('ul');
                if (!sublist) {
                    sublist = document.createElement('ul');
                    lastH2Item.appendChild(sublist);
                }

                const subNavItem = document.createElement('li');
                const subNavLink = document.createElement('a');
                subNavLink.href = `#${anchorId}`;
                subNavLink.textContent = heading.textContent;
                subNavLink.classList.add('text-blue-400', 'hover:text-blue-600', 'pl-4');

                subNavItem.appendChild(subNavLink);
                sublist.appendChild(subNavItem);
            }
        });
    }

    // Split the pathname by '/' and filter out empty segments
    const pathSegments = window.location.pathname.split('/').filter(segment => segment.trim() !== '');

    // The guide slug is the second to last segment in the URL structure
    const slugIndex = pathSegments.length - 2; // Adjust for 0-based indexing
    const slug = pathSegments[slugIndex];
    const lang = pathSegments[0]; // Assuming the first segment is always the language code

    if (!slug) {
        document.getElementById('guideTitle').innerText = 'Guide Not Found';
        document.getElementById('guideContent').innerText = 'No guide slug provided in the URL.';
        return;
    }

    // Fetch guide details from the API
    fetch(`/api/guides/get_single.php?slug=${encodeURIComponent(slug)}&lang=${encodeURIComponent(lang)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the page content with the guide details
                document.getElementById('guideTitle').innerText = data.guide.title;
                document.getElementById('guideContent').innerHTML = data.guide.content; // Use innerHTML since content is in HTML

                if (data.guide.full_page) {
                    document.getElementById('guideContainer').classList.remove('lg:w-3/4', 'pr-4');
                    document.getElementById('guideSidebar').classList.add('hidden');
                }

                // Populate guide metadata
                document.getElementById('createdBy').textContent = `Created by: ${data.guide.author}`;
                document.getElementById('createdAt').textContent = `On: ${new Date(data.guide.created_at).toLocaleDateString()}`;
                if(data.guide.updater && data.guide.updated_at) { // Check if updater information exists
                    document.getElementById('updatedBy').textContent = `Last updated by: ${data.guide.updater}`;
                    document.getElementById('updatedAt').textContent = `On: ${new Date(data.guide.updated_at).toLocaleDateString()}`;
                } else {
                    document.getElementById('updatedBy').textContent = '';
                    document.getElementById('updatedAt').textContent = '';
                }

                fetchAndDisplayTags(data.guide.id); // Fetch and display tags for the guide
                populateGuideNavigation(); // Populate the guide navigation based on the content
            } else {
                document.getElementById('guideTitle').innerText = 'Guide Not Found';
                document.getElementById('guideContent').innerText = 'The requested guide could not be found.';
            }
        })
        .catch(error => {
            console.error('Error fetching guide:', error);
            document.getElementById('guideTitle').innerText = 'Error';
            document.getElementById('guideContent').innerText = 'An error occurred while trying to fetch the guide.';
        });
});

function printGuide() {
    const title = document.getElementById('guideTitle').innerHTML;
    const content = document.getElementById('guideContent').innerHTML;

    // Create a new window or tab
    const printWindow = window.open('', '_blank');

    // Populate the new window with the title and content, plus any desired styling
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Print Guide</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                h1 { color: #333; }
                /* Add more styling as needed */
            </style>
        </head>
        <body>
            <h1>${title}</h1>
            ${content}
        </body>
        </html>
    `);

    printWindow.document.close(); // Finish writing to the document

    // Wait for the new document to fully load before triggering the print dialog
    printWindow.onload = function() {
        printWindow.focus(); // Focus on the new window to ensure the print dialog appears over it
        printWindow.print(); // Trigger the print dialog
        printWindow.onafterprint = function() {
            printWindow.close(); // Close the new window after printing
        };
    };
}

function fetchAndDisplayTags(guideId) {
    fetch(`/api/tags/get_by_guide.php?guide_id=${guideId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.tags.length > 0) {
                const tagsContainer = document.createElement('div');
                tagsContainer.classList.add('mb-4');
                const tagsTitle = document.createElement('h3');
                tagsTitle.classList.add('font-semibold', 'text-xl', 'mb-4');
                tagsTitle.textContent = 'Tags';
                tagsContainer.appendChild(tagsTitle);
                
                const tagsList = document.createElement('ul');
                tagsList.classList.add('list-disc', 'pl-5');
                data.tags.forEach(tag => {
                    const tagItem = document.createElement('li');
                    tagItem.textContent = tag.name;
                    tagsList.appendChild(tagItem);
                });
                tagsContainer.appendChild(tagsList);
                
                // Append the tags container to the sidebar
                document.getElementById('guideSidebar').appendChild(tagsContainer);
            }
        })
        .catch(error => console.error('Error fetching tags:', error));
}
    </script>