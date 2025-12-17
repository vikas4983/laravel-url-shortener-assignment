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

---
## Assumptions & Design Decisions

The following assumptions were made while implementing this assignment:

### Invitation Handling Assumptions

1. When an **Admin or SuperAdmin** sends an invitation, a record is created in the `invitations` table with:
- `email`
- `company_id`
- `role_id`
- `invited_id`
- `token`
- `status = pending`

2. The invited user receives an **email invitation** containing a secure token-based link.

3. **Accept Invitation Flow**
- User clicks on the **Accept** button from the email
- User is redirected to a **account setup form**
- User account is created (or activated)
- Password is securely stored using Laravel hashing
- Invitation status is updated to **accepted**
- Invitation token becomes invalid

4. **Reject Invitation Flow**
- User clicks on the **Reject** button from the email
- No user account is created or activated
- Invitation status is updated to **rejected**
- Invitation token becomes invalid

5. Each invitation link can be used **only once**.
6. Expired, already accepted, or rejected invitations are not allowed to be reused.

---

### Seeder Data Assumptions

1. Users are inserted using Laravel seeders **only for development and testing purposes**.
2. The following users are created via seeders:
- One **SuperAdminSeeder**
- One **UserSeeder** (assigned to a demo company)
3. Seeder credentials are documented in the README for easy testing.
4. In a real production system, users should be onboarded **only via the invitation process**.

---

### General Assumptions

- UI is kept minimal to focus on backend logic as per assignment expectations
- Security and role-based authorization are prioritized over UI features
- Laravel best practices are followed throughout the implementation

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
