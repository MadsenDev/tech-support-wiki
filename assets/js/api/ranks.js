const API_BASE_URL = '/api/ranks';

// Function to create a new rank
export const createRank = async (title, permissions) => {
  try {
    const response = await fetch(`${API_BASE_URL}/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ title, permissions }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating rank:', error);
    return null;
  }
};

// Function to fetch all ranks
export const fetchRanks = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/read.php`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching ranks:', error);
    return null;
  }
};

// Function to fetch a single rank by ID
export const fetchSingleRank = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/read_single.php?id=${id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching rank with ID ${id}:`, error);
    return null;
  }
};

// Function to update a rank
export const updateRank = async (id, title, permissions) => {
  try {
    const response = await fetch(`${API_BASE_URL}/update.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id, title, permissions }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating rank:', error);
    return null;
  }
};

// Function to delete a rank
export const deleteRank = async (id) => {
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
    console.error('Error deleting rank:', error);
    return null;
  }
};