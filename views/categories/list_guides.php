<div id="categoryDetails" class="max-w-4xl mx-auto mt-6"></div>
<div id="guidesList" class="max-w-4xl mx-auto mt-6"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Extract the category slug from the URL path
    const pathSegments = window.location.pathname.split('/').filter(segment => segment.trim() !== '');
    const slug = pathSegments[pathSegments.length - 1];

    // Fetch category details
    fetch(`/api/categories/get_single.php?slug=${encodeURIComponent(slug)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Use Tailwind CSS for styling category details
                document.getElementById('categoryDetails').innerHTML = `
                    <h2 class="text-2xl font-semibold">${data.category.name}</h2>
                    <p class="mt-2 text-gray-600">${data.category.description}</p>`;
                // Fetch guides for this category
                fetchGuides(data.category.id);
            } else {
                console.error(data.message);
            }
        });

        function fetchGuides(categoryId) {
            const pathSegments = window.location.pathname.split('/').filter(Boolean);
            const langCode = pathSegments[0];
            fetch(`/api/guides/get_by_category.php?category_id=${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Use card layout for guides
                        const guides = data.guides.map(guide => `
                            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl my-4">
                                <div class="md:flex">
                                    <div class="p-8">
                                        <a href="/${langCode}/guides/${slug}/${guide.slug}/view" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">${guide.title}</a>
                                        <p class="mt-2 text-gray-500">${guide.created_at || 'No description available'}</p>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                        document.getElementById('guidesList').innerHTML = guides;
                    } else {
                        console.error(data.message);
                    }
                });
        }
});
</script>