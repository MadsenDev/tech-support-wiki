const API_BASE_URL = '/api/guides';

// Function to create a new guide
export const createGuide = async (title, creator_id, content, category_id, full_page, tags) => {
  try {
    const response = await fetch(`${API_BASE_URL}/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ title, creator_id, content, category_id, full_page, tags }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating guide:', error);
    return null;
  }
};

// Function to fetch guides
export const fetchGuides = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/read.php`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching guides:', error);
    return null;
  }
};

// Function to update a guide
export const updateGuide = async (id, title, content, category_id, full_page, tags) => {
  try {
    const response = await fetch(`${API_BASE_URL}/update.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id, title, content, category_id, full_page, tags }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating guide:', error);
    return null;
  }
};

// Function to delete a guide
export const deleteGuide = async (id) => {
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
    console.error('Error deleting guide:', error);
    return null;
  }
};

// Function to fetch a single guide
export const fetchSingleGuide = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/read_single.php?id=${id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching guide with ID ${id}:`, error);
    return null;
  }
};

// Function to record an update for a guide
export const recordGuideUpdate = async (guide_id, updater_id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/updates/create.php?guide_id=${guide_id}&updater_id=${updater_id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error recording guide update:', error);
    return null;
  }
};