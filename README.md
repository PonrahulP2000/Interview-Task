## Project Name

Interview Task

Bulk uploading the datas from .josn file to database in a hierarchical relationships and CRUD operations

## Requirements

Before you get started, ensure you have the following installed:

- PHP >= 8.1
- Composer
- MySQL

## Installation Process
Step-by-step guide to set up the project locally:
```bash
# Clone the repository
git clone https://github.com/PonrahulP2000/Interview-Task.git

# Navigate to the project directory
cd Interview-Task

# Install dependencies

composer install

# Set up the .env file
 
 create database on MYSQL and save that name on .env file

# Database Migrations

php artisan migrate

# Upload the .josn file datas to database

-Place your json file to storage/app folder
-Run the command to import datas to DB (php artisan import:country-state-city)

# Run the Project

-php artisan serve 
- http://127.0.0.1:8000/countries/

