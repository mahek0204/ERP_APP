# ERP System

This is a role-based ERP system built using Laravel 11. It includes modules for Admin, Team Leader, and Team Member. The system provides features like user management, role & permission handling, and team assignments.

## 🔧 Tech Stack

- Laravel 10
- Laravel Breeze (Authentication)
- Spatie Laravel Permission (Roles & Permissions)
- MySQL
- Bootstrap / Tailwind CSS
- JavaScript / AJAX

## 🎯 Features

- Admin Dashboard
- User Authentication
- Role & Permission Management (using Spatie package)
- Team Management
- Assign Team Leader and Members
- CRUD for Users and Teams
- Responsive UI with modals and AJAX interactions

## 🧑‍💻 Roles Overview

- **Admin**: Full access, can manage users, roles, and teams.
- **Team Leader**: Assigned to a team, can manage team members and view reports.
- **Team Member**: Can view assigned tasks and update progress.

## 📂 Folder Structure Highlights

- `app/Models`: Eloquent models like User, Role, Team.
- `app/Http/Controllers`: Contains controller logic for each module.
- `resources/views`: Blade views structured by module.

## 🚀 Setup Instructions

```bash
git clone https://github.com/your-username/erp-system.git
cd erp-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

## 🧪Demo Credentials

Email: admin@example.com
Password: admin@123
