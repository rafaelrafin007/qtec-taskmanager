# Task Manager (Laravel 12)

## Overview
Simple task management CRUD app built for a technical assessment using Laravel 12, Blade, and Bootstrap 5.

## Features
- Create, view, update, and delete tasks
- Task fields: `title`, `description`, `status`, `due_date`
- Status options: `pending`, `in_progress`, `completed`
- Server-side validation with Form Requests
- Feature tests for core task flows

## Tech Stack
- Laravel 12
- Blade templates
- Bootstrap 5 (CDN)
- PostgreSQL-ready structure

## Local Setup
1. Clone the repository.
2. Install dependencies:
```bash
composer install
```
3. Copy environment file:
```bash
cp .env.example .env
```
4. Generate app key:
```bash
php artisan key:generate
```
5. Start the app:
```bash
php artisan serve
```

## Environment Setup
Set database values in `.env` (example for PostgreSQL):
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=task_manager
DB_USERNAME=postgres
DB_PASSWORD=secret
```

## Migrate and Seed
Run migrations:
```bash
php artisan migrate
```

Seed sample tasks:
```bash
php artisan db:seed
```

## Run Tests
```bash
php artisan test
```

## Render Deployment
This app is deployed on Render using the Docker runtime and a managed PostgreSQL database.
After the first deploy, run:
```bash
php artisan migrate --force
php artisan db:seed --force
```
