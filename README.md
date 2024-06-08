# E-commerce App

## About the project

This is a simple demonstration of an ecommerce application written in PHP using Laravel framework. This project intended to be used for a technical test purpose. Some features that are covered in this project are :

- Authentication (Register, Login, Logout)
- Product creation
- Cart
- Order creation

## Requirement

You need to have these installed : 
- Mysql Server
- PHP
- Composer
- NodeJS

## Setup
1. Clone this repository
2. Create a database in your mysql server named __*ecommerce_app*__ and please configure the right database connection credentials according to your mysql server configuration in the .env file.
3. Then to install the php dependencies run
```shell 
composer install
```
4. then to install the nodejs dependencies run
```shell 
npm install
```
5. Then run the migration
```shell
php artisan migrate
```

## Run

1. Open your terminal and run
```shell
php artisan serve
```
2. Open another terminal or perhaps you can just split it and run
```shell
npm run dev
```
3. Open the browser and hit the localhost:8000

## Using the application

First, you need to register an account :

#### Account Registration - localhost:8000/register

Then, you can log in to the account with the following url :

#### Login - localhost:8000/login

Another url you need to access manually is for product creation:

#### Product Creation - localhost:8000/products/add

I believe for other routes, you can find it using the interface.

## API Endpoints
TBC