# Project Intelen

This repository houses a CRUD (Create, Read, Update, Delete) application developed using PHP and the Symfony framework. 
It's designed to showcase the power of Symfony in building web applications that interact with relational databases,
providing an intuitive interface for managing data entries.

# Getting Started

Dependencies:
- Requires PHP 8.2 or higher, Symfony latest, Composer, MySQL/MariaDB.

Installing:

- git clone the project
- cd intelen
- composer install

Code Analysis Tools setup:

- composer require --dev phpstan/phpstan

Configuring:

- Create a .env.local file from the .env file template and adjust the DATABASE_URL and any other environment-specific settings.
- cp .env .env.local
- Edit .env.local with your local environment settings

Setting up the Database
Run the following command to create the database and apply migrations:

- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate

Running the Application
Start the Symfony local web server:

- symfony server:start

Access the application via http://localhost:8000 or the URL provided by the Symfony server.

# Testing
For PHPUnit run this command:

- ./bin/phpunit --coverage-html coverage-report

For Analysis with PHPStan run this command:

- vendor/bin/phpstan analyse
