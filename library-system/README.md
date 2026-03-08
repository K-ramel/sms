# Cebu Mary Immaculate College Inc. - Library Management System

A custom educational PHP MVC framework (mini Laravel-style) for CMIC library operations, designed to run on XAMPP with Apache + MySQL.

## Requirements
- PHP 8+
- Composer
- MySQL (XAMPP)
- Apache with `mod_rewrite`

## Installation
1. Copy this `library-system` folder to your XAMPP `htdocs` directory.
2. Create the database and tables by importing:
   - `database/library.sql`
3. Configure database credentials in:
   - `config/database.php`
4. Install dependencies:
   ```bash
   composer install
   composer dump-autoload
   ```
5. Start Apache and MySQL in XAMPP.
6. Open:
   - `http://localhost/library-system/public/login`

## Default Admin Login
- Email: `admin@cmic.edu.ph`
- Password: `password`

## Core Features
- Custom MVC framework (`core/`)
- PSR-4 autoloading via Composer
- Apache rewrite routing (`public/.htaccess`)
- Session-based authentication and role middleware
- CSRF protection for forms
- Admin module: users, books, reports
- Librarian module: borrow confirmations, returns, penalties
- Student/Teacher module: OPAC search, borrow request, history
- Audit trail in `storage/audit.log`

## Performance Notes
- Uses PDO prepared statements for efficient and secure database access.
- Keep Apache + MySQL in same LAN for low-latency school deployment.
- For 100+ concurrent users, enable OPcache and use connection pooling strategy at infrastructure level.

## Routes Overview
- `/login`, `/register`, `/logout`
- `/dashboard`
- `/books`, `/books/store`, `/books/update`, `/books/delete`
- `/opac`
- `/borrow`, `/borrow/request`, `/borrow/confirm`
- `/return`, `/return/process`
- `/admin/users`, `/admin/users/status`, `/admin/reports`
- `/student/history`, `/teacher/history`

## Security Implemented
- `password_hash()` / `password_verify()`
- CSRF tokens
- Role-based middleware
- Session auth checks
- Input validation and filtering

