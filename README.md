# URL Shortener Service (Laravel)

This project is a multi-tenant URL Shortener service built using Laravel.
It supports multiple companies, role-based access control, and public URL redirection.
Each company can manage its own users and short URLs, with strict access rules based on roles.

# Key Features

Multi-company (tenant-based) architecture
Role-based authentication & authorization
Invitation system for Admins and Members
Secure URL shortening
Public short URL redirection
Fully test-covered critical flows

# Tech Stack

Layer Technology
Backend PHP 8.x
Framework Laravel 10 / 11 / 12
Database MySQL / SQLite
Auth Laravel Authentication
ORM Eloquent
Testing PHPUnit
Version Control Git

# User Roles & Permissions

1. SuperAdmin

Can create companies
Can invite Admin users to any company
Can view all short URLs across all companies
Cannot create short URLs

2. Admin

Belongs to one company
Can invite Admin or Member to their own company
Can create short URLs
Can view all URLs created inside their company

3. Member

Belongs to one company
Can create short URLs
Can view only URLs created by themselves

# Authentication & Authorization

Email + password based authentication
Role-based access control enforced via:
Middleware
Policies
Only authorized users can access restricted endpoints

# Invitation Flow

1. SuperAdmin
   Invites Admin to create a new company

2. Admin
   Invites Admin or Member within their own company

# URL Shortener Rules

1. SuperAdmin Can not Create but can see all URL Shortener.
2. Admin Can Create and can see all own URL Shortener.
3. Member Can Create and can see all own URL Shortener.

# Public Access

All short URLs are publicly accessible
Short URL redirects to the original URL

# Database Design (High-Level)

1. companies
2. users
3. role_user (pivot)
4. companies
5. short_urls
6. invitations
   All relationships are managed via Eloquent ORM.

# Testing Strategy

The following test cases are covered using PHPUnit:

1. Authentication Tests
   Login / Logout
   Role-based access restrictions
2. Authorization Tests
   Admin access limited to own company
   Member access limited to own URLs
   SuperAdmin access across companies
3. URL Tests
   Admin & Member can create short URLs
   SuperAdmin cannot create short URLs
   Public short URL redirects correctly
4. Invitation Tests
   Valid invitation acceptance
   Invalid or expired token rejection

# Installation & Setup

1. Clone Repository
   git clone https://github.com/your-username/url-shortener.git
   cd url-shortener

2. Install Dependencies
   composer install
   composer global require laravel/installer 

3. Environment Setup
   cp .env.example .env
   php artisan key:generate

4. Database Configuration

Update .env with database credentials:

DB_CONNECTION=mysql
DB_DATABASE=url_shortener
DB_USERNAME=root
DB_PASSWORD=

5️⃣ Run Migrations & Seeders
php artisan migrate --seed

Seeder will create:

SuperAdmin account

Default roles

6️⃣ Run Server
php artisan serve

🔑 Default SuperAdmin Credentials
Email: superadmin@example.com
Password: password

(Change immediately after first login)

🧪 Run Tests
php artisan test
