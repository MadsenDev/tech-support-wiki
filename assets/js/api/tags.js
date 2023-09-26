// Function to create a new tag
export const createTag = async (name) => {
    try {
      const response = await fetch('/api/tags/create.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name }),
      });
  
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error creating tag:', error);
      return null;
    }
  };

  // Function to fetch tags
export const fetchTags = async () => {
    try {
      const response = await fetch('/api/tags/read.php');
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error fetching tags:', error);
      return null;
    }
  };

  // Function to update a tag
export const updateTag = async (id, name) => {
    try {
      const response = await fetch('/api/tags/update.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id, name }),
      });
  
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error updating tag:', error);
      return null;
    }
  };

  // Function to delete a tag
export const deleteTag = async (id) => {
    try {
      const response = await fetch('/api/tags/delete.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id }),
      });
  
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error deleting tag:', error);
      return null;
    }
  };

  // Function to fetch a single tag
export const fetchSingleTag = async (id) => {
    try {
      const response = await fetch(`/api/tags/read_single.php?id=${id}`);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(`Error fetching tag with ID ${id}:`, error);
      return null;
    }
  };