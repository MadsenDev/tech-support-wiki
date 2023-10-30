const API_BASE_URL = '/api/themes';
const API_OPTIONS_URL = `${API_BASE_URL}/options`;

// Function to create a new theme
export const createTheme = async (title, filename) => {
  try {
    const response = await fetch(`${API_BASE_URL}/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ title, filename }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating theme:', error);
    return null;
  }
};

// Function to fetch all themes
export const fetchThemes = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/read.php`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching themes:', error);
    return null;
  }
};

// Function to fetch a single theme
export const fetchSingleTheme = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/read_single.php?id=${id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching theme with ID ${id}:`, error);
    return null;
  }
};

// Function to update a theme
export const updateTheme = async (id, title, filename) => {
  try {
    const response = await fetch(`${API_BASE_URL}/update.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id, title, filename }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating theme:', error);
    return null;
  }
};

// Function to delete a theme
export const deleteTheme = async (id) => {
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
    console.error('Error deleting theme:', error);
    return null;
  }
};

// Function to create a new theme option
export const createThemeOption = async (label, type, name, group_name) => {
    try {
      const response = await fetch(`${API_OPTIONS_URL}/create.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ label, type, name, group_name }),
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error creating theme option:', error);
      return null;
    }
  };
  
  // Function to fetch theme options
  export const fetchThemeOptions = async () => {
    try {
      const response = await fetch(`${API_OPTIONS_URL}/read.php`);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error fetching theme options:', error);
      return null;
    }
  };
  
  // Function to update a theme option
  export const updateThemeOption = async (id, label, type, name, group_name) => {
    try {
      const response = await fetch(`${API_OPTIONS_URL}/update.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id, label, type, name, group_name }),
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error updating theme option:', error);
      return null;
    }
  };
  
  // Function to delete a theme option
  export const deleteThemeOption = async (id) => {
    try {
      const response = await fetch(`${API_OPTIONS_URL}/delete.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id }),
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error deleting theme option:', error);
      return null;
    }
  };
  
  // Function to fetch a single theme option
  export const fetchSingleThemeOption = async (id) => {
    try {
      const response = await fetch(`${API_OPTIONS_URL}/read_single.php?id=${id}`);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(`Error fetching theme option with ID ${id}:`, error);
      return null;
    }
  };