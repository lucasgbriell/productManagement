# Project Managament
---

##### Description:
Project Management is a simple project to manage products via API REST. This is allow product to be created, updated and deleted using request in JSON format and standard HTTP verbs.<br>Bellow, you can check the docs out and learn how to use.

## How to run?
1. Create a local database
```
CREATE DATABASE product_management;
```
2. Copy the env sample file
```
cp .env.example .env
```
3. Install all dependencies running
```
composer install
```
4. Run migration and seed.
After Running it, a user will be created for using the app. Bellow, you will see the user credentials:
`Email: lucasgabrielhonorio@gmail.com`
`Password: password`
#
```
php artisan migrate --seed
```
5. Run `php artisan serve` to start the server listening
6. Open at http://127.0.0.1:8000/


## Documentation
-----
You can access the documentation on `https://${base_url}/api/documentation`

# Technologies
-----
Language: PHP
Database: MySQL
Framework/Main Components: Laravel (Latest), JWT-Auth and Swagger 

# Testing
-----
Run `php artisan test` to test application
> Important note; Before running tests, you will need to run the seeder.

# Questions?
-----
Contact me at: lucasgabrielhonorio@gmail.com