# ERP System

This is a role-based ERP system built using Laravel 11. It includes modules for Admin, Team Leader, and Team Member. The system provides features like user management, role & permission handling, and team assignments.

## 🔧 Tech Stack

- Laravel 11
- Laravel Breeze (Authentication)
- Spatie Laravel Permission (Roles & Permissions)
- MySQL
- Bootstrap / Tailwind CSS
- JavaScript 

## 🎯 Features

- Admin Dashboard
- User Authentication
- Role & Permission Management (using Spatie package)
- Team Management
- Assign Team Leader and Members
- CRUD for Users and Teams
- Responsive UI with modals 

## 📂 Folder Structure Highlights

- `app/Models`: Eloquent models like User, Role, Team.
- `app/Http/Controllers`: Contains controller logic for each module.
- `resources/views`: Blade views structured by module.

## 🚀 Setup Instructions

```bash
git clone https://github.com/mahek0204/erp_app.git
cd erp-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

## 🧪Demo Credentials

Email: admin@example.com
Password: admin@123
