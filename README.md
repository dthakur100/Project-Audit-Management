<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).
(ye tumhara local content hai)
### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# Project-Audit-Management
Project Audit Management is a tool which manages Project Status,Quality,Security and other checkpoints constraint to measure the Audit of a particular Project.So this project manages to manage the Audit of project.
📊 Audit Management System
🧩 Project Introduction

The Audit Management System is a Laravel-based web application designed to manage project audits efficiently.

It replaces traditional Excel-based audit tracking with a structured, scalable, and secure system.

This system allows:

Creating projects

Managing audit categories and checkpoints

Performing audits

Generating reports

Handling soft deletes safely

Maintaining historical audit data integrity

The application follows clean architecture principles and includes proper authentication, soft deletes, and exception handling.

🚀 Features
🔐 Authentication

Session-based authentication

User registration & login

Protected routes using middleware

Logout functionality

📁 Project Management

Create, edit, delete projects

Mark project as Active / Completed

Completed projects hidden from audit selection

🗂 Audit Categories

CRUD operations

Soft delete support

Restore deleted categories

Cascade soft delete for related checkpoints

✅ Audit Checkpoints

Created under selected category

CRUD operations

Soft delete support

Restore functionality

DataTables integration

📋 Audits

Select project

Perform category-based audits

Store audit results

Track status (Pass / Fail)

Severity levels supported

📊 Reports

HTML report view

JSON API report

Grouped by category

Shows latest audit per project

Soft deleted categories/checkpoints still visible in old reports

Exception handling with logging

🛡 Data Integrity Features

Soft Deletes implemented for:

Categories

Checkpoints

Deleted records can be restored

Historical audit reports remain unaffected

Proper error logging in storage/logs/laravel.log

Friendly frontend error messages

🏗 Project Flow
Step 1 → User Login

User logs in using session-based authentication.

Step 2 → Create Project

Admin creates a new project.

Step 3 → Create Categories

Audit categories are created (e.g., Security, Code Quality).

Step 4 → Create Checkpoints

Checkpoints are created under selected categories.

Step 5 → Perform Audit

User selects a project → completes audit → saves results.

Step 6 → View Report

Reports show:

Category

Checkpoint

Status

Severity

Remarks

Even if categories/checkpoints are soft deleted later, old audit reports remain intact.

🖥 Tech Stack

Laravel

MySQL

Bootstrap

DataTables

Eloquent ORM

Soft Deletes

RESTful Resource Controllers

⚙️ Installation & Setup

Follow these steps to run the project locally:

1️⃣ Clone Repository
git clone <your-repository-url>
cd <project-folder>

2️⃣ Install Dependencies
composer install

3️⃣ Create Environment File
cp .env.example .env

4️⃣ Generate App Key
php artisan key:generate

5️⃣ Configure Database

Open .env file and update:

DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

6️⃣ Run Migrations
php artisan migrate

7️⃣ Start Development Server
php artisan serve


Visit:

http://127.0.0.1:8000

📂 Important Directories
app/
 ├── Models
 ├── Http/Controllers
resources/views/
routes/web.php
storage/logs/

📝 Logging

All application errors are logged in:

storage/logs/laravel.log

🔄 Soft Delete Behavior

If a Category is deleted:

All related checkpoints are soft deleted

Audit history remains safe

Records can be restored

If a Checkpoint is deleted:

Old audit reports remain unaffected

Checkpoint can be restored

>>>>>>> 52f4cffbc2e0e2269d1cf8724d8b2b8e7ba1cc4f
