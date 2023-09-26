// Function to create a new guide
export const createGuide = async (title, creator_id, content, category_id, full_page, tags) => {
    try {
      const response = await fetch('/api/guides/create.php', {
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
      const response = await fetch('/api/guides/read.php');
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
      const response = await fetch('/api/guides/update.php', {
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
      const response = await fetch('/api/guides/delete.php', {
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
      const response = await fetch(`/api/guides/read_single.php?id=${id}`);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(`Error fetching guide with ID ${id}:`, error);
      return null;
    }
  };