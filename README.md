## Mini E-commerce Product Catalog

This project is a mini e-commerce platform built with Laravel for the backend and Vue.js for the frontend. It allows users to browse products, add items to the cart, and view their shopping cart after logging in.

## Features

- Product listing page with product details.
- Shopping cart functionality (add, view, and remove products from cart).
- User authentication (login, logout).
- Protected routes for viewing the cart (only logged-in users can access).
- API integration with Sanctum for authentication and product/cart management.


## Requirements
- PHP >= 8.0
- Composer
- Node.js & npm
- MySQL or any other database supported by Laravel


### Setup Instructions


## 1. Clone the Repository

```
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
```

## 2. Install Dependencies
### Backend (Laravel)
```
composer install
```
## Frontend (Vue.js)
```
npm install 
```
## 3. Set Up Environment Variables

Copy the .env.example file to .env and configure your environment variables, particularly for the database connection and app URL.

 ```
cp .env.example .env
```
Generate the application key:
 
 ```
php artisan key:generate
```

## 4. Migrate and Seed the Database

Run the following commands to create the database tables and seed the initial data:

```
php artisan migrate
php artisan db:seed
```

*Note:* During the database seeding process, users are randomly generated. To log in, check the users table in your database for the generated user credentials (email and password). You can use a tool like phpMyAdmin or Laravel Tinker to inspect the records.

To check the users in the database using Tinker:

```
php artisan tinker
```
In Tinker, run:

```
App\Models\User::all();
```
This will display the randomly generated users and their email addresses.

### Password of the user is password  

## 5. Serve the Application

Backend (Laravel)

```
php artisan serve
```

Frontend (Vue.js)
```
npm run dev
```
Visit the application at http://localhost:8000.

