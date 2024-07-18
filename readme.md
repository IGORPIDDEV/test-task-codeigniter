# Codeigniter test task

## Setup Instructions

### Database Configuration

1. **Configure Database Access:**

   - Open `application/config/database.php`.
   - Modify the database configurations under the `['default']` array to match your database credentials:
     ```php
     'hostname' => 'localhost',
     'username' => 'your_username',
     'password' => 'your_password',
     'database' => 'your_database',
     ```

2. **Running Migrations:**

   Migrations are used to manage database schema changes over time. To run migrations:

   - Open your terminal.
   - Navigate to your project directory.
   - Run the following command:
     ```bash
     php index.php migrate
     ```

3. **Database Schema**
