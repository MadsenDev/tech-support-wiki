const API_BASE_URL = '/api/ranks/rank_permissions';

// Function to create a new rank-permission relationship
export const createRankPermission = async (rank_id, permission_id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ rank_id, permission_id }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating rank-permission:', error);
    return null;
  }
};

// Function to fetch all rank-permission relationships
export const fetchRankPermissions = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/read.php`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching rank-permissions:', error);
    return null;
  }
};

// Function to update a specific rank-permission relationship
export const updateRankPermission = async (old_rank_id, old_permission_id, new_rank_id, new_permission_id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/update.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ old_rank_id, old_permission_id, new_rank_id, new_permission_id }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating rank-permission:', error);
    return null;
  }
};

// Function to delete a specific rank-permission relationship
export const deleteRankPermission = async (rank_id, permission_id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/delete.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ rank_id, permission_id }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error deleting rank-permission:', error);
    return null;
  }
};