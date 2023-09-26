import { fetchCategories } from './api/categories.js';

document.addEventListener('DOMContentLoaded', async () => {
  const categories = await fetchCategories();
  console.log(categories);
});