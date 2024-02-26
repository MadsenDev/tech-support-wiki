<div class="flex flex-wrap mx-auto">
    <!-- Main Guide Content -->
    <div id="guideContainer" class="w-full lg:w-3/4 pr-4">
        <h1 id="guideTitle" class="text-4xl font-bold text-center text-gray-900 mt-8 mb-4">Loading...</h1>
        <div id="guideContent" class="bg-white shadow-md rounded-lg overflow-hidden p-8">
            Please wait, the guide is being loaded.
        </div>
    </div>

    <!-- Sidebar for Navigation and Utilities -->
    <div class="w-full md:w-1/4 p-6">
        <div class="sticky top-0">
            <h3 class="font-semibold text-xl mb-4">Guide Tools</h3>
            <!-- Language Selection Dropdown -->
            <div class="mb-4">
                <label for="language-select" class="block text-sm font-medium text-gray-700">Change Language</label>
                <select id="language-select" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option>English</option>
                    <option>Spanish</option>
                    <option>French</option>
                    <!-- More languages as needed -->
                </select>
            </div>
            <!-- Print Button -->
            <div class="mb-4">
                <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
    </script>