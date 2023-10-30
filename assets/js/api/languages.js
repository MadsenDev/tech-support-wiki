const API_BASE_URL = 'https://api.madsens.dev/tech-support-wiki/languages';

// Function to create a new language
export const createLanguage = async (language, language_code) => {
  try {
    const response = await fetch(`${API_BASE_URL}/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ language, language_code }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating language:', error);
    return null;
  }
};

// Function to fetch all languages
export const fetchLanguages = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/read.php`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching languages:', error);
    return null;
  }
};

// Function to fetch a single language
export const fetchSingleLanguage = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/read_single.php?id=${id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching language with ID ${id}:`, error);
    return null;
  }
};

// Function to update a language
export const updateLanguage = async (id, language, language_code) => {
  try {
    const response = await fetch(`${API_BASE_URL}/update.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id, language, language_code }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating language:', error);
    return null;
  }
};

// Function to delete a language
export const deleteLanguage = async (id) => {
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
    console.error('Error deleting language:', error);
    return null;
  }
};