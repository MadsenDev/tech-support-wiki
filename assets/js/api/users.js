const API_BASE_URL = '/api/users';

// Function to fetch users
export const fetchUsers = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/read.php`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching users:', error);
    return null;
  }
};

// Function to create a new user
export const createUser = async (username, password, email, rank_id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ username, password, email, rank_id }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error creating user:', error);
    return null;
  }
};

// Function to update a user
export const updateUser = async (id, username, password, email, rank_id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/update.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id, username, password, email, rank_id }),
    });

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error updating user:', error);
    return null;
  }
};

// Function to delete a user
export const deleteUser = async (id) => {
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
    console.error('Error deleting user:', error);
    return null;
  }
};

// Function to fetch a single user
export const fetchSingleUser = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/read_single.php?id=${id}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching user with ID ${id}:`, error);
    return null;
  }
};

// Function to log out a user
export const logoutUser = async () => {
    try {
      const response = await fetch('${API_BASE_URL}/logout.php', {
        method: 'POST',
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error logging out:', error);
      return null;
    }
  };

  // Function to reset a user's password
export const resetPassword = async (token, newPassword) => {
    try {
      const response = await fetch('${API_BASE_URL}/reset_password.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ token, new_password: newPassword }),
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error resetting password:', error);
      return null;
    }
  };

  // Function to create a new user (Register)
export const registerUser = async (username, password, email) => {
    try {
      const response = await fetch(`${API_BASE_URL}/create.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password, email }),
      });
  
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error registering user:', error);
      return null;
    }
  };
  
  // Function to login a user
  export const loginUser = async (username, password) => {
    try {
      const response = await fetch(`${API_BASE_URL}/login.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
      });
  
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error logging in:', error);
      return null;
    }
  };