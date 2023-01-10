## This repo is a basic test repo. It is a simple Kanban project built with Laravel and Vue

### Backend (Laravel 8) Setup
- Run `composer install` to install all packages
- Copy the .env.example file and save as .env
- Setup the environment (Database)
- Make sure you have mysqldump install (for the database dump)
- Run `composer require laravel/passport`. Passport was used for the access token and authentication
- Run `php artisan migrate` to create needed database tables
- Run `php artisan passport:install` to generate oauth keys and set up passport
- Run `php artisan db:seed` this will create a user account with email: thenewxpat@gmail.com and password: password
- Run `php artisan serve` to start the backend service

* Please note: BASIC AND EXPECTED EXCEPTIONS (LIKE MethodNotAllowedHttpException, NotFoundHttpException, ModelNotFoundException) are handled in app/Exceptions/Handler.php
* Also note: Services and Resource Collection not used because it is a small project


### Forntend (Vue 2) Setup
- Run `npm install` to install all packages
- Run `npm run serve` to start using the system