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

