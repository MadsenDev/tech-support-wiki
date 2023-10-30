const API_BASE_URL = 'https://api.madsens.dev/tech-support-wiki/settings';

// Function to create a new setting
export const createSetting = async (name, value) => {
  try {
    const response = await fetch(`${API_BASE_URL}/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ name, value }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating setting:', error);
    return null;
  }
};

// Function to fetch settings
export const fetchSettings = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/read.php`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching settings:', error);
    return null;
  }
};

// Function to update a setting
export const updateSetting = async (id, value) => {
  try {
    const response = await fetch(`${API_BASE_URL}/update.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id, value }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating setting:', error);
    return null;
  }
};

// Function to delete a setting
export const deleteSetting = async (id) => {
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
    console.error('Error deleting setting:', error);
    return null;
  }
};

// Function to fetch a single setting
export const fetchSingleSetting = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/read_single.php?id=${id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching setting with ID ${id}:`, error);
    return null;
  }
};