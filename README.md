## Gourmet Project

PHP 8.1

Laravel 10.0

MySQL

## Installation

Run composer install command

  ```php
  composer install
  ```

Copy   ``` .env.example ``` to ```.env``` and updated the configurations (mainly the database configuration)


Run migrations and seeder commands

  ```php
  'php artisan migrate'
  ```

  ```php
  'php artisan db:seed --class=DishSeeder'
  ```