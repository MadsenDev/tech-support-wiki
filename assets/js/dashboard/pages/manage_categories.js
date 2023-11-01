import * as CategoriesAPI from '../../api/categories.js';
console.log("categories.js loaded");

document.addEventListener("DOMContentLoaded", async () => {
    console.log("categories.js DOMContentLoaded");
  const categoryForm = document.getElementById('category-form');
  const parentCategorySelect = document.getElementById('parent_id');
  const categoryTableBody = document.getElementById('category-table-body');

  // Fetch and populate categories in the select element
  const categories = await CategoriesAPI.fetchCategories();
  if (categories) {
    categories.forEach(category => {
      const option = document.createElement('option');
      option.value = category.id;
      option.innerText = category.name;
      parentCategorySelect.appendChild(option);
    });
  }

  // Fetch and populate categories in the table
  const populateCategoriesTable = async () => {
    const categories = await CategoriesAPI.fetchCategories();
    categoryTableBody.innerHTML = "";
    if (categories) {
      categories.forEach(category => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${category.id}</td>
          <td>${category.name}</td>
          <td>${category.parent_id ? category.parent_id : "None"}</td>
          <td>${category.description ? category.description : ""}</td>
          <td>
            <button data-id="${category.id}" class="edit-category">Edit</button>
            <button data-id="${category.id}" class="delete-category">Delete</button>
          </td>
        `;
        categoryTableBody.appendChild(row);
      });
    }
  };

  await populateCategoriesTable();

  // Handle form submission
  categoryForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const parent_id = document.getElementById('parent_id').value;
    const description = document.getElementById('description').value;
    const result = await CategoriesAPI.createCategory(name, parent_id, description);
    if (result) {
      alert('Category created successfully!');
      await populateCategoriesTable();
    } else {
      alert('Failed to create category!');
    }
  });
});