# Laravel URL Shortener Assignment

## Project Overview
This project is a **role-based URL Shortener system** built using **Laravel 12**.
It demonstrates authentication, authorization, invitation management, and secure URL handling based on roles and
companies.

---

## Tech Stack
- Framework: Laravel 12
- PHP Version: 8.2.12
- Database: MySQL (Version 5.2)
- UI Theme: Mono Bootstrap
https://themefisher.com/demo?theme=mono-bootstrap
- Mail Service: Gmail SMTP

---

## Project Setup (Step by Step)

### 1. Clone the Project
```bash
git clone https://github.com/vikas4983/laravel-url-shortener-assignment.git
cd laravel-url-shortener-assignment
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Create Environment File
```bash
cp .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Configure Environment Variables

#### Mail Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="your_email@gmail.com"
MAIL_FROM_NAME="URL-SHORTNER"
```

#### Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sembark
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Create Database
Create a database manually in phpMyAdmin:

Database Name: sembark

### 7. Run Migrations
```bash
php artisan migrate
```

### 8. Run Seeders
```bash
php artisan db:seed
```

## Default Login Credentials

### Super Admin
Email: superadmin@sembark.com
Password: superadmin

### Admin
Email: admin@sembark.com
Password: adminadmin

### Member
Email: member@sembark.com
Password: membermember

---

## Roles & Authorization
Roles implemented:
- SuperAdmin
- Admin
- Member


Authorization handled using Laravel Gates & Policies.

---

## Invitation Rules
- SuperAdmin can invite an Admin in a new company
- Admin can invite Admin or Member in their own company
- Members cannot invite users

---

## URL Shortener Rules
- SuperAdmin cannot create short URLs
- Admin and Member can create short URLs
- SuperAdmin can see all company URLs
- Admin can see URLs created in their own company
- Member can see URLs created by themselves
- URLs are private and not publicly resolvable

---

## Run the Project
```bash
php artisan serve
```

Visit: http://127.0.0.1:8000
