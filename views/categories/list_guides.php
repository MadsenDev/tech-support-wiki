<div id="categoryDetails" class="max-w-4xl mx-auto mt-6 p-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow">
</div>
<div id="guidesList" class="max-w-4xl mx-auto mt-6"></div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const pathSegments = window.location.pathname.split('/').filter(Boolean);
    const slug = pathSegments[pathSegments.length - 1];
    const langCode = pathSegments[0];

    fetch(`/api/categories/get_single.php?slug=${encodeURIComponent(slug)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('categoryDetails').innerHTML = `
                    <h2 class="text-3xl font-bold">${data.category.name}</h2>
                    <p class="mt-2">${data.category.description}</p>`;
                fetchGuides(data.category.id);
            } else {
                console.error(data.message);
            }
        });

    function fetchGuides(categoryId) {
        fetch(`/api/guides/get_by_category.php?category_id=${categoryId}&lang=${langCode}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const guides = data.guides.map(guide => `
                        <div class="md:w-1/2 lg:w-1/3 p-4">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                <div class="p-6">
                                    <a href="/${langCode}/guides/${guide.category_id}/${guide.slug}/view" class="block mt-1 text-lg leading-tight font-medium text-black hover:text-blue-500">${guide.title}</a>
                                    <p class="mt-2 text-gray-600">${guide.content.substring(0, 150)}...</p>
                                </div>
                            </div>
                        </div>
                    `).join('');
                    document.getElementById('guidesList').innerHTML = `<div class="flex flex-wrap -mx-4">${guides}</div>`;
                } else {
                    console.error(data.message);
                    document.getElementById('guidesList').innerHTML = '<p class="text-center text-gray-500 mt-5">No guides found for this category.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching guides:', error);
                document.getElementById('guidesList').innerHTML = '<p class="text-center text-gray-500 mt-5">An error occurred while trying to fetch the guides.</p>';
            });
    }
});
</script>