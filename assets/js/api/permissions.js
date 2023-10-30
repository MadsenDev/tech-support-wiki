const API_BASE_URL = 'https://api.madsens.dev/tech-support-wiki/permissions/';

// Function to create a new permission
export const createPermission = async (name, description) => {
  try {
    const response = await fetch(API_BASE_URL + 'create.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ name, description }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating permission:', error);
    return null;
  }
};

// Function to fetch all permissions
export const fetchPermissions = async () => {
  try {
    const response = await fetch(API_BASE_URL + 'read.php');
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching permissions:', error);
    return null;
  }
};

// Function to fetch a single permission
export const fetchSinglePermission = async (id) => {
  try {
    const response = await fetch(API_BASE_URL + `read_single.php?id=${id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching permission with ID ${id}:`, error);
    return null;
  }
};

// Function to update a permission
export const updatePermission = async (id, name, description) => {
  try {
    const response = await fetch(API_BASE_URL + 'update.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id, name, description }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating permission:', error);
    return null;
  }
};

// Function to delete a permission
export const deletePermission = async (id) => {
  try {
    const response = await fetch(API_BASE_URL + 'delete.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error deleting permission:', error);
    return null;
  }
};