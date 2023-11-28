### 1. **Initial Setup & Structure**:
#### Database:
- **Setup**: Use a tool like phpMyAdmin or a MySQL client to set up a new database named `tech_support_wiki`.
- **Tables**:
  - `categories`: For storing main and subcategories.
  - `guides`: Storing the main content articles.
  - `guide_tags`: To tag guides for easy searching.
  - `tags`: Storing tag information.
  - `guide_comments`: For user comments on guides.
  - `guide_ratings`: For user ratings on guides.
  - ... (and other tables as the project evolves).

#### File Structure:
- **Backend**:
  - `api/`: Contains all PHP scripts to interact with the database.
  - `config/`: Contains configuration files, like database connections.
  - `auth/`: Scripts related to authentication using SSO.
- **Frontend**:
  - `css/`: Contains all stylesheets.
  - `js/`: Contains all JavaScript files.
  - `assets/`: Contains images, fonts, and other static assets.
  - Various `.php` files at the root level for different views/pages.

### 2. **Backend Development (PHP & MySQL)**:
#### Database Connection:
- Create a `config/database.php` script to connect to the MySQL database using the `PDO` extension. This will provide a secure and reusable connection.

#### API Endpoints:
- **Categories**: CRUD operations for creating, reading, updating, and deleting categories.
- **Guides**: CRUD operations for guides.
- **Tags**: CRUD operations for tags.
- **Comments & Ratings**: Endpoints to fetch, add, update, or delete comments and ratings.
  
#### Authentication:
- Use the `auth.madsens.dev` for SSO authentication. When a user logs in, fetch their user data, and if they are new, store essential data in a `users` table in your database for reference.

### 3. **Frontend Development (HTML, CSS, JavaScript)**:
#### Main Templates:
- **Header**: Will contain the logo, main navigation, and user login/logout options.
- **Footer**: Contains copyright info, links, and any other general site-wide info.
- **Sidebar**: A dynamic sidebar that will load categories and popular tags for easy navigation.

#### Pages:
- **Homepage**: Displays a welcome message, top guides, latest comments, and perhaps a search bar.
- **Category Page**: Lists guides under a specific category. Supports pagination if there are a lot of entries.
- **Guide Page**: Shows the main content, tags, comments section, and rating system.

#### Styling:
- **Layout**: Use a mobile-first design approach. Frameworks like Bootstrap can speed up development.
- **Themes**: Use CSS variables for easy color theme switching. You might even allow users to pick their preferred theme.

#### JavaScript:
- **Dynamic Loading**: Fetch content dynamically as users navigate the wiki.
- **Form Handling**: Handle form submissions for comments, ratings, or searching.
  
### 4. **SEO & User Experience**:
- **Friendly URLs**: Use SEO-friendly URLs, e.g., `/category/software` instead of `/category.php?id=5`.
- **Meta Tags**: Add meta tags for SEO.
- **Pagination**: Implement pagination for long lists of guides or comments.
  
### 5. **Extras**:
- **Search**: Implement a search bar for users to find guides quickly.
- **User Profiles**: Allow users to view their comments, ratings, and maybe even save favorite guides.
  
### 6. **Testing & Deployment**:
After everything's set up, thoroughly test each feature, ensure mobile responsiveness, and then deploy to your server.

### 7. **Maintenance**:
Regularly update content, respond to user feedback, and ensure the platform runs smoothly.