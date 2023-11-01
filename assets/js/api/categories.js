const API_BASE_URL = '/api/categories';

// Function to fetch categories
export const fetchCategories = async () => {
  try {
    console.log('Fetching categories...');
    const response = await fetch(`${API_BASE_URL}/read.php`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching categories:', error);
    return null;
  }
};

// Function to create a new category
export const createCategory = async (name, parent_id, description) => {
  try {
    const response = await fetch(`${API_BASE_URL}/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ name, parent_id, description }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating category:', error);
    return null;
  }
};

// Function to update a category
export const updateCategory = async (id, name, parent_id, description) => {
  try {
    const response = await fetch(`${API_BASE_URL}/update.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id, name, parent_id, description }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating category:', error);
    return null;
  }
};

// Function to delete a category
export const deleteCategory = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/delete.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error deleting category:', error);
    return null;
  }
};

// Function to fetch a single category
export const fetchSingleCategory = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/read_single.php?id=${id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching category with ID ${id}:`, error);
    return null;
  }
};