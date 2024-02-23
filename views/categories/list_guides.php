<div id="categoryDetails"></div>
    <div id="guidesList"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryName = 'Computers'; // Example category name

            // Fetch category details
            fetch(`/api/categories/get_single.php?name=${encodeURIComponent(categoryName)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('categoryDetails').innerHTML = `<h2>${data.category.name}</h2><p>${data.category.description}</p>`;
                        // Fetch guides for this category
                        fetchGuides(data.category.id);
                    } else {
                        console.error(data.message);
                    }
                });

            function fetchGuides(categoryId) {
                fetch(`/api/guides/get_by_category.php?category_id=${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const guides = data.guides.map(guide => `<li>${guide.title}</li>`).join('');
                            document.getElementById('guidesList').innerHTML = `<ul>${guides}</ul>`;
                        } else {
                            console.error(data.message);
                        }
                    });
            }
        });
    </script>