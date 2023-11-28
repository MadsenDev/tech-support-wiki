-- Create `categories` table
CREATE TABLE `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `parent_id` INT NULL,
    `description` TEXT NULL,
    FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
);

-- Create `guides` table
CREATE TABLE `guides` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `category_id` INT,
    `content` TEXT NOT NULL,
    `full_page` TINYINT NOT NULL DEFAULT 0,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
);

-- Create `tags` table
CREATE TABLE `tags` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE,
    `slug` VARCHAR(255) NOT NULL UNIQUE
);

-- Create `guide_tags` table (many-to-many relationship)
CREATE TABLE `guide_tags` (
    `guide_id` INT,
    `tag_id` INT,
    PRIMARY KEY (`guide_id`, `tag_id`),
    FOREIGN KEY (`guide_id`) REFERENCES `guides`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`tag_id`) REFERENCES `tags`(`id`) ON DELETE CASCADE
);

-- Create `guide_comments` table
CREATE TABLE `guide_comments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `guide_id` INT,
    `commenter_name` VARCHAR(255) NOT NULL,
    `comment` TEXT NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`guide_id`) REFERENCES `guides`(`id`) ON DELETE CASCADE
);

-- Create `guide_ratings` table
CREATE TABLE `guide_ratings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `guide_id` INT,
    `rater_name` VARCHAR(255) NOT NULL,
    `rating` TINYINT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    FOREIGN KEY (`guide_id`) REFERENCES `guides`(`id`) ON DELETE CASCADE
);