document.addEventListener('DOMContentLoaded', function() {
    // Mock data with categories and markdown formatted solutions
    const categories = ['Networking', 'Printing', 'Software', 'Hardware'];
    const mockDatabase = [
        { id: 1, category: 'Networking', issue: "Can't connect to Wi-Fi", solution: "Ensure your router is powered on. Try **resetting** your router." },
        { id: 2, category: 'Printing', issue: "Printer not detected", solution: "Check if the printer is turned on and connected to the same network." },
        // Add more issues
    ];

    // Load categories and issues initially
    loadCategories();
    displayIssues(mockDatabase);

    function loadCategories() {
        const categoriesContainer = document.getElementById('categories');
        categoriesContainer.innerHTML = categories.map(category => `<button onclick="filterByCategory('${category}')" class="block w-full text-left p-2 hover:bg-gray-100">${category}</button>`).join('');
    }

    function displayIssues(issues) {
        const issuesList = document.getElementById('issuesList');
        issuesList.innerHTML = issues.map(issue => `<div class="p-4 bg-white rounded-lg shadow">${issue.issue}</div>`).join('');
    }

    function filterByCategory(category) {
        const filteredIssues = mockDatabase.filter(issue => issue.category === category);
        displayIssues(filteredIssues);
    }

    function liveSearch() {
        const searchText = document.getElementById('searchInput').value.toLowerCase();
        const filteredIssues = mockDatabase.filter(issue => issue.issue.toLowerCase().includes(searchText));
        displayIssues(filteredIssues);
    }
});