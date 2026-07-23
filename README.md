# Employee Management System

A modern Employee Management System built with **Laravel 13**, **Vue 3**, **Inertia.js**, **TypeScript**, and **Tailwind CSS**. This project serves as a learning and portfolio application that demonstrates modern Laravel development practices, including authentication, role-based authorization, employee CRUD operations, pagination, validation, flash messages, and a responsive user interface.

## Requirements

- PHP 8.5+
- Composer
- Node.js & npm
- MySQL (or another supported database)

## Installation

Clone the repository:

```bash
git clone https://github.com/mi-prakash/employee-management.git
```

Navigate to the project directory:

```bash
cd <repository-name>
```

Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies:

```bash
npm install
```

Copy the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your database credentials in the `.env` file, then run the migrations and seeders:

```bash
php artisan migrate --seed
```

Start the Laravel development server:

```bash
php artisan serve
```

Start the Vite development server:

```bash
npm run dev
```

The application will now be available at:

```
http://127.0.0.1:8000
```

## Running Tests

```bash
php artisan test
```

## Code Style

```bash
php artisan pint
```