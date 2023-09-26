# Tech Support Wiki

## Overview

This repository contains the codebase for the Tech Support Wiki. This project aims to provide a comprehensive, organized, and API-based platform for tech support guides, tips, and troubleshooting. It is designed to be mobile-friendly and theming-friendly, utilizing HTML, CSS, and JavaScript on the front-end and PHP for the back-end API.

## Features

- **Categories**: Allows the addition, modification, and deletion of guide categories.
- **Guides**: Create, read, update, and delete guides. Each guide is associated with a category and may have multiple tags.
- **Languages**: Support for multiple languages for each guide.
- **Tags**: Allows tagging of guides.
- **Users**: User management system (in progress).
- **Guide Views**: Tracks unique guide views and updates.
  
## Installation

1. Clone the repository
    ```bash
    git clone https://github.com/MadsenDev/tech-support-wiki.git
    ```
2. Navigate into the project directory
    ```bash
    cd tech-support-wiki
    ```
3. Import the SQL schema into your database.
4. Update the `db.php` with your database credentials.

## Usage

Run your PHP server and navigate to the project directory in your web browser.

## API Documentation

Detailed API documentation is available in the Wiki: [API Documentation](https://github.com/MadsenDev/tech-support-wiki/wiki)

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute to this project.

## License

This project is licensed under the GNU General Public License v3.0. See the [LICENSE.md](LICENSE.md) file for details.
